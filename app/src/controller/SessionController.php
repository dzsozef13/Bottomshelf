<?php
include_files(array(
    "DbConnectionController",
    "Console"
));

class SessionController {
    function __construct() {
        session_start();
    }

    public function connect_to_db() {
        if($db = new DbConnectionController()) {
            return $db;
        } else {
            $db->destroy();
        }
    }
}