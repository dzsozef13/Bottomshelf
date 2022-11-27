<?php
include_files(array(
    "Console",
    "SessionController",
    "MediaModel",
    "CoreModel",
));

class MediaController
{

    public function fetchMediaForPost($postId)
    {
        $mediaModel = new MediaModel();
        return $mediaModel->getMediaForPost($postId);
    }

    public function uploadMedia() 
    {
        if (isset($_POST['image'], )) {
            $image = $_POST['image'];

            $session = new SessionController();
            $userId = $session->getUser()['userId'];

            $data = array(
                "userId" => $userId,
                "image" => $image);

            $mediaModel = new MediaModel();
            $upload = $mediaModel->uploadMedia($data);
            console_log($upload);

            if (isset($upload)) {
                new Router("Explore");
            } else {
                new Router("Dashboard");
            }
        }
    }

} 