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
        if (isset($_POST['email'], $_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new UserModel();
            if ($user = $userModel->validateUser($email, $password)) {
                $session = new SessionController();
                $session->setUser($user->UserId, $user->Username);
                new Router("Dashboard");
            } else {
                new Router("Login");
            }
        }
    }

    public function tryLogOutUser()
    {
        $session = new SessionController();
        if (isset($session->getUser()['userId'])) {
            $session->destroy();
            new Router("Home");
        } else {
            console_log('No user is logged in.');
        }
    }

    public function tryRegistUser()
    {
        if (isset(
            $_POST['email'],
            $_POST['username'],
            $_POST['password'],
            $_POST['repeatPassword'],
            $_POST['birthdate']
        )) {

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

    public function fetchById($userId)
    {
        if (isset($userId)) {
            $userModel = new UserModel();
            return $userModel->getUserById($userId);
        } else {
            return null;
        }
    }
}
