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
        $sessionController = new SessionController();
        $searchPhrase = $sessionController->getSearchPhrase();
        $tagUrl = $searchPhrase ? 'Explore?searchPhrase=' . $searchPhrase . '&searchTag=' . $this->getId() : 'Explore?searchTag=' . $this->getId();

        $template = '<a class="tag-chip" href="' . $tagUrl . '">
                            ' . $this->getTagName() . '
                        </a>';
        return $template;
    }
}
