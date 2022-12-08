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
    private $media;

    function __construct(
        $id,
        $title,
        $description,
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

    public function getLatestComment()
    {
        return $this->latestComment;
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

    public function getPostTemplate(): string
    {
        $template = '<div class="post-card-container">
                        <!-- Post Image -->
                        ' . ($this->getCoverImageForPost() === null ? '' : '<div class="post-card-img">
                                <img class="post-img" src="data:image/*;charset=utf8;base64,' . base64_encode($this->getCoverImageForPost()) . '" />
                            </div>') . '
                        <!-- Post Body -->
                        <div class="post-card-body">
                            <!-- Post Header -->
                            <div class="post-card-header">
                                <h3 class="post-card-title">' . $this->getTitle() . '</h3>
                                <p class="post-card-user">by @' . $this->getAuthorName() . '</p>
                            </div>
                            <!-- Post Comment -->
                              ' . ($this->getLatestComment() === null ? '' : '<div class="post-card-comment-wrapper">
                                <div class="small-logo">
                                    <i class="las la-smile text-background-black-900 text-xl"></i>
                                </div>
                                <div class="post-card-comment">
                                ' . $this->getLatestComment() . '
                                </div>
                            </div>') . '
                            <!-- Post Reactions -->
                            <div class="post-card-reactions-wrapper">
                                🌸 ✅ 👀
                            </div>
                        </div>
                    </div>';
        return $template;
    }

    // public function getImageUrl()
    // {
    //     return $this-$imageUrl;
    // }

}
