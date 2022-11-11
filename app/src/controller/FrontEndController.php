<?php
include_files(array(
    "Console",
    "ViewController",
    "PostController"
));
class FrontEndController

{
    private $viewCtrl;
    public function __construct()
    {
        $this->viewCtrl = new ViewController();
    }


    public function homePage()
    {
        $this->viewCtrl->renderView('home');
        // Just a test of how we could fetch and display data on pages
        // Find a way to map data

        // $postCtrl = new PostController();
        // var_dump($postCtrl->fetchAll());
    }
}
