<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/autoload.php";
include_files(array(
    "Console",
    "DbConnectionController",
));

class PostEntity extends Entity
{
    private $id;
    public function getId()
    {
        return $this->id;
    }
}
