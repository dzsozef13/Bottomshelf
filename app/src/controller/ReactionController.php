<?php
include_files(array(
    "DbConnectionController",
    "Console",
    "ReactionModel"
));

class ReactionController
{

    public function create()
    {
        $reactionModel = new ReactionModel();
        $sessionController = new SessionController();

        $postId = $sessionController->getSelectedPostId();
        $userId = $sessionController->getUser()['userId'];

        if (isset($postId) && isset($userId)) {
            $data = array(
                'userId' =>  $userId,
                'postId' => $postId
            );

            $reactionModel->createReaction($data);
        }
        new Router('SelectedPost?selectedPost=' . $postId);
    }

    public function deleteReaction()
    {
        $reactionModel = new ReactionModel();
        $sessionController = new SessionController();

        $postId = $sessionController->getSelectedPostId();
        $userId = $sessionController->getUser()['userId'];

        if (isset($postId) && $userId) {
            $reactionModel->deleteReaction($postId, $userId);
        }
        new Router('SelectedPost?selectedPost=' . $postId);
    }

    public function fetchById(int $reactionId)
    {
        $reactionModel = new ReactionModel();
        return $reactionModel->getById($reactionId);
    }

    public function fetchAllByPostId(int $postId)
    {
        $reactionModel = new ReactionModel();
        return $reactionModel->getByPostId($postId);
    }

    public function fetchAll()
    {
        $reactionModel = new ReactionModel();
        return $reactionModel->getAll();
    }
}
