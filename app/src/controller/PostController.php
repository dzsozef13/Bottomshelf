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
        $isPublic = 1;
        $isSticky = 1;
        $sessionController = new SessionController();
        $userId = $sessionController->getUser()['userId'];
        $statusId = 1;
        $data = [];

        if (isset($title) && isset($description) && isset($isPublic) && isset($isSticky)  && isset($userId)  && isset($statusId)) {
            $data = array(
                'title' => $title,
                'description' =>  $description,
                'isPublic' => $isPublic,
                'isSticky' => $isSticky,
                'userId' =>  $userId,
                'statusId' =>  $statusId
            );
            $postId = $this->postModel->createPost($data);

            $uploadedMediaIdArray = $sessionController->getUploadedMediaIdArray();
            foreach ($uploadedMediaIdArray as $uploadedMediaId) {
                $this->postModel->connectPostWithMedia($postId, $uploadedMediaId);
            }

            // Redirect to profile
            $redirect = new Router("Profile");
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

    public function fetchAllWithOptions($phrase, $tag, $sorting)
    {
        // TODO: No need to check for nll for now, test all possible configurations!
        return $this->postModel->getAllWithOptions($phrase, $tag, $sorting);
    }

    public function fetchByTag($tag) {
        if (isset($tag)) {
            return $this->postModel->getAllByTag($tag);
        }
    }
}
