<?php

class Comment
{

    private $id;
    private $content;
    private $authorId;
    private $authorName;
    private $authorPicture;
    private $postId;
    private $createdAt;

    function __construct(
        $id,
        $content,
        $userId,
        $postId,
        $createdAt,
        $username,
        $userPicture
    ) {
        $this->id = $id;
        $this->content = $content;
        $this->authorId = $userId;
        $this->postId = $postId;
        $this->createdAt = $createdAt;
        $this->authorName = $username;
        $this->authorPicture = $userPicture;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getUserId()
    {
        return $this->authorId;
    }

    public function getUsername()
    {
        return $this->authorName;
    }

    public function getUserPicture()
    {
        return $this->authorPicture;
    }

    public function getCreatedAt()
    {
        $createdAtDate = DateTime::createFromFormat('Y-m-d H:i:s', $this->createdAt);
        return $createdAtDate->format('d/m/Y');
    }
}
