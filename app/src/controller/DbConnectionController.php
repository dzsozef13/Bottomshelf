<?php
include_files(array(
    "Const",
    "Console"
));

class DbConnectionController
{
    private static $user = DB_USERNAME;
    private static $pass = DB_PASSWORD;
    private static $dbName = DB_NAME;
    private static $dbHost = DB_SERVER;

    private $dbCon;

    public function __construct()
    {
        $user = self::$user;
        $pass = self::$pass;
        $dbName = self::$dbName;
        $dbHost = self::$dbHost;

        try {
            $this->dbCon = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $user, $pass, array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_PERSISTENT => false,
                \PDO::ATTR_EMULATE_PREPARES => false
            ));
        } catch (PDOException $err) {
            console_error("Failed db connection");
            $this->destroy();
        }
    }

    public function destroy()
    {
        $this->dbCon = null;
        console_log("connection closed!");
    }

    public function useDb()
    {
        return $this->dbCon;
    }
}
