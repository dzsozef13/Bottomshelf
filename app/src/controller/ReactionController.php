<?php
include_files(array(
    "DbConnectionController",
    "Console",
    "ReactionModel"
));

class ReactionController
{

    public function react()
    {

        $reactionType = $_GET['reactionType'];
        $reactionId = isset($_GET['reactionId']) ? $_GET['reactionId'] : null;
        $postId = isset($_GET['selectedPost']) ? $_GET['selectedPost'] : null;

        if (isset($postId)) {
            if (isset($reactionId)) {
                $this->deleteReaction($reactionId, $postId);
            } else {
                if (isset($reactionType)) {
                    $this->create($reactionType, $postId);
                }
            }
        } else {
            new Router('Explore');
        }
    }

    public function create($reactionType, $postId)
    {

        $reactionModel = new ReactionModel();
        $sessionController = new SessionController();

        $userId = $sessionController->getUser()['userId'];

        if (isset($reactionType) && isset($postId) && isset($userId)) {
            $data = array(
                'reactionType' => $reactionType,
                'userId' =>  $userId,
                'postId' => $postId
            );

            $reactionModel->createReaction($data);
        }
        new Router('SelectedPost?selectedPost=' . $postId);
    }

    public function deleteReaction(int $reactionId, $postId)
    {
        $reactionModel = new ReactionModel();
        $sessionController = new SessionController();
        $postId = $sessionController->getSelectedPostId();

        if (isset($reactionId)) {
            $reactionModel->deleteReaction($reactionId);
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
