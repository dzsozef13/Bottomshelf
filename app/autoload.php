<?php

include_once $_SERVER['DOCUMENT_ROOT']."/autoload.php";
include_files(array(
    "Console"
));

// Includes files with passed filenames
/* Usage:

include_once $_SERVER['DOCUMENT_ROOT']."/autoload.php";
include_files(array(
    "Console"
));

*/
function include_files($files) {
    foreach($files as $filename) {
        switch ($filename) {
            // MODEL
            case "Post":
            case "Route":
                include_once $_SERVER['DOCUMENT_ROOT'].'/src/model/'."$filename".'.php';
                console_log("Using ".$filename."");
                break;
            // CONTROLLER
            case "SessionController":
            case "DbConnectionController":
            case "ImageController":
            case "FrontEndController":
                include_once $_SERVER['DOCUMENT_ROOT'].'/src/controller/'."$filename".'.php';
                console_log("Using ".$filename."");
                break;
            // CONFIG
            case "Const":
            case "Console":
                include_once $_SERVER['DOCUMENT_ROOT'].'/config/'."$filename".'.php';
                console_log("Using ".$filename."");
                break;
            // ROUTER
            case "Router":
            case "Routes":
                include_once $_SERVER['DOCUMENT_ROOT'].'/src/router/'."$filename".'.php';
                console_log("Using ".$filename."");
                break;
        }
    }
}