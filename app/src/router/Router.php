<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/autoload.php";
include_files(array(
    "Console",
    "Route",
    "ViewController"
));
// you first create all possible routes
// Match function when we need to navigate somewhere and the router has to find an existing path and compare
// when matching it consumes a URL, therefore it needs to split it and analyze it,
// meaning, it checks what kind of method, the path, the parameters and arguments
class Router{
// Accepts in requests
// Breaks down the path
// Checks method and calls the right controller
public static $routes = Array();
private $request;
private $viewCtrl;
 /**
 * @param Route
 */
public function __construct()
{
    $this->viewCtrl = new ViewController();
}

 /**
 * @param Route
 */
public static function add($route)
{

    if(isset(self::$routes) ) {
        self::$routes[$route->getName()] = $route;
    //    var_dump(self::$routes['home']->getMethods()[0]);
    }
  
}

public function match($req)
{
//   $this->pageCnrl->renderViewOnly($req);

  include $_SERVER['DOCUMENT_ROOT']."/src/view/" . $req . ".php";
}

public function composeRequset(string $endpoint, array $params)
{
    $requestUrl = "/";
    $requestParams = "?";
    foreach($params as $param) {
        $requestParams = $requestParams."?".$param;
    }
    $requestUrl = $requestUrl.$endpoint.$requestParams;
    // switch ($endpoint) {
    //     case "endpoint":
    //         $requestUrl = $requestUrl.$endpoint.$requestParams;
    //         break;
    // }
}

public function matchFromPath(string $path, string $method)
{
    foreach (self::$routes as $route) {
        if ($route->match($path, $method) === false) {
            continue;
        } 
        if($route->getMethods()[0] == 'GET') {
            $this->viewCtrl->renderViewOnly($route->getName());
        }
        return $route;
    }

    echo 'not found 404';
}

 /**
 * @return Route[]
 */
    public static function getAll(){
    return self::$routes;
  }


}



