<?php
include_files(array(
    "Console",
    "MediaModel",
    "SessionController",
));

class MediaController

{

    public function uploadImage()
    {
        if (isset(
            $_POST['submit'],
        )) {

            if (!empty($_FILES["image"]["name"])) {
                // Get file info 
                $fileName = basename($_FILES["image"]["name"]);
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

                // Allow certain file formats 
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
                if (in_array($fileType, $allowTypes)) {
                    $image = $_FILES['image']['tmp_name'];
                    $imgContent = addslashes(file_get_contents($image));

                    // Insert image content into database 
                    $media = new MediaModel();
                    $session = new SessionController();
                    $userId = $session->getUser()['userId'];
                    if (isset($userId)) {
                        $uploadData = array('image' => $imgContent, 'userId' => $userId);

                        if ($media->createImage($uploadData)) {
                            new Router("Dashboard");
                        } else {
                            new Router("Profile");
                        }
                    } else {
                        new Router("Profile");
                        $statusMsg = 'Failed to fetch user info';
                        echo $statusMsg;
                    }
                } else {
                    new Router("Profile");
                    $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
                    echo $statusMsg;
                }
            }
        } else {
            new Router("Profile");
        }
    }
}
