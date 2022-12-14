<?php

class Reaction
{
    private $reactionId;
    private $userId;
    private $postId;
    private $createdAt;

    function __construct(
        $reactionId,
        $userId,
        $postId,
        $createdAt
    ) {
        $this->reactionId = $reactionId;
        $this->userId = $userId;
        $this->postId = $postId;
        $this->createdAt = $createdAt;
    }

    public function getId()
    {
        return $this->reactionId;
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
        return  '<i class="las la-heart"></i>';
    }
}
