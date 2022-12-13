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

        $reactionType = $_POST['reactionType'];
        $userId = $sessionController->getUser()['userId'];
        $postId = $sessionController->getSelectedPostId();

        if (isset($reactionType) && isset($postId) && isset($userId)) {
            $data = array(
                'reactiontype' => $reactionType,
                'userId' =>  $userId,
                'postId' => $postId
            );
            $reactionModel->createReaction($data);
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

    public function deleteReaction(int $reactionId)
    {
        $reactionModel = new ReactionModel();
        $sessionController = new SessionController();
        $postId = $sessionController->getSelectedPostId();

        if (isset($reactionId)) {
            $reactionModel->deleteReaction($reactionId);
        }
        new Router('SelectedPost?selectedPost=' . $postId);
    }
}
