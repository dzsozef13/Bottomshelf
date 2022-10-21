<?php 
include_once 'autoload.php';
include_files(array(
    "SessionController",
    "Console",
));

Router::add(new Route("getHomePage", "/", 1, ['GET']));
Router::add(new Route("getLoginPage", "/login", 1, ['GET']));
Router::add(new Route("getUserById", "/user/{id}", 1, ['GET']));