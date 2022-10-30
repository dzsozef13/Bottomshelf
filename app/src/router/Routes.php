<?php 
include_once 'autoload.php';
include_files(array(
    "Console",
));

Router::add(new Route("home", "/", [PostController::class, 'get'], ['GET']));
Router::add(new Route("login", "/login", [PostController::class, 'get'], ['GET']));