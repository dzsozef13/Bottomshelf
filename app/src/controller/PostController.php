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
        $sessionController = new SessionController();

        $title = $_POST['title'];
        $description = $_POST['description'];
        $isPublic = isset($_POST['isPublic']) ? 1 : 0;
        $isSticky = 0;
        $userId = $sessionController->getUser()['userId'];
        $statusId = 1;
        $reactionCount = 0;
        $commentCount = 0;

        if (isset($title) && isset($description) && isset($isPublic) && isset($isSticky)  && isset($userId)  && isset($statusId)) {
            $data = array(
                'title' => $title,
                'description' =>  $description,
                'isPublic' => $isPublic,
                'isSticky' => $isSticky,
                'userId' =>  $userId,
                'reactionCount' =>  $reactionCount,
                'commentCount' =>  $commentCount,
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

    public function fetchAll()
    {
        $postModel = new PostModel;
        return $postModel->getAll();
    }

    public function fetchAllByStatus(int $statusId = 1, bool $isPublic = true)
    {
        $postModel = new PostModel;
        return $postModel->getAllByStatus($statusId, $isPublic);
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

    public function update()
    {
        $postModel = new PostModel;
        $sessionController = new SessionController();
        $postId = $sessionController->getSelectedPostId();

        if (isset($_POST['title']) && isset($_POST['description']) && isset($postId)) {
            $data = array(
                "title" => $_POST['title'],
                "description" => $_POST['description'],
                "isPublic" => isset($_POST['isPublic']) ? 1 : 0,
            );
            $postModel->updatePost($postId, $data);
        }
        new Router('SelectedPost?selectedPost=' . $postId);
    }

    public function fetchByPhrase($phrase)
    {
        if (isset($phrase)) {
            $postModel = new PostModel;
            return $postModel->getAllByPhrase($phrase);
        }
    }

    public function fetchByTag($tag)
    {
        if (isset($tag)) {
            $postModel = new PostModel;
            return $postModel->getAllByTag($tag);
        }
    }

    public function markAsSticky()
    {
        $postModel = new PostModel;
        $sessionController = new SessionController();
        $postId = $sessionController->getSelectedPostId();

        if (isset($postId)) {
            $postModel->markAsSticky($postId);
        }

        new Router('SelectedPost?selectedPost=' . $postId);
    }

    public function markAsNotSticky()
    {
        $postModel = new PostModel;
        $sessionController = new SessionController();
        $postId = $sessionController->getSelectedPostId();

        if (isset($postId)) {
            $postModel->markAsNotSticky($postId);
        }

        new Router('SelectedPost?selectedPost=' . $postId);
    }

    /**
     * Soft delete post
     */
    public function markAsDeleted()
    {
        $postModel = new PostModel;
        $sessionController = new SessionController();
        $postId = $sessionController->getSelectedPostId();

        if (isset($postId)) {
            $postModel->updatePostStatus($postId, 4);
        }

        new Router('Profile');
    }

    /**
     * Hard delete post
     */
    public function deletePost()
    {
        // Post model to delete the post
        $postModel = new PostModel;

        $sessionController = new SessionController();
        // tags and reactions controller to be added

        // Post id from session
        $postId = $sessionController->getSelectedPostId();

        if (isset($postId)) {
            $postModel->deletePost($postId);
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
