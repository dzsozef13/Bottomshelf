<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/autoload.php";
include_files(array(
    "Console",
    "DbConnectionController",
));

class PostEntity extends Entity
{
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
