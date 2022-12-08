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
                if (!empty($_FILES[$mediaName]["name"])) {
                    // Get file info 
                    $fileName = basename($_FILES[$mediaName]["name"]);
                    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

                    // Allow certain file formats 
                    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
                    if (in_array($fileType, $allowTypes)) {
                        $image = $_FILES[$mediaName]['tmp_name'];
                        $imgContent = file_get_contents($image);
                        console_log($mediaName . " is uploaded: " . $_FILES[$mediaName]['name']); 
                        // Insert into media array
                        $mediaArray[] = $imgContent;
                    } else {
                        // Redirect to Upload with message "Wrong format"
                        $errorMessage = "Failed to upload file becase of unsupported format.";
                        $redirect = new Router("Upload?systemMessage=" . $errorMessage);
                        return;
                    }
                }
            }
        } else {
            // Redirect to Upload with message "Wrong format"
            $errorMessage = "Failed to upload file, it might be damaged or too large.";
            $redirect = new Router("Upload?systemMessage=" . $errorMessage);
            return;
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

            // Set uploaded media IDs in the session
            $sessionController = new SessionController();
            $sessionController->setUploadedMediaIdArray($uploadedMediaIdArray);
            $redirect = new Router("Create");
        } else {
            // Redirect to Upload with message "Wrong format"
            $errorMessage = "Oops, something went wrong. Please log in and try again.";
            $redirect = new Router("Login?systemMessage=" . $errorMessage);
            return;
        }
    } 
}
