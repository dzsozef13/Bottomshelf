<?php

include("DbConnectionController.php");

class SessionController {
    public function __construct()
    {
        session_start();
    }

    public function connect_to_db() {
        if ($db = new DbConnection()) {
            return $db;
        }
    }
}

?>