<?php 
include_files(array(
    "Console",
));

/**
 * Router::add(new Route("Destination", "/path", array(parameter=>value)));
 */
Router::add(new Route("404", "view/render", array("view"=>"404")));

Router::add(new Route("", "view/render", array("view"=>"home")));
Router::add(new Route("Home", "view/render", array("view"=>"home")));
Router::add(new Route("Login", "view/render", array("view"=>"login")));
Router::add(new Route("Dashboard", "view/render", array("view"=>"dashboard")));

//test route but i was able to call a controller to create with this! really cool
Router::add(new Route("createPost", "post/createTest/"));
Router::add(new Route("CreatePost", "post/create"));

Router::add(new Route("LoginUser", "user/tryLogInUser"));