<?php 
include_files(array(
    "Console",
    "Route",
));

class ViewController {

    public function renderView($viewName)
    {
        $layoutName = "GuestLayout";
        // todo : add logic which will switch layouts depending on if the user is logged in or not
        $layoutContent = $this->getLayoutContent($layoutName);
        $viewContent = $this->getViewContent($viewName);
        echo str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function getLayoutContent($layoutName)
    {
        ob_start();
        include_files(array($layoutName));
        return ob_get_clean();
    }

    public function getViewContent($viewName)
    {
        ob_start();
        include_files(array($viewName));
        return ob_get_clean();
    }

}