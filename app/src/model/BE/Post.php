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
        $latestComment,
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
        $this->latestComment = $latestComment;
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
        return $this->authorName;
    }

    public function getAuthorId()
    {
        return $this->authorId;
    }

    public function getIsPublic()
    {
        return $this->isPublic;
    }

    public function getReactionCount()
    {
        return $this->reactionCount;
    }

    public function getCommentCount()
    {
        return $this->commentCount;
    }

    public function getLatestComment()
    {
        return $this->latestComment;
    }

    public function getCreatedAt()
    {
        $createdAtDate = DateTime::createFromFormat('Y-m-d H:i:s', $this->createdAt);
        return $createdAtDate->format('d/m/Y');
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
