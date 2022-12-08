<?php
include_files(array(
    "Console",
));

/**
 * Initializing all routes in the app
 * 
 * A Route can be defined by a name, a path (contorller/action) and an array of default parameters:
 * Router::add(new Route("RouteName", "controller/action", array(parameter=>value)));
 * 
 * A Route's name will be used as the action of forms and the hypertext references of <a> components
 */

// NAVIGATION
Router::add(new Route("", "page/load", array("view" => "Home")));
Router::add(new Route("404", "page/load", array("view" => "404")));
Router::add(new Route("Home", "page/load", array("view" => "Home")));
Router::add(new Route("Login", "page/load", array("view" => "Login")));
Router::add(new Route("Signup", "page/load", array("view" => "Signup")));
Router::add(new Route("About", "page/load", array("view" => "About")));
Router::add(new Route("Explore", "page/load", array("view" => "Explore", "auth" => true)));

Router::add(new Route("Profile", "page/load", array("view" => "Profile", "auth" => true)));

Router::add(new Route("SelectedPost", "page/load", array("view" => "SelectedPost", "auth" => true)));
Router::add(new Route("Upload", "page/load", array("view" => "Upload", "auth" => true)));
Router::add(new Route("Create", "page/load", array("view" => "Create", "auth" => true)));

// USER
Router::add(new Route("UserLogin", "user/tryLogInUser"));
Router::add(new Route("UserLogout", "user/tryLogOutUser"));
Router::add(new Route("UserRegist", "user/tryRegistUser"));

// POST
Router::add(new Route("CreatePost", "post/create"));
Router::add(new Route("FilterPost", "post/searchPosts"));

// COMMENT
Router::add(new Route("AddComment", "comment/create"));
Router::add(new Route("DeleteComment", "comment/delete"));
Router::add(new Route("UpdateComment", "comment/update"));

// MEDIA
Router::add(new Route("MediaUpload", "media/uploadMedia"));
