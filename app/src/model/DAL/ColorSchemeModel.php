<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/autoload.php";
include_files(array(
    "Console",
    "DbConnectionController",
    "CoreModel",
    "ColorScheme"
));

class ColorSchemeModel extends CoreModel
{


    /**
     * @return ColorScheme 
     */
    public function getById($colorSchemeId)
    {
        //Sanitize this and make sure is safe
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "SELECT * FROM ColorScheme WHERE ColorSchemeId = :ColorSchemeId";

            $handle = $conn->prepare($query);
            $handle->bindParam(':ColorSchemeId', $colorSchemeId);
            $handle->execute();

            $row = $handle->fetch(PDO::FETCH_OBJ);
            $scheme = new ColorScheme(
                $row->ColorSchemeId,
                $row->HighlightColor,
                $row->BackgroundPrimary,
                $row->BackgroundSecondary,
                $row->BackgroundTernary,
                $row->Light,
            );

            //close the connection
            CoreModel::closeDbConnection();
            $conn = null;

            return $scheme;
        } catch (PDOException $e) {
            print($e->getMessage());
        }
    }

    /**
     * @return ColorScheme[]  
     */
    public function getAll()
    {
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "SELECT * FROM ColorScheme ORDER BY ColorSchemeId";

            $handle = $conn->prepare($query);
            $handle->execute();

            $result = array();
            while ($row = $handle->fetch(PDO::FETCH_OBJ)) {
                $scheme = new ColorScheme(
                    $row->ColorSchemeId,
                    $row->HighlightColor,
                    $row->BackgroundPrimary,
                    $row->BackgroundSecondary,
                    $row->BackgroundTernary,
                    $row->Light,
                );

                $result[] = $scheme;
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
