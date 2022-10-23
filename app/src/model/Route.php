<?php 

class Route{

    private $routeName;
    private $path;
    private $handler;
    private $methods = [];
    private $attributes = [];


    public function __construct($name, $path, $handler, $methods = ['GET'])
    {
        if ($methods === []) {
            // throw new \InvalidArgumentException('HTTP methods argument was empty; must contain at least one method');
        }
        $this->routeName = $name;
        $this->path = $path;
        $this->handler = $handler;
        $this->methods = $methods;
    }

    public function match(string $path, string $method)
    {

        $regex = $this->getPath();
        foreach ($this->getVarsNames() as $variable) {
            $varName = trim($variable, '{\}');
            $regex = str_replace($variable, '(?P<' . $varName . '>[^/]++)', $regex);
        }
        
        $trimmedPath = '/' . rtrim(ltrim(trim($path), '/'), '/');

        if (in_array($method, $this->getMethods()) && preg_match('#^' . $regex . '$#sD', $trimmedPath, $matches)) {
            $values = array_filter($matches, static function ($key) {
                return is_string($key);
            }, ARRAY_FILTER_USE_KEY);
            foreach ($values as $key => $value) {
                $this->attributes[$key] = $value;
            }
            return true;
        }
        return false;
    }

    public function getVarsNames()
    {
        preg_match_all('/{[^}]*}/', $this->path, $matches);
        return reset($matches) ?? [];
    }
    public function getMethods()
    {
        return $this->methods;
    }
    public function getName()
    {
        return $this->routeName;
    }
    public function getPath()
    {
        return $this->path;
    }
    public function getHandlers()
    {
        return $this->handler;
    }
    public function getAttributes()
    {
        return $this->attributes;
    }


}