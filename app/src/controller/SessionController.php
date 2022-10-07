<?php

include_once $_SERVER['DOCUMENT_ROOT']."/autoload.php";
include_files(array(
    "DbConnectionController",
    "Console"
));

// spl_autoload_register(function ($class) {
//     include("".$class.".php");
// });

class SessionController {
    function __construct() {
        session_start();
    }

    public function connect_to_db() {
        if($db = new DbConnectionController()) {
            return $db;
        } else {
            $db.destroy();
        }
    }
}