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

// AUTH
Router::add(new Route("Explore", "page/load", array("view" => "Explore", "auth" => true)));
Router::add(new Route("Profile", "page/load", array("view" => "Profile", "auth" => true)));
Router::add(new Route("SelectedPost", "page/load", array("view" => "SelectedPost", "auth" => true)));
Router::add(new Route("Settings", "page/load", array("view" => "Settings", "auth" => true)));
Router::add(new Route("Upload", "page/load", array("view" => "Upload", "auth" => true)));
Router::add(new Route("Create", "page/load", array("view" => "Create", "auth" => true)));
Router::add(new Route("EditPost", "page/load", array("view" => "EditPost", "auth" => true)));
Router::add(new Route("Overview", "page/load", array("view" => "Overview", "auth" => true)));

// USER
Router::add(new Route("UserLogin", "user/tryLogInUser"));
Router::add(new Route("UserLogout", "user/tryLogOutUser"));
Router::add(new Route("UserRegist", "user/tryRegistUser"));
Router::add(new Route("UpdateUser", "user/updateUser"));
Router::add(new Route("ChangeProfilePicture", "user/addProfilePicture"));
Router::add(new Route("ChangeProfilePicture", "user/addProfilePicture"));
Router::add(new Route("BanUser", "user/markAsBanned"));
Router::add(new Route("UnbanUser", "user/markAsActive"));
Router::add(new Route("DeleteUser", "user/markAsDeleted"));

// SYSTEM
Router::add(new Route("UpdateContact", "system/UpdateContact"));
Router::add(new Route("UpdateDescriptionRules", "system/UpdateDescriptionRules"));

// POST
Router::add(new Route("CreatePost", "post/create"));
Router::add(new Route("EditPostInformation", "post/update"));
Router::add(new Route("DeletePost", "post/markAsDeleted"));
Router::add(new Route("FilterPost", "post/searchPosts"));

// COMMENT
Router::add(new Route("AddComment", "comment/create"));
Router::add(new Route("DeleteComment", "comment/deleteByCommentId"));
Router::add(new Route("UpdateComment", "comment/update"));

// MEDIA
Router::add(new Route("MediaUpload", "media/uploadMedia"));
