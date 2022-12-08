<?php
include_files(array(
    "Console",
    "ViewController",
    "PostController",
    "MediaController"
));

class PageController

{
    protected $viewCtrl;
    public function __construct()
    {
        $this->viewCtrl = new ViewController();
    }

    /**
     * If the route is for logged in users only, redirect unauthorised user to login
     */
    public static function redirectUnauthorized(string $viewName)
    {
        $currentSession = new SessionController();
        if ($currentSession->getUser() != null) {
            return $viewName;
        } else {
            header("Location: " . "Login");
        }
    }

    public function load($args)
    { // Configure view in session
        if (isset($args['filter'])) {
            $exploreFilter = $args['filter'];
            $session = new SessionController();
            $session->setExploreFilter($exploreFilter);
        }
        if (isset($args['selected'])) {
            $postId = $args['selected'];
            $session = new SessionController();
            $session->setSelectedPostId($postId);
        }
        if ($args['view'] == 'Profile') {
            $session = new SessionController();
            if (isset($args['user'])) {
                $userId = $args['user'];
                $session->setUserProfileId($userId);
            } else {
                $session->setUserProfileId(null);
            }
        }
        if (isset($args['view'])) {
            // Configure session values
            $this->configureSession();
            // Render view
            $view = $args['view'];
            if (isset($args['auth']) && $args['auth'] === true) {
                $this->viewCtrl->renderView($this->redirectUnauthorized($view), true);
            } else {
                $this->viewCtrl->renderView($view, false);
            }
        }
    }

    /**
     * Looks for parameters passed from router to set values for the view about to be rendered
     */
    public function configureSession()
    {
        $session = new SessionController();
        if (isset($args['filter'])) {
            $exploreFilter = $args['filter'];
            $session->setExploreFilter($exploreFilter);
        }
        if (isset($args['systemMessage'])) {
            $systemMessage = $args['systemMessage'];
            $session->setSystemMessage($systemMessage);
        }
    }
}
