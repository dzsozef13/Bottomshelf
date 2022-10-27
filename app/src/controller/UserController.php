<?php

include_once $_SERVER['DOCUMENT_ROOT']."/autoload.php";
include_files(array(
    "DbConnectionController",
    "Console"
));

class UserController {

    protected $username = "hello world";

    public function getLoggedInUser() {
        return $this->username;
    }

}