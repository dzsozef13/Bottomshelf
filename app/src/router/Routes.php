<?php
include_files(array(
    "Console",
));

/**
 * Router::add(new Route("Destination", "/path", array(parameter=>value)));
 */
Router::add(new Route("404", "view/renderView", array("view" => "404")));

Router::add(new Route("", "Page/homePage"));
Router::add(new Route("Home", "Page/homePage"));
Router::add(new Route("Login", "Page/loginPage"));
Router::add(new Route("About", "Page/aboutPage"));
Router::add(new Route("Dashboard", "Page/dashboardPage"));

//test route but i was able to call a controller to create with this! really cool
Router::add(new Route("CreatePost", "post/create"));

Router::add(new Route("UserLogin", "user/tryLogInUser"));
