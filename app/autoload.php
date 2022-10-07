<?php

// When constructed, imports files with passed names
/* Usage:

include_once $_SERVER['DOCUMENT_ROOT']."/autoload.php";
$use = new Autoload(array(
    "Filenames"
));

*/
class Autoload {
    function __construct($dir) {
        foreach($dir as $filename) {
            switch ($filename) {
                case "SessionController":
                case "DbConnectionController":
                case "ImageController":
                    include $_SERVER['DOCUMENT_ROOT'].'/src/controller/'."$filename".'.php';
                    echo "Using ".$filename."<br>";
                    break;
                case "Const":
                    include $_SERVER['DOCUMENT_ROOT'].'/config/const.php';
                    break;
            }
        }
    }
}