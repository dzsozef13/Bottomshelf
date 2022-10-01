<?php

require_once("db/DbConnectionController.php");

class SessionController {
    public function __construct()
    {
        session_start();
    }

    public function connect_to_db() {
        if ($db = new DbConnection) {
            print("DB Connection Success");
            return $db;
        } else {
            print("DB Connection Failed");
            return null;
        }
    }
}

?>