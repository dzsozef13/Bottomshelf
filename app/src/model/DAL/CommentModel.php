<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/autoload.php";
include_files(array(
    "Console",
    "DbConnectionController",
    "CoreModel",
    "Comment"
));

class CommentModel extends CoreModel
{

    /**
     * @param array data all values needed to create a comment
     */
    public function createComment($data)
    {
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "INSERT INTO Comment (Content, UserId, PostId) VALUES (:Content, :UserId, :PostId)";

            $handle = $conn->prepare($query);

            $sanitizedContent = htmlspecialchars($data['content']);

            $handle->bindParam(':Content', $sanitizedContent);
            $handle->bindValue(':UserId', $data['userId']);
            $handle->bindValue(':PostId', $data['postId']);

            $handle->execute();

            //close the connection
            CoreModel::closeDbConnection();
            $conn = null;
        } catch (PDOException $e) {
            echo  $e->getMessage();
        }
    }

    /**
     * @param int CommentId 
     * @return Comment 
     */
    public function getById(int $commentId)
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
    public function getAllCommentsByPostId(int $postId)
    {
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "SELECT Comment.*, User.Username, User.profileImgBlob, Post.Title
            FROM Comment 
            INNER JOIN `User` ON User.UserId=Comment.UserId
            INNER JOIN Post ON Post.PostId=Comment.PostId
            WHERE Comment.PostId = :PostId
            ORDER BY CreatedAt DESC";

            $handle = $conn->prepare($query);
            $handle->bindParam(':PostId', $postId);
            $handle->execute();


            $result = array();
            while ($row = $handle->fetch(PDO::FETCH_OBJ)) {
                $comment = new Comment(
                    $row->CommentId,
                    $row->Content,
                    $row->UserId,
                    $row->PostId,
                    $row->CreatedAt,
                    $row->Username,
                    $row->profileImgBlob,
                );
                $result[] = $comment;
            }

            //close the connection
            CoreModel::closeDbConnection();
            $conn = null;

            return $result;
        } catch (PDOException $e) {
            print($e->getMessage());
        }
    }

    /**
     * @param int commentId
     * @param string updatable data
     */
    public function updateComment(int $id, $content)
    {
        try {
            $conn = CoreModel::openDbConnetion();
            $query = "UPDATE Comment SET Content = :Content WHERE CommentId = :CommentId";

            $handle = $conn->prepare($query);

            $sanitizedContent = htmlspecialchars($content);

            $handle->bindParam(':Content', $sanitizedContent);
            $handle->bindParam(':CommentId', $id);

            $handle->execute();

            //close the connection
            CoreModel::closeDbConnection();
            $conn = null;
        } catch (PDOException $e) {
            print($e->getMessage());
        }
    }


    /**
     * @param int commentId
     */
    public function deleteCommentByCommentId(int $commentId)
    {
        try {
            $conn = CoreModel::openDbConnetion();
            $query = "DELETE FROM Comment WHERE CommentId = :CommentId";

            $handle = $conn->prepare($query);

            $handle->bindParam(':CommentId', $commentId);

            $handle->execute();

            //close the connection
            CoreModel::closeDbConnection();
            $conn = null;
        } catch (PDOException $e) {
            print($e->getMessage());
        }
    }
}
