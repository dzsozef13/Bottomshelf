<?php 
include_once 'autoload.php';
include_files(array(
    "Console",
));
// (GET) site controller for getting information per page
//  (POST) specific controller with post 
Router::add(new Route("home", "/", [PageController::class, 'home'], ['GET']));
Router::add(new Route("login", "/login", [PageController::class, 'login'], ['GET']));

// example post
// Router::add(new Route("createPost", "/post/create", [PostController::class, 'createPost'], ['POST']));