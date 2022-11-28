<?php

class Post
{
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

    public function getDescription()
    {
        return $this->description;
    }

    // public function getImageUrl()
    // {
    //     return $this-$imageUrl;
    // }

}
