<?php

include_once $_SERVER['DOCUMENT_ROOT']."/autoload.php";
include_files(array(
    "Console",
    "DbConnectionController",
    "CoreModel"
));

class BadgeModel extends CoreModel {


    /**
     * @param int BadgeId 
     * @return Badge 
     */
    public function getById($badgeId) {
       //Sanitize this and make sure is safe
        try {
		$conn = CoreModel::openDbConnetion();
     
		$query = "SELECT * FROM Badge WHERE BadgeId = :BadgeId";
          
		$handle = $conn->prepare($query);
		$handle->bindParam(':BadgeId', $badgeId);
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
     * @return Badge[]  
     */
    public function getAll() {
      // might improve the get all functions to avoid fetching too much
        try {
		$conn = CoreModel::openDbConnetion();
     
		$query = "SELECT * FROM Badge ORDER BY BadgeName";
          
		$handle = $conn->prepare($query);
		$handle->execute();
	
            $result = $handle->fetchAll(PDO::FETCH_ASSOC);

		    //close the connection
            CoreModel::closeDbConnection();
            $conn = null;

            return $result;
		} catch (PDOException $e) {
                  print($e->getMessage());
		}
    }

}