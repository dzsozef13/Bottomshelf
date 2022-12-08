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
    private $media;

    function __construct(
        $id,
        $title,
        $description,
        $reactionCount,
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
        $firstImage = $this->getAllMedia()[0];
        if (isset($firstImage)) {
            $firstImgBlob = $firstImage->getImage();
        } else {
            $firstImgBlob = null;
        }
        return $firstImgBlob;
    }

    /** 
     * @param Media[]
     */
    public function setMedia($mediaArray)
    {
        $this->media = $mediaArray;
    }
}
