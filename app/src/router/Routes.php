<?php
include_files(array(
    "Console",
));

/**
 * Router::add(new Route("Destination", "/path", array(parameter=>value)));
 */
Router::add(new Route("404", "page/load", array("view" => "404")));

Router::add(new Route("", "page/load", array("view" => "Home")));
Router::add(new Route("Home", "page/load", array("view" => "Home")));
Router::add(new Route("Login", "page/load", array("view" => "Login")));
Router::add(new Route("Signup", "page/load", array("view" => "Signup")));
Router::add(new Route("About", "page/load", array("view" => "About")));
Router::add(new Route("Dashboard", "page/load", array("view" => "Dashboard")));
Router::add(new Route("Explore", "page/load", array("view" => "Explore")));
Router::add(new Route("Profile", "page/load", array("view" => "Profile")));
//test route but i was able to call a controller to create with this! really cool
Router::add(new Route("CreatePost", "post/create"));

Router::add(new Route("UserLogin", "user/tryLogInUser"));
Router::add(new Route("UserRegist", "user/tryRegistUser"));
