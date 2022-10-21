<?php

include_once 'autoload.php';
include_files(array(
    "SessionController",
    "Console",
    "Router",
    "Routes"
));

$session = new SessionController();
$session->connect_to_db();
console_log("Ready");
// premade routes are in Routes file
$router = new Router("getHomePage");
//testing
$router->match('login') 
?>


