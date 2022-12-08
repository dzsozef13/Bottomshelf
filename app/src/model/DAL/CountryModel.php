<?php
include_files(array(
    "Console",
    "DbConnectionController",
    "CoreModel"
));

class CountryModel extends CoreModel
{


    /**
     * @param string countryCode 
     * @return Country 
     */
    public function getByCountryCode($countryCode)
    {
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "SELECT * FROM Country WHERE CountryCode = :CountryCode";

            $handle = $conn->prepare($query);
            $handle->bindParam(':CountryCode', $countryCode);
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
     * @return Country[]  
     */
    public function getAll()
    {
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "SELECT * FROM Country ORDER BY CountryCode";

            $handle = $conn->prepare($query);
            $handle->execute();

            $result = array();
            while ($row = $handle->fetch(PDO::FETCH_OBJ)) {
                $result[] = $row;
            }

            //close the connection
            CoreModel::closeDbConnection();
            $conn = null;

            return $result;
        } catch (PDOException $e) {
            print($e->getMessage());
        }
    }
}
