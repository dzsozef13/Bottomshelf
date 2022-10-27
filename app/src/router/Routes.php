<?php 
include_once 'autoload.php';
include_files(array(
    "Console",
));

Router::add(new Route("home", "/", [ArticleController::class, 'get'], ['GET']));
Router::add(new Route("login", "/login", [ArticleController::class, 'get'], ['GET']));