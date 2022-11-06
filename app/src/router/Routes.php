<?php 
include_files(array(
    "Console",
));

/**
 * Router::add(new Route("Destination", "/path", [parameter=value], 'TYPE'));
 */
Router::add(new Route("", "view/render/home"));
Router::add(new Route("Home", "view/render/home"));
Router::add(new Route("Login", "view/render/login"));
Router::add(new Route("Asd", "view/print/asd"));
Router::add(new Route("Dashboard", "view/render/dashboard"));
//test route but i was able to call a controller to create with this! really cool
Router::add(new Route("createPost", "post/createTest/"));