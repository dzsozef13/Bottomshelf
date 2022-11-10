<?php 
include_files(array(
    "Console",
    "Route",
));

class ViewController {

    public $name;

    public function renderView($viewName) {
        $this->name = $viewName;
        // todo : add logic which will switch layouts depending on if the user is logged in or not
        $layoutContent = $this->getLayoutContent("GuestLayout");
        $viewContent = $this->getViewContent($viewName);
        echo str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function getLayoutContent($layoutName) {
        ob_start();
        include_once $_SERVER['DOCUMENT_ROOT']."/public/layouts/".$layoutName.".php";
        return ob_get_clean();
    }

    public function getViewContent($viewName) {
        ob_start();
        include_once $_SERVER['DOCUMENT_ROOT']."/src/view/".$viewName.".php";
        return ob_get_clean();
    }

    public function print($message) {
        echo $message;
    }

}