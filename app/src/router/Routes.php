<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/autoload.php";
include_files(array(
    "SessionController",
    "Console",
    "Router",
    "Route"
));

class Routes{

    public static $home;
    public static $login;

    public function __construct()
    {
        $this->home = new Route("home", "/src/view/Home.php", 1, ['GET']);
        $this->login = new Route("login", "/src/view/Login.php", 1, ['GET']);
       
    }
    
  
}