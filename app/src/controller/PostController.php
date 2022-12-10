<?php
include_files(array(
    "DbConnectionController",
    "Console",
    "PostModel"
));

class PostController
{

    public function create()
    {
        $postModel = new PostModel;
        $title = $_POST['title'];
        $description = $_POST['description'];
        $isPublic = isset($_POST['isPublic']) ? 1 : 0;
        $isSticky = 1;
        $sessionController = new SessionController();
        $userId = $sessionController->getUser()['userId'];
        $statusId = 1;
        var_dump($_POST);
        if (isset($title) && isset($description) && isset($isPublic) && isset($isSticky)  && isset($userId)  && isset($statusId)) {
            $data = array(
                'title' => $title,
                'description' =>  $description,
                'isPublic' => $isPublic,
                'isSticky' => $isSticky,
                'userId' =>  $userId,
                'statusId' =>  $statusId
            );
            $postId = $postModel->createPost($data);

            $uploadedMediaIdArray = $sessionController->getUploadedMediaIdArray();

            foreach ($uploadedMediaIdArray as $uploadedMediaId) {
                $postModel->connectPostWithMedia($postId, $uploadedMediaId);
            }

            // Redirect to profile
            $redirect = new Router("Profile");
        } else {
            // thow an error error
        }
    }

    public function fetchAll(int $statusId = 1, bool $isPublic = true)
    {
        $postModel = new PostModel;
        return $postModel->getAll($statusId, $isPublic);
    }

    public function fetchById(int $id): Post
    {
        $postModel = new PostModel;
        if (isset($id)) {
            return $postModel->getById($id);
        }
    }

    public function fetchByUserId(int $userId)
    {
        $postModel = new PostModel;
        if (isset($userId)) {
            return $postModel->getAllByUserId($userId);
        }
    }

    public function deletePost()
    {
        $postModel = new PostModel;
        $sessionController = new SessionController();
        $postId = $sessionController->getSelectedPostId();
        $commentController = new CommentController();
        // $mediaController = new CommentController();
        // tags and reactions controller to be added

        if (isset($postId)) {
            $postModel->deletePost($postId);
            $commentController->deleteByPostId($postId);
            $redirect = new Router("Profile");
        }
    }

    // public function searchPosts()
    // {
    //     $phrase = $_POST['phrase'];

    //     if (isset($phrase)) {
    //         return $this->postModel->searchPosts($phrase);
    //     }
    //     new Router('Explore');
    // }
}
