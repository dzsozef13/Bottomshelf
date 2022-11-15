<?php
include_files(array(
    "Console",
    "Route",
));

class ViewController
{

    public function renderView($viewName)
    {
        // todo : add logic which will switch layouts depending on if the user is logged in or not
        if ($viewName === "Dashboard" || $viewName === "Explore"  || $viewName === "Profile") {
            $layoutName = "UserLayout";
        } else {
            $layoutName = "GuestLayout";
        }

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
