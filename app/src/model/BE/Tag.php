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
        return htmlspecialchars($this->id);
    }

    public function getTagName(): string
    {
        return htmlspecialchars($this->tagName);
    }

    public function getTagTemplate(): string
    {
        $template = '<a class="tag-chip" href="Explore?searchTag=' . htmlspecialchars($this->getId())  . '">
                            ' . htmlspecialchars($this->getTagName())  . '
                        </a>';
        return $template;
    }
}
