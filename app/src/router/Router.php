<?php 
include_files(array(
    "Console",
    "Route",
    "ViewController",
    "PostController"
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

    public function __construct() {

    }

    public static function add(Route $route) {
        if(isset(self::$routes) ) {
            self::$routes[$route->getName()] = $route;
        }
    }

    /**
     * Compares URL to existing route names to get the request path
     */
    public function serveRequeset() {
        $path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
        foreach ($this->getRoutes() as $route) {
            if ($route->getName() == $path) {
                $this->parseUri($route->getPath());
                $this->callRouteAction();
            }
        }
    }

    /**
     * Breaks down route path into a controller, an action and parameters
     */
    protected function parseUri($path) {
        list($controller, $action, $params) = explode("/", $path, 3);
        if (isset($controller)) {
            $this->setController($controller);
        }
        if (isset($action)) {
            $this->setAction($action);
        }
        if (isset($params)) {
            $this->setParams(explode("/", $params));
        }
    }
    
    /**
     * Finds and sets controller from path
     */
    protected function setController($controller) {
        $controller = ucfirst($controller) . "Controller";
        if (!class_exists($controller)) {
            console_error("Tried to set undefined controller: " . $controller);
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
        }
        $this->action = $action;
        console_log("Calling: " . $action);
    }
    
    /**
     * Sets parameters from path
     */
    protected function setParams(array $params) {
        $this->params = $params;
    }

    /**
     * Returns defined routes in Routes.php
     */
    protected static function getRoutes() {
        return self::$routes;
    }
    
    /**
     * Executes action in controller with parameters
     */
    protected function callRouteAction() {
        call_user_func_array(array(new $this->controller, $this->action), $this->params);
    }

}



