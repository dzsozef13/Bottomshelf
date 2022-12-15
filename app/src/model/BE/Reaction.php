<?php

class Reaction
{
    private int $reactionId;
    private int $userId;
    private int $postId;
    private string $createdAt;

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

    public function getId(): int
    {
        return $this->reactionId;
    }

    public function getAuthorId(): int
    {
        return $this->userId;
    }
    public function getPostId(): int
    {
        return $this->postId;
    }
    public function getReactionIcon(): string
    {
        return  '<i class="las la-heart"></i>';
    }
}
