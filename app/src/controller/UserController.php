<?php
include_files(array(
    "DbConnectionController",
    "SessionController",
    "Router",
    "Route",
    "Console",
    "UserModel"
));

class UserController 
{

    public function tryLogInUser() 
    {
        if(isset($_POST['email'], $_POST['password']) ) {
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            $userModel = new UserModel();
            if ($user = $userModel->validateUser($email, $password)) {
                $userSession = new SessionController();
                $userSession->startUserSession($user['UserId'], $user['Username']);
                new Router("Home");
            } else {
                new Router("Login");
            }
        }
    }

    public function tryRegistUser() 
    {
        if( isset($_POST['email'],
            $_POST['username'],
            $_POST['password'],
            $_POST['repeatPassword'],
            $_POST['birthdate'])) {

            $userModel = new UserModel();
            if ($_POST['password'] == $_POST['repeatPassword']) {
                $data = array(
                    'email' => $_POST['email'],
                    'username' =>  $_POST['username'],
                    'password' => $_POST['password'],
                    'birthdate' => $_POST['birthdate']
                );
                if ($userModel->registUser($data)) {
                    new Router("Login");
                } else {
                    new Router("Signup");
                }
            }
        }
    }

}