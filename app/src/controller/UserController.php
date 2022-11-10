<?php
include_files(array(
    "DbConnectionController",
    "Console"
));

class UserController {

    public function getLoggedInUser() {
        
    }

    public function tryLogInUser() {
        $email = trim($_POST['email']);
        echo "email:    " . $email . "<br>";
	    $password = trim($_POST['password']);
        echo "Password hash:    " . password_hash($password, PASSWORD_DEFAULT);
    }

}