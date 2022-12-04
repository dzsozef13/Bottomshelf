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

    public function gettUserId()
    {
        return $this->authorId;
    }

    public function getUsername()
    {
        return $this->authorName;
    }

    public function getUserPicture()
    {
        return $this->authorName;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getCommentTemplate(): string
    {
        $template = '
            <div>
        
        ';
        return $template;
    }
}
