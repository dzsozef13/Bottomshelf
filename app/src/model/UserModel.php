<?php
include_files(array(
    "Console",
    "DbConnectionController",
    "CoreModel"
));

class UserModel extends CoreModel {

    /**
     * Returns user with the passed email
     */
    public function getUserByEmail($email) {
        try {
            $conn = CoreModel::openDbConnetion();
            $query = "SELECT * FROM User WHERE Email = :userEmail";
            $handle = $conn->prepare($query);

            $sanitizedId = htmlspecialchars($email);

            $handle->bindParam(':userEmail', $sanitizedId);
            $handle->execute();

            $result = $handle->fetchAll();

            CoreModel::closeDbConnection();
            $conn = null;

            return $result[0];

		} catch (PDOException $e) {
            echo  $e->getMessage();
        }
    }

    public function validateUser($email, $password) {
        $user = $this->getUserByEmail($email);
        if (password_verify($password, $user['UserPassword'])) {
            return true;
        } else {
            return false;
        }
    }

}