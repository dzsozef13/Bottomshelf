<?php
include_files(array(
    "Console",
    "ViewController",
    "PostController"
));
class PageController

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

    public function aboutPage()
    {
        $this->viewCtrl->renderView('about');
    }


    public function loginPage()
    {
        $this->viewCtrl->renderView('login');
    }
    public function dashboardPage()
    {
        $this->viewCtrl->renderView('dashboard');
    }
}
