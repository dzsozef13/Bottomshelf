<?php

require_once("../config/const.php");

class DbConnection {

    private static $user = DB_USERNAME;
    private static $pass = DB_PASSWORD;
    private static $dbName = DB_NAME;
    private static $dbHost = DB_SERVER;

    public $dbCon;

    public function __construct() {
        $user = self::$user;
        $pass = self::$pass;
        $dbName = self::$dbName;
        $dbHost = self::$dbHost;

        try {
            $this->dbCon = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $user, $pass);
            return $this->dbCon;
        } catch (PDOException $err) {
            echo "Error!: " . $err->getMessage() . "<br/>";
            // die();
        }
    }

    public function destroy() {
        $this->dbCon = null;
    }
}