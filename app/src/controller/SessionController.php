<?php
include_files(array(
    "DbConnectionController",
    "Console"
));

class SessionController
{

    /**
     * Start or continues session
     */
    function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    /**
     * Destroys all session data
     */
    public function destroy()
    {
        session_destroy();
    }

    /**
     * Sets user data in session
     */
    public function setUser($userId, $username)
    {
        $_SESSION['userId'] = $userId;
        $_SESSION['username'] = $username;
    }

    /**
     * Returns array of user data
     */
    public function getUser()
    {
        $userId = $_SESSION['userId'];
        $username= $_SESSION['username'];
        
        if (isset($userId, $username)) {
            return  array(
                'userId' => $userId,
                'username' => $username
            );
        } else {
            return null;
        }
    }
}
