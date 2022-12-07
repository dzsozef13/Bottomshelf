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
        new Router('PostPreview?id=' . $postId);
    }

    public function fetchAllByPostId(int $postId)
    {
        $commentModel = new CommentModel();
        return $commentModel->getAllCommentsByPostId($postId);
    }
}
