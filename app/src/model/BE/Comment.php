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
        return $this->authorPicture;
    }

    public function getCreatedAt()
    {
        $createdAtDate = DateTime::createFromFormat('Y-m-d H:i:s', $this->createdAt);
        return $createdAtDate->format('d/m/Y');
    }

    public function getCommentTemplate(): string
    {
        $template = '
        <div class="comment-container">
            <div class="comment-picture-container">
                <img class="img" src="data:image/*;charset=utf8;base64,' . base64_encode($this->getUserPicture()) . '" alt="">
            </div>
            <div class="comment-body-container">
                <div class="comment-headline">
                    <h6 class="headline">' . $this->getUsername() . '</h6>
                    <p class="text-xs text-dim-white-900/40">' . $this->getCreatedAt() . '</p>
                </div>
                <p class="text-xs">' . $this->getContent() . '</p>
            </div>
        </div>
        
        ';
        return $template;
    }
}
