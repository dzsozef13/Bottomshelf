<?php

class Post
{
    private int $id;
    private string $title;
    private string $description;
    private bool $isPublic;
    private bool $isSticky;
    private string $createdAt;
    private int $authorId;
    private string $authorName;
    private ?string $latestComment;
    private ?int $childPostId;
    private int $statusId;
    private int $reactionCount;
    private int $commentCount;
    private ?array $media;

    function __construct(
        $id,
        $title,
        $description,
        $reactionCount,
        $commentCount,
        $isPublic,
        $isSticky,
        $createdAt,
        $authorId,
        $authorName,
        $content,
        $childPostId,
        $statusId
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->reactionCount = $reactionCount;
        $this->commentCount = $commentCount;
        $this->isPublic = $isPublic;
        $this->isSticky = $isSticky;
        $this->createdAt = $createdAt;
        $this->authorId = $authorId;
        $this->authorName = $authorName;
        $this->latestComment = $content;
        $this->childPostId = $childPostId;
        $this->statusId = $statusId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return htmlspecialchars($this->title);
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getIsSticky(): bool
    {
        return $this->isSticky;
    }

    public function getAuthorName(): string
    {
        return htmlspecialchars($this->authorName);
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    public function getIsPublic(): bool
    {
        return $this->isPublic;
    }

    public function getReactionCount(): int
    {
        return $this->reactionCount;
    }

    public function getCommentCount(): int
    {
        return $this->commentCount;
    }

    public function getLatestComment(): ?string
    {
        return $this->latestComment;
    }

    public function getCreatedAt(): string
    {
        $createdAtDate = DateTime::createFromFormat('Y-m-d H:i:s', $this->createdAt);
        return htmlspecialchars($createdAtDate->format('d/m/Y'));
    }

    public function getAllMedia(): array
    {
        return $this->media;
    }

    public function getCoverImageForPost(): mixed
    {
        if (isset($this->getAllMedia()[0])) {
            $firstImage = $this->getAllMedia()[0];
            if (isset($firstImage)) {
                $firstImgBlob = $firstImage->getImage();
            } else {
                $firstImgBlob = null;
            }
            return $firstImgBlob;
        } else {
            return null;
        }
    }

    /** 
     * @param Media[]
     */
    public function setMedia(array $mediaArray)
    {
        $this->media = $mediaArray;
    }
}
