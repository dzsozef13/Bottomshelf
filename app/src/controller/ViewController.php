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
        $layoutName = isset($user) ? "UserLayout" : "GuestLayout";

        $layoutContent = $this->getLayoutContent($layoutName);
        $viewContent = $this->getViewContent($viewName);

        if (isset($user)) {
            $toBeReplaced = array('{{content}}', '{{username}}');
            $replacements = array($viewContent, $user['username']);
            echo str_replace($toBeReplaced, $replacements, $layoutContent);
        } else {
            echo str_replace('{{content}}', $viewContent, $layoutContent);
        }
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

    public function getTemplateContent($templateName)
    {
        ob_start();
        include_files(array($templateName));
        return ob_get_clean();
    }
}
