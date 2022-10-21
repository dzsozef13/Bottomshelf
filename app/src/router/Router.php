<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/autoload.php";
include_files(array(
    "SessionController",
    "Console",
    "Router",
    "Route",
));
// you first create all possible routes
// Match function when we need to navigate somewhere and the router has to find an existing path and compare
// when matching it consumes a URL, therefore it needs to split it and analyze it,
// meaning, it checks what kind of method, the path, the parameters and arguments
class Router{
// Accepts in requests
// Breaks down the path
// Checks method and calls the right controller

private static $routes = Array();
private $request;

 /**
 * @param Route
 */
public function __construct($requestParam)
{
    //not done
    $this->request = $requestParam;
  
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
  require $_SERVER['DOCUMENT_ROOT']."/src/view/" . $req . ".php";
}

 /**
 * @return Route[]
 */
public static function getAll(){
    return self::$routes;
  }
}
