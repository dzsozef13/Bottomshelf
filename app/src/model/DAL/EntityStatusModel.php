<?php
include_files(array(
    "Console",
    "DbConnectionController",
    "CoreModel"
));

class EntityStatusModel extends CoreModel
{


    /**
     * @param int EntityStatusId 
     * @return EntityStatus 
     */
    public function getById($statusId)
    {
        //Sanitize this and make sure is safe
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "SELECT * FROM EntityStatus WHERE StatusId = :StatusId";

            $handle = $conn->prepare($query);
            $handle->bindParam(':StatusId', $statusId);
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
     * @return EntityStatus[]  
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
}
