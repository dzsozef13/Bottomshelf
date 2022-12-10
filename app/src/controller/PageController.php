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


    public function load($args)
    {
        /**
         * If the route is for logged in users only, redirect unauthorised user to login
         */
        $currentSession = new SessionController();
        if (isset($args['auth']) && $currentSession->getUser() == null) {
            new Router("Login");
        }

        // Configure view in session
        $session = new SessionController();
        if (isset($args['filter'])) {
            $exploreFilter = $args['filter'];
            $session->setExploreFilter($exploreFilter);
        } else {
            $session->setExploreFilter(null);
        }

        // Selected Post
        if (isset($args['selectedPost'])) {
            $postId = $args['selectedPost'];
            $session->setSelectedPostId($postId);
        } else {
            $session->setSelectedPostId(null);
        }

        // Selected User
        if (isset($args['selectedUser'])) {
            $userId = $args['selectedUser'];
            $session->setUserProfileId($userId);
        } else {
            $session->setUserProfileId(null);
        }

        // System message
        if (isset($args['systemMessage'])) {
            $systemMessage = $args['systemMessage'];
            $session->setSystemMessage($systemMessage);
        } else {
            $session->setSystemMessage(null);
        }

        // View
        if (isset($args['view'])) {

            // Configure session values
            $this->configureSession();
            // Render view
            $view = $args['view'];

            if (isset($args['auth'])) {
                if ($args['auth'] === true) {
                    $this->viewCtrl->renderView($view, true);
                } else {
                    $this->viewCtrl->renderView($view, false);
                }
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
        // TODO: make this work
    }
}
