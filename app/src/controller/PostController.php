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
        $isPublic = $_POST['isPublic'] ? 1 : 0;
        $isSticky = 1;
        $sessionController = new SessionController();
        $userId = $sessionController->getUser()['userId'];
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
            $postId = $this->postModel->createPost($data);

            $uploadedMediaIdArray = $sessionController->getUploadedMediaIdArray();
            foreach ($uploadedMediaIdArray as $uploadedMediaId) {
                $this->postModel->connectPostWithMedia($postId, $uploadedMediaId);
            }
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

    public function searchPosts()
    {
        $phrase = $_POST['phrase'];

        if (isset($phrase)) {
            return $this->postModel->searchPosts($phrase);
        }
        new Router('Explore');
    }
}
