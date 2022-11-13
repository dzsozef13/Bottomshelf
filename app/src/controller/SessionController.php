<?php
include_files(array(
    "DbConnectionController",
    "Console"
));

class SessionController 
{

    function __construct() 
    {
        session_start();
    }

    public function startUserSession($userId, $username) 
    {
        $_SESSION['userId'] = $userId;
        $_SESSION['username'] = $username;
        console_log("Session started for: " . $username);
    }

}