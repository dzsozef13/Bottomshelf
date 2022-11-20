<?php

class Post
{
    // todo: add image property when we plan how to handle images
    private $id;
    private $title;
    private $description;
    private $isPublic;
    private $isSticky;
    private $createdAt;
    private $authorId;
    private $childPostId;
    private $statusId;

    function __construct(
        $id, 
        $title, 
        $description, 
        $isPublic, 
        $isSticky, 
        $createdAt, 
        $authorId, 
        $childPostId, 
        $statusId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->isPublic = $isPublic;
        $this->isSticky = $isSticky;
        $this->createdAt = $createdAt;
        $this->authorId = $authorId;
        $this->childPostId = $childPostId;
        $this->statusId = $statusId;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }
}
