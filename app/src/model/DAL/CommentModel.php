<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/autoload.php";
include_files(array(
    "Console",
    "DbConnectionController",
    "CoreModel"
));

class CommentModel extends CoreModel
{

    /**
     * @param int CommentId 
     * @return Comment 
     */
    public function getById($commentId)
    {
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "SELECT Comment.*, User.Username, Post.Title
            FROM Comment 
            INNER JOIN `User` ON User.UserId=Comment.UserId
            INNER JOIN Post ON Post.PostId=Comment.PostId
            WHERE CommentId = :CommentId";

            $handle = $conn->prepare($query);
            $handle->bindParam(':CommentId', $commentId);
            $handle->execute();

            $result = $handle->fetch(PDO::FETCH_OBJ);

            //close the connection
            CoreModel::closeDbConnection();
            $conn = null;

            return $result;
        } catch (PDOException $e) {
            print($e->getMessage());
        }
    }

    /**
     * @return Comment[]  
     */
    public function getAllCommentsByPostId($postId)
    {
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "SELECT Comment.*, User.Username, Post.Title
            FROM Comment 
            INNER JOIN `User` ON User.UserId=Comment.UserId
            INNER JOIN Post ON Post.PostId=Comment.PostId
            WHERE Comment.PostId = :PostId
            ORDER BY CreatedAt";

            $handle = $conn->prepare($query);
            $handle->bindParam(':PostId', $postId);
            $handle->execute();

            $result = $handle->fetchAll(PDO::FETCH_OBJ);

            //close the connection
            CoreModel::closeDbConnection();
            $conn = null;

            return $result;
        } catch (PDOException $e) {
            print($e->getMessage());
        }
    }
}
