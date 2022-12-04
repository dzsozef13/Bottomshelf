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
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $isPublic = $_POST['isPublic'];
        $isSticky = 1;
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

    public function fetchAll(int $statusId = 1, bool $isPublic = true)
    {
        return $this->postModel->getAll($statusId, $isPublic);
    }

    public function fetchById(int $id): Post
    {
        if (isset($id)) {
            return $this->postModel->getById($id);
        }
    }

    public function fetchByUserId(int $userId)
    {
        if (isset($userId)) {
            return $this->postModel->getAllByUserId($userId);
        }
    }
}
