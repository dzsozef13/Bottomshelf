<?php
include_files(array(
    "Console",
    "Route",
    "SessionController"
));

class ViewController
{

    protected $sessionCtrl;

    public function renderView(string $viewName, bool $isAuthPage)
    {
        $layoutContent = $this->getLayoutContent($isAuthPage === true ? "UserLayout" : "GuestLayout");
        $viewContent = $this->getViewContent($viewName);

        if ($isAuthPage === true) {
            $currentSession = new SessionController();

            $toBeReplaced = array('{{content}}', '{{username}}');
            $replacements = array($viewContent, $currentSession->getUser()['username']);
            echo str_replace($toBeReplaced, $replacements, $layoutContent);
        } else {
            echo str_replace('{{content}}', $viewContent, $layoutContent);
        }
    }

    public function getLayoutContent(string $layoutName)
    {
        ob_start();
        include_files(array($layoutName));
        return ob_get_clean();
    }

    public function getViewContent(string $viewName)
    {
        ob_start();
        include_files(array($viewName));
        return ob_get_clean();
    }

    public function getTemplateContent(string $templateName)
    {
        ob_start();
        include_files(array($templateName));
        return ob_get_clean();
    }
}
