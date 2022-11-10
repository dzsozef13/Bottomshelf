<?php 
include_files(array(
    "Console",
    "Route",
));

class ViewController {

    public $name;

    public function render($viewName) {
        $this->name = $viewName;
        $layoutContent = $this->layout();
        $viewContent = $this->renderView($viewName);
        echo str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function layout() {
        ob_start();
        include_once $_SERVER['DOCUMENT_ROOT']."/public/layouts/UserLayout.php";
        return ob_get_clean();
    }

    public function renderView($viewName) {
        ob_start();
        include_once $_SERVER['DOCUMENT_ROOT']."/src/view/".$viewName.".php";
        return ob_get_clean();
    }

  

    // public function render($view) {
    //     console_log("Rendering: " . $view);
    //     include_files(array(ucfirst($view)));
    // }

    public function print($message) {
        echo $message;
    }

}