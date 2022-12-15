<?php

class Media
{

    private int $id;
    private string $imageBlob;
    private int $ownerId;

    function __construct(
        $id,
        $imageBlob,
        $userId
    ) {
        $this->id = $id;
        $this->imageBlob = $imageBlob;
        $this->ownerId = $userId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getImage(): string
    {
        return $this->imageBlob;
    }

    public function getOwner(): int
    {
        return $this->ownerId;
    }
}
