<?php
include_files(array(
    "Console",
    "DbConnectionController",
    "CoreModel"
));

class ReactionModel extends CoreModel
{


    public function createPost($data)
    {
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "INSERT INTO Reaction (ReactionType, UserId, PostId) VALUES (:ReactionType, :UserId, :PostId)";

            $handle = $conn->prepare($query);

            $handle->bindValue(':ReactionType', $data['reactionType']);
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
     * @param int ReactionId 
     * @return Reaction 
     */
    public function getById($reactionId)
    {
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "SELECT Reaction.*, User.Username, Post.Title
            FROM Reaction 
            INNER JOIN `User` ON User.UserId=Reaction.UserId
            INNER JOIN Post ON Post.PostId=Reaction.PostId
            WHERE ReactionId = :ReactionId";

            $handle = $conn->prepare($query);
            $handle->bindParam(':ReactionId', $reactionId);
            $handle->execute();

            $result = $handle->fetch(PDO::FETCH_OBJ);
            $reaction = new Reaction(
                $result->ReactionId,
                $result->ReactionType,
                $result->UserId,
                $result->PostId,
                $result->CreatedAt,
            );

            //close the connection
            CoreModel::closeDbConnection();
            $conn = null;

            return $reaction;
        } catch (PDOException $e) {
            print($e->getMessage());
        }
    }

    /**
     * @return Reaction[]  
     */
    // might be deleted since this would be a very heavy operation
    // could be changed to get the most recent 
    public function getAll()
    {
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "SELECT Reaction.*, User.Username, Post.Title
            FROM Reaction 
            INNER JOIN `User` ON User.UserId=Reaction.UserId
            INNER JOIN Post ON Post.PostId=Reaction.PostId
            ORDER BY Reaction.createdAt";

            $handle = $conn->prepare($query);
            $handle->execute();

            $result = array();
            while ($row = $handle->fetch(PDO::FETCH_OBJ)) {
                $reaction = new Reaction(
                    $row->ReactionId,
                    $row->ReactionType,
                    $row->UserId,
                    $row->PostId,
                    $row->CreatedAt,
                );

                $result[] = $reaction;
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
     * @return Reaction[]  
     */
    public function getByPostId(int $postId)
    {
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "SELECT Reaction.*, User.Username, Post.Title
            FROM Reaction 
            INNER JOIN `User` ON User.UserId=Reaction.UserId
            INNER JOIN Post ON Post.PostId=Reaction.PostId
            WHERE Reaction.PostId = :PostId
            ORDER BY Reaction.createdAt";

            $handle = $conn->prepare($query);
            $handle->bindParam(':PostId', $postId);
            $handle->execute();

            $result = array();
            while ($row = $handle->fetch(PDO::FETCH_OBJ)) {
                $reaction = new Reaction(
                    $row->ReactionId,
                    $row->ReactionType,
                    $row->UserId,
                    $row->PostId,
                    $row->CreatedAt,
                );

                $result[] = $reaction;
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
     * @param int reactionId
     */
    public function deleteReaction(int $reactionId)
    {
        try {
            $conn = CoreModel::openDbConnetion();
            $query = "DELETE FROM Reaction WHERE ReactionId = :ReactionId";

            $handle = $conn->prepare($query);

            $handle->bindParam(':ReactionId', $reactionId);

            $handle->execute();

            //close the connection
            CoreModel::closeDbConnection();
            $conn = null;
        } catch (PDOException $e) {
            print($e->getMessage());
        }
    }
}
