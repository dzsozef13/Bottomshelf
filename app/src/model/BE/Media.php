<?php

class Media
{

    private $id;
    private $imageBlob;
    private $ownerId;

    function __construct(
        $id,
        $imageBlob,
        $userId
    ) {
        $this->id = $id;
        $this->imageBlob = $imageBlob;
        $this->ownerId = $userId;
    }

    public function getId()
    {
        return htmlspecialchars($this->id);
    }

    public function getImage()
    {
        return  $this->imageBlob;
    }

    public function getOwner()
    {
        return htmlspecialchars($this->ownerId);
    }
}
