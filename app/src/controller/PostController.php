<?php
include_files(array(
    "DbConnectionController",
    "Console",
    "PostModel"
));

class PostController
{

    public function create()
    // todo: add image property when we plan how to handle images
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $isPublic = $_POST['isPublic'];
        $isSticky = 1;
        // when we have session working, change this to get the currently logged in user
        $userId = $_POST['userId'];
        $StatusId = 1;
        $data = [];
        $postModel = new PostModel();

        if (isset($title) && isset($description) && isset($isPublic) && isset($isSticky)  && isset($userId)  && isset($StatusId)) {
            $data = array(
                'title' => $title,
                'description' =>  $description,
                'isPublic' => $isPublic,
                'isSticky' => $isSticky,
                'userId' =>  $userId,
                'statusId' =>  $StatusId
            );
            $postModel->createPost($data);
        } else {
            // thow error or something
        }
    }
}
