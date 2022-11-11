<?php

include_once $_SERVER['DOCUMENT_ROOT']."/autoload.php";
include_files(array(
    "Console",
    "DbConnectionController",
    "CoreModel"
));

class CountryModel extends CoreModel {


    /**
     * @param string countryCode 
     * @return Country 
     */
    public function getByCountryCode($countryCode) {
        try {
		$conn = CoreModel::openDbConnetion();
     
		$query = "SELECT * FROM Country WHERE CountryCode = :CountryCode";
          
		$handle = $conn->prepare($query);
		$handle->bindParam(':CountryCode', $countryCode);
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
     * @return Country[]  
     */
    public function getAll() {
        try {
		$conn = CoreModel::openDbConnetion();
     
		$query = "SELECT * FROM Country ORDER BY CountryCode";
          
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