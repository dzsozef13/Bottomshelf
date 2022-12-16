<?php

class Comment
{

    private int $id;
    private string $content;
    private int $authorId;
    private string $authorName;
    private ?string $authorPicture;
    private int $postId;
    private string $createdAt;

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

    public function getId(): int
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return htmlspecialchars($this->content);
    }

    public function getUserId(): int
    {
        return $this->authorId;
    }

    public function getUsername(): string
    {
        return  htmlspecialchars($this->authorName);
    }

    public function getUserPicture(): ?string
    {
        return $this->authorPicture;
    }

    public function getCreatedAt(): string
    {
        $createdAtDate = DateTime::createFromFormat('Y-m-d H:i:s', $this->createdAt);
        return htmlspecialchars($createdAtDate->format('d/m/Y'));
    }
}
