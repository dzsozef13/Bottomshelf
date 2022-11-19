<?php
include_files(array(
    "Console",
    "DbConnectionController",
    "CoreModel"
));

class ReactionModel extends CoreModel
{


    /**
     * @param int ReactionId 
     * @return Reaction 
     */
    public function getById($reactionId)
    {
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "SELECT Reaction.ReactionId, Reaction.ReactionType, Reaction.UserId, Reaction.PostId, User.Username, Post.Title
            FROM Reaction 
            INNER JOIN `User` ON User.UserId=Reaction.UserId
            INNER JOIN Post ON Post.PostId=Reaction.PostId
            WHERE ReactionId = :ReactionId";

            $handle = $conn->prepare($query);
            $handle->bindParam(':ReactionId', $reactionId);
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
     * @return Reaction[]  
     */
    public function getAll()
    {
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "SELECT Reaction.ReactionId, Reaction.ReactionType, Reaction.UserId, Reaction.PostId, User.Username, Post.Title
            FROM Reaction 
            INNER JOIN `User` ON User.UserId=Reaction.UserId
            INNER JOIN Post ON Post.PostId=Reaction.PostId
            ORDER BY Reaction.createdAt";

            $handle = $conn->prepare($query);
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

    /**
     * @return Reaction[]  
     */
    public function getByUserId(int $userId)
    {
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "SELECT Reaction.ReactionId, Reaction.ReactionType, Reaction.UserId, Reaction.PostId, User.Username, Post.Title
            FROM Reaction 
            INNER JOIN `User` ON User.UserId=Reaction.UserId
            INNER JOIN Post ON Post.PostId=Reaction.PostId
            WHERE Reaction.UserId = :UserId
            ORDER BY Reaction.createdAt";

            $handle = $conn->prepare($query);
            $handle->bindParam(':UserId', $userId);
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

    /**
     * @return Reaction[]  
     */
    public function getByPostId(int $postId)
    {
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "SELECT Reaction.ReactionId, Reaction.ReactionType, Reaction.UserId, Reaction.PostId, User.Username, Post.Title
            FROM Reaction 
            INNER JOIN `User` ON User.UserId=Reaction.UserId
            INNER JOIN Post ON Post.PostId=Reaction.PostId
            WHERE Reaction.PostId = :PostId
            ORDER BY Reaction.createdAt";

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
