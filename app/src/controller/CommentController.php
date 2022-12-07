<?php
include_files(array(
    "DbConnectionController",
    "Console",
    "CommentModel"
));

class CommentController
{

    public function create()
    {

        $commentModel = new CommentModel();
        $sessionController = new SessionController();

        $content = $_POST['comment'];
        $userId = $sessionController->getUser()['userId'];
        $postId = $sessionController->getSelectedPostId();

        if (isset($content) && isset($postId) && isset($userId)) {
            $data = array(
                'content' => $content,
                'userId' =>  $userId,
                'postId' => $postId
            );
            $commentModel->createComment($data);
        }
        new Router('SelectedPost?id=' . $postId);
    }

    public function fetchAllByPostId(int $postId)
    {
        $commentModel = new CommentModel();
        return $commentModel->getAllCommentsByPostId($postId);
    }

    public function delete()
    {
        $commentModel = new CommentModel();
        $sessionController = new SessionController();

        $postId = $sessionController->getSelectedPostId();

        if (isset($_GET['commentId'])) {
            $commentModel->deleteComment($_GET['commentId']);
        }
        new Router('SelectedPost?id=' . $postId);
    }
}
