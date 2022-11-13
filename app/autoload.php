<?php
include_files(array(
    "Console"
));

/**
 * Globally used function to inlcude files from the directory.
 */
function include_files($files)
{
    foreach ($files as $filename) {
        switch ($filename) {
                // MODEL
                //DAL
            case "Route":
                include_once $_SERVER['DOCUMENT_ROOT'] . '/src/model/' . "$filename" . '.php';
                break;
                //DAL
            case "PostModel":
            case "CountryModel":
            case "BadgeModel":
            case "About":
            case "TagModel":
            case "CoreModel":
            case "UserModel":
                include_once $_SERVER['DOCUMENT_ROOT'] . '/src/model/DAL/' . "$filename" . '.php';
                break;
                // CONTROLLER
            case "SessionController":
            case "DbConnectionController":
            case "PostController":
            case "UserController":
            case "ViewController":
            case "FrontEndController":
                include_once $_SERVER['DOCUMENT_ROOT'] . '/src/controller/' . "$filename" . '.php';
                break;
                // VIEW
            case "Home":
            case "Login":
            case "Dashboard":
            case "404":
                include_once $_SERVER['DOCUMENT_ROOT'] . '/src/view/' . "$filename" . '.php';
                break;
                // CONFIG
            case "Const":
            case "Console":
                include_once $_SERVER['DOCUMENT_ROOT'] . '/config/' . "$filename" . '.php';
                break;
                // ROUTER
            case "Router":
            case "Routes":
                include_once $_SERVER['DOCUMENT_ROOT'] . '/src/router/' . "$filename" . '.php';
                break;
                // ROUTE NOT FOUND
            default:
                console_error("Tried to use undefined module: " . $filename);
                break;
        }
    }
}
