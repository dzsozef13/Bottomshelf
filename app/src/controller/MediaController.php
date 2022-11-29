<?php
include_files(array(
    "Console",
    "SessionController",
    "MediaModel",
    "CoreModel",
));

class MediaController
{

    /**
     * Fetches all media for post with passed ID
     */
    public function fetchMediaForPost($postId)
    {
        $mediaModel = new MediaModel();
        return $mediaModel->getMediaForPost($postId);
    }

    /**
     * Uploads the submitted media
     * Signs it with the user ID of the current session
     */
    public function uploadMedia() 
    {
        // Collect all posted media in an array
        $mediaArray = array();
        if ($_POST['media1'] != null) {
            $mediaArray[] = $_POST['media1'];
        }
        if ($_POST['media2'] != null) {
            $mediaArray[] = $_POST['media2'];
        }
        if ($_POST['media3'] != null) {
            $mediaArray[] = $_POST['media3'];
        }
    
        // Get the user ID from the current session
        $session = new SessionController();
        $userId = $session->getUser()['userId'];

        if (isset($userId, $mediaArray)) {
            // Will hold all successfully uploaded media's IDs
            $uploadedMediaIdArray = array();

            // Loop through media and upload one-by-one
            foreach ($mediaArray as $media) {

                $data = array(
                    "userId" => $userId,
                    "media" => $media
                );

                $mediaModel = new MediaModel();
                $uploadedMediaId = $mediaModel->uploadMedia($data);

                $uploadedMediaIdArray[] = $uploadedMediaId;
            }

            // TODO: Call a route and pass the IDs to proceed with posting
            // echo var_dump($uploadedMediaIdArray);
        }
    }

} 