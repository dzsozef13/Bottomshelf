<?php

class Route
{

    private string $routeName;
    private string $path;
    private array $params;

    public function __construct(string $name, string $path, array $params = [])
    {
        $this->routeName = $name;
        $this->path = $path;
        $this->params = $params;
    }

    public function getName(): string
    {
        return $this->routeName;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}
