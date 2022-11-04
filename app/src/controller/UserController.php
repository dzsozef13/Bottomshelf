<?php
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