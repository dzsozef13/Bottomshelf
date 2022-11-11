<?php
include_files(array(
    "Console",
    "DbConnectionController",
    "CoreModel"
));

class PostModel extends CoreModel {

    /**
     * Returns a user with the passed id
     */
    public function getUserById($id) {
        try {
            $conn = CoreModel::openDbConnetion();
        
            $query = "SELECT * FROM User WHERE UserID = :userID";
            
            $handle = $conn->prepare($query);

            $sanitizedId = htmlspecialchars($id);

            $handle->bindParam(':userID', $sanitizedId);

            $handle->execute();

            $result = $handle->fetch(PDO::FETCH_ASSOC);

            return $result;

            CoreModel::closeDbConnection();
            $conn = null;
		} catch (PDOException $e) {
            echo  $e->getMessage();
        }
    }
}