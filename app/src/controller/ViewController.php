<?php
include_files(array(
    "Console",
    "Route",
    "SessionController"
));

class ViewController
{

    protected $sessionCtrl;

    public function __construct()
    {
        $this->sessionCtrl = new SessionController();
    }

    public function renderView($viewName)
    {

        $user = $this->sessionCtrl->getUser();
        if (isset($user)) {
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
