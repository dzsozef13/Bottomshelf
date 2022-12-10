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
            if ($currentSession->getUser()['roleId'] == 2) {
                $linkToAdminView = '<a href="/Overview">
                                        <li class="mb-4 ' . ($_SERVER['REQUEST_URI'] === '/Overview' ? 'text-highlight-green-900' : "") . '">Overview</li>
                                    </a>';
            } else {
                $linkToAdminView = '';
            }

            $toBeReplaced = array('{{adminView}}', '{{content}}');
            $replacements = array($linkToAdminView, $viewContent);
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
