<?php
include_files(array(
    "DbConnectionController",
    "Console",
    "CommentModel"
));

class CommentController
{

    // public function create()
    // {
    //     $title = $_POST['title'];
    //     $description = $_POST['description'];
    //     $isPublic = $_POST['isPublic'];
    //     $isSticky = 1;
    //     $userId = $_POST['userId'];
    //     $StatusId = 1;
    //     $data = [];

    //     if (isset($title) && isset($description) && isset($isPublic) && isset($isSticky)  && isset($userId)  && isset($StatusId)) {
    //         $data = array(
    //             'title' => $title,
    //             'description' =>  $description,
    //             'isPublic' => $isPublic,
    //             'isSticky' => $isSticky,
    //             'userId' =>  $userId,
    //             'statusId' =>  $StatusId
    //         );
    //         $this->postModel->createPost($data);
    //     } else {
    //         // thow an error error
    //     }
    // }

    public function fetchAllByPostId(int $postId)
    {
        $commentModel = new CommentModel();
        return $commentModel->getAllCommentsByPostId($postId);
    }
}
