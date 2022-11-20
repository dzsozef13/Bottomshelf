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
        session_start();
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
        if (isset($_SESSION['userId'])) {
            return  array(
                'userId' => $_SESSION['userId'],
                'username' => $_SESSION['username']
            );
        } else {
            return null;
        }
    }
}
