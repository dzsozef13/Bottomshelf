<?php
include_files(array(
    "Const",
    "Console"
));

class DbConnectionController {
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
            console_log("YAY, we have a database *_*");
        } catch (PDOException $err) {
            console_error("Failed db connection");
             $this->destroy();
        }
    }

    public function destroy() {
        $this->dbCon = null;
    }
}