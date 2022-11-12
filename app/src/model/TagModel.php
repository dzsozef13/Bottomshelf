<?php
include_files(array(
    "Console",
    "DbConnectionController",
    "CoreModel"
));

class TagModel extends CoreModel {


    /**
     * @param int TagId 
     * @return Tag 
     */
    public function getById($tagId) {
       //Sanitize this and make sure is safe
        try {
		$conn = CoreModel::openDbConnetion();
     
		$query = "SELECT * FROM Tag WHERE TagId = :TagId";
          
		$handle = $conn->prepare($query);
		$handle->bindParam(':TagId', $tagId);
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
     * @return Tag[]  
     */
    public function getAll() {
      // might improve the get all functions to avoid fetching too much
        try {
		$conn = CoreModel::openDbConnetion();
     
		$query = "SELECT * FROM Tag ORDER BY TagName";
          
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