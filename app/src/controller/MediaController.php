<?php
include_files(array(
    "DbConnectionController",
    "SessionController",
    "Router",
    "Route",
    "Console",
    "MediaModel"
));

class MediaController
{

    public function fetchMediaForPost($postId)
    {
        $mediaModel = new MediaModel();
        return $mediaModel->getMediaForPost($postId);
    }

} 