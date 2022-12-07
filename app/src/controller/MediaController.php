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
        // Expected file names
        $mediaNames = array(
            'media1',
            'media2',
            'media3',
        );

        // Collect all posted media in an array
        $mediaArray = array();
        if (isset($_POST['submit'])) {
            foreach ($mediaNames as $mediaName) {
                if (isset($_POST["submit"])) {
                    if (!empty($_FILES[$mediaName]["name"])) {
                        // Get file info 
                        $fileName = basename($_FILES[$mediaName]["name"]);
                        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

                        // Allow certain file formats 
                        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
                        if (in_array($fileType, $allowTypes)) {
                            $image = $_FILES[$mediaName]['tmp_name'];
                            $imgContent = file_get_contents($image);
                            echo $mediaName . " is uploaded: " . $_FILES[$mediaName]['name'];
                            // Insert into media array
                            $mediaArray[] = $imgContent;
                        } else {
                            echo "<br>wrong format of " . $mediaName;
                        }
                    } else {
                        echo "<br>no file was submitted as " . $mediaName;
                    }
                }
            }
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

            // Redirect to Create view with media IDs

            // $mediaIndex = 1;
            // $routeParamsString = '?';
            // foreach ($uploadedMediaIdArray as $uploadedMediaId) {
            //     $routeParamsString = $routeParamsString . 'media' . $mediaIndex . '=' . $uploadedMediaId . '&';
            //     $mediaIndex ++;
            // }
            // $redirect = new Router("Create" . substr($routeParamsString, 0, -1));

            // Set uploaded media IDs in the session
            $sessionController = new SessionController();
            $sessionController->setUploadedMediaIdArray($uploadedMediaIdArray);
            $redirect = new Router("Create");
        }
    }
}
