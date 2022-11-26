<?php
include_files(array(
    "Console",
    "ViewController",
    "PostController",
    "MediaController"
));

class PageController

{
    protected $viewCtrl;
    public function __construct()
    {
        $this->viewCtrl = new ViewController();
    }

    public function load($args)
    {
        if ($view = $args['view']) {
            $this->viewCtrl->renderView($view);
        }
    }

}