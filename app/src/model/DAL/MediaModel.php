<?php
include_files(array(
    "Console",
    "DbConnectionController",
    "CoreModel"
));

class MediaModel extends CoreModel
{

    /**
     * @param int MediaId 
     * @return Media 
     */
    public function getById($imageId)
    {
        //Sanitize this and make sure is safe
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "SELECT * FROM Media WHERE ImageId = :ImageId";

            $handle = $conn->prepare($query);
            $handle->bindParam(':ImageId', $imageId);
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
     * @return Media[]  
     */
    public function getAll()
    {
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "SELECT * FROM EntityStatus ORDER BY StatusId";

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

    public function createImage($data)
    {
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "INSERT INTO Media (`Image`, UserId) VALUES (`:Image`, :UserId)";

            $handle = $conn->prepare($query);

            $handle->bindValue(':Image', $data['image']);
            $handle->bindValue(':UserId', $data['userId']);

            $handle->execute();

            //close the connection
            CoreModel::closeDbConnection();
            $conn = null;
        } catch (PDOException $e) {
            echo  $e->getMessage();
        }
    }
}
