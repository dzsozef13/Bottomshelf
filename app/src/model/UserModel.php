<?php
include_files(array(
    "Console",
    "DbConnectionController",
    "CoreModel"
));

class UserModel extends CoreModel {

    /**
     * Returns single user with the passed email
     */
    public function getUserByEmail($email) {
        // Sanetize input
        $sanitizedId = htmlspecialchars($email);
        try {
            // Open database connection and prepare statement
            $conn = $this->openDbConnetion();
            $query = "SELECT * FROM User WHERE Email = :userEmail";
            $handle = $conn->prepare($query);
            // Bind parameters and execute
            $handle->bindParam(':userEmail', $sanitizedId);
            $handle->execute();
            // Get result
            $result = $handle->fetchAll();
            // Close database connection
            $this->closeDbConnection();
            // Return result
            return $result[0];
		} catch (PDOException $e) {
            echo  $e->getMessage();
        }
    }

    /**
     * Validates user with passed email and password
     * Returns password is correct
     */
    public function validateUser($email, $password) {
        $user = $this->getUserByEmail($email);
        return password_verify($password, $user['UserPassword']);
    }

}