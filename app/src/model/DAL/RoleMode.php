<?php

include_files(array(
    "Console",
    "DbConnectionController",
    "CoreModel"
));

class RoleModel extends CoreModel
{


    /**
     * @param int RoleId 
     * @return Role 
     */
    public function getById($roleId)
    {
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "SELECT * FROM `Role` WHERE RoleId = :RoleId";

            $handle = $conn->prepare($query);
            $handle->bindParam(':RoleId', $roleId);
            $handle->execute();

            $result = $handle->fetch(PDO::FETCH_ASSOC);

            //close the connection
            CoreModel::closeDbConnection();
            $conn = null;

            return $result;
        } catch (PDOException $e) {
            print($e->getMessage());
        }
    }

    /**
     * @return Role[]  
     */
    public function getAll()
    {
        // might improve the get all functions to avoid fetching too much
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "SELECT * FROM `Role` ORDER BY RoleName";

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
