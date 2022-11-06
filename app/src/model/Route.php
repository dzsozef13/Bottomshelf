<?php 

class Route {

    private $routeName;
    private $path;
    private $params;

    public function __construct(string $name, string $path, array $params = []) {
        $this->routeName = $name;
        $this->path = $path;
        $this->params = $params;
    }

    public function getName() {
        return $this->routeName;
    }

    public function getPath() {
        return $this->path;
    }

    public function getParams() {
        return $this->params;
    }

}