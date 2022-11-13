<?php
include_files(array(
    "DbConnectionController",
    "Console",
    "PostModel"
));

class PostController
{
    private $postModel;

    public function __construct()
    {
        $this->postModel = new PostModel;
    }

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

        if (isset($title) && isset($description) && isset($isPublic) && isset($isSticky)  && isset($userId)  && isset($StatusId)) {
            $data = array(
                'title' => $title,
                'description' =>  $description,
                'isPublic' => $isPublic,
                'isSticky' => $isSticky,
                'userId' =>  $userId,
                'statusId' =>  $StatusId
            );
            $this->postModel->createPost($data);
        } else {
            // thow an error error
        }
    }

    public function fetchAll()
    {
        return $this->postModel->getAll();
    }

    public function fetchById($id)
    {
        if (isset($id)) {
            return $this->postModel->getById($id);
        }
    }
}
