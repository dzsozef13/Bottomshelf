<?php

class Reaction
{
    private $reactionId;
    private $reactionType;
    private $userId;
    private $postId;
    private $createdAt;

    function __construct(
        $reactionId,
        $reactionType,
        $userId,
        $postId,
        $createdAt
    ) {
        $this->reactionId = $reactionId;
        $this->reactionType = $reactionType;
        $this->userId = $userId;
        $this->postId = $postId;
        $this->createdAt = $createdAt;
    }

    public function getId()
    {
        return $this->reactionId;
    }

    public function getReactionName()
    {
        return $this->reactionType;
    }
    public function getAuthorId()
    {
        return $this->userId;
    }
    public function getPostId()
    {
        return $this->postId;
    }
    public function getReactionIcon()
    {
        $name = $this->reactionName;
        if ($name == "Heart") {
            return '<i class="las la-heart"></i>';
        } else if ($name == "ThumbsDown") {
            return '<i class="las la-thumbs-down"></i>';
        }
    }
}
