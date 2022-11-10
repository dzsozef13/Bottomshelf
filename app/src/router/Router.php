<?php 
include_files(array(
    "Console",
    "Route",
    "ViewController",
    "PostController",
    "UserController"
));
// you first create all possible routes
// Match function when we need to navigate somewhere and the router has to find an existing path and compare
// when matching it consumes a URL, therefore it needs to split it and analyze it,
// meaning, it checks what kind of method, the path, the parameters and arguments

class Router {
    // Accepts in requests
    // Breaks down the path
    // Checks method and calls the right controller
    public static $routes = Array();

    protected $params = [];

    public function __construct() {

    }

    public static function add(Route $route) {
        if(isset(self::$routes) ) {
            self::$routes[$route->getName()] = $route;
        }
    }

    /**
     * Escape routing and display 404
     */
    public function escape() {
        console_error("Page not found");
        $this->executeRoute("404");
    }

    /**
     * Returns defined routes in Routes.php
     */
    protected static function getRoutes() {
        return self::$routes;
    }

    /**
     * Parses URL to get requested route's name and query
     */
    public function serveRequeset() {
        $routeName = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
        $query = parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY);
        /**
         * Unwrap parameters from query
         * */ 
        $this->setParams($this->unwrapParams($query));
        /**
         * Try to call route
         */
        $this->executeRoute($routeName);
    }

    /**
     * Match route by name
     * Parse and set path and parameters of route
     * Set default parameters of route
     */
    protected function executeRoute($routeName) {
        foreach ($this->getRoutes() as $route) {
            if ($route->getName() == $routeName) {
                $this->setJob($route->getPath());
                $this->setParams($route->getParams());
                $this->callRouteAction();
                return;
            }
        }
        $this->escape();
    }

    /**
     * Breaks down route path
     * Looks for a controller and a function
     */
    protected function setJob($path) {
        list($controller, $action) = explode("/", $path, 3);
        if (isset($controller)) {
            $this->setController($controller);
        }
        if (isset($action)) {
            $this->setAction($action);
        }
    }

    /**
     * Returns and parses passed params string to params array
     */
    protected function unwrapParams($params) {
        parse_str($params, $paramsArray);
        return $paramsArray;
    }
    
    /**
     * Finds and sets controller from path
     */
    protected function setController($controller) {
        $controller = ucfirst($controller) . "Controller";
        if (!class_exists($controller)) {
            console_error("Tried to set undefined controller: " . $controller);
            $this->escape();
        }
        $this->controller = $controller;
        console_log("Calling: " . $controller);
    }
    
    /**
     * Finds and sets action from path
     */
    protected function setAction($action) {
        $reflectonController = new ReflectionClass($this->controller);
        if (!$reflectonController->hasMethod($action)) {
            console_error("Tried to call undefined function: " . $action . " of controller: " . $reflectonController . "Controller");
            $this->escape();
        }
        $this->action = $action;
        console_log("Calling: " . $action);
    }
    
    /**
     * Sets parameters from path
     */
    protected function setParams(array $params) {
        $currentParams = $this->params;
        $this->params = array_merge($params, $currentParams);
    }
    
    /**
     * Executes action in controller with parameters
     */
    protected function callRouteAction() {
        call_user_func_array(array(new $this->controller, $this->action), $this->params);
    }

}



