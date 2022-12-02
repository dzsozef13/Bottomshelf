<?php

class Tag
{
    private int $id;
    private string $tagName;

    function __construct(
        $id,
        $tagName
    ) {
        $this->id = $id;
        $this->tagName = $tagName;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTagName(): string
    {
        return $this->tagName;
    }

    public function getTagTemplate(): string
    {
        $template = '<div class="tag-chip">
                            ' . $this->getTagName() . '
                        </div>';
        return $template;
    }
}
