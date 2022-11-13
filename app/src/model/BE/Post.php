<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/autoload.php";
include_files(array(
    "Console",
    "DbConnectionController",
));

class PostEntity extends Entity
{
    // todo: add image property when we plan how to handle images
    private $id;
    private $title;
    private $description;
    private $isPublic;
    private $isSticky;
    private $createdAt;
    private $userId;
    private $childPostId;
    private $StatusId;

    public function getId()
    {
        return $this->id;
    }
}
