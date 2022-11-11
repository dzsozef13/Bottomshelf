<?php
include_files(array(
    "DbConnectionController",
    "Router",
    "Route",
    "Console",
    "UserModel"
));

class UserController {

    public function getLoggedInUser() {
        
    }

    public function tryLogInUser() {
        if(isset($_POST['email'], $_POST['password']) ) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new UserModel();
            if ($userModel->validateUser($email, $password)) {
                $redirect = new Router("Home");
            } else {
                $redirect = new Router("Login");
            }
        }
    }

}