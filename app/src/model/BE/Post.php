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
    private $authorName;
    private $latestComment;
    private $childPostId;
    private $statusId;
    private $reactionCount;
    private $commentCount;
    private $media;

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

    public function getId()
    {
        return htmlspecialchars($this->id);
    }

    public function getTitle()
    {
        return htmlspecialchars($this->title);
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getIsSticky()
    {
        if ($this->isSticky == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getAuthorName()
    {
        return htmlspecialchars($this->authorName);
    }

    public function getAuthorId()
    {
        return htmlspecialchars($this->authorId);
    }

    public function getIsPublic()
    {
        return htmlspecialchars($this->isPublic);
    }

    public function getReactionCount()
    {
        return htmlspecialchars($this->reactionCount);
    }

    public function getCommentCount()
    {
        return htmlspecialchars($this->commentCount);
    }

    public function getLatestComment()
    {
        return $this->latestComment;
    }

    public function getCreatedAt()
    {
        $createdAtDate = DateTime::createFromFormat('Y-m-d H:i:s', $this->createdAt);
        return htmlspecialchars($createdAtDate->format('d/m/Y'));
    }

    public function getAllMedia()
    {
        return $this->media;
    }

    public function getCoverImageForPost()
    {
        if (isset($this->getAllMedia()[0])) {
            $firstImage = $this->getAllMedia()[0];
            if (isset($firstImage)) {
                $firstImgBlob = $firstImage->getImage();
            } else {
                $firstImgBlob = null;
            }
            return $firstImgBlob;
        }
    }

    /** 
     * @param Media[]
     */
    public function setMedia($mediaArray)
    {
        $this->media = $mediaArray;
    }
}
