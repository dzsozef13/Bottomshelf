<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/autoload.php";
include_files(array(
    "SessionController",
    "Console",
    "Router",
    "Route"
));
// you first create all possible routes
// Function to add / delete / update paths
// Match function when we need to navigate somewhere and the router has to find an existing path and compare
class Router{
// Accepts in requests
// Breaks down the path
// Checks method and calls the right controller

private static $routes = Array();
private $request;

public function __construct($requestParam)
{
    $this->request = $requestParam;
  
}


public static function add($route)
{
    array_push(self::$routes, $route);
}

public static function getAll(){
    return self::$routes;
  }
}
