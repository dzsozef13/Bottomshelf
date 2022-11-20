<?php
include_files(array(
    "Console",
    "DbConnectionController",
    "CoreModel"
));

class UserModel extends CoreModel
{

    /**
     * Returns success
     */
    public function registUser($data): bool
    {
        try {
            $conn = CoreModel::openDbConnetion();
            $query =
                "INSERT INTO User (
                    Email, 
                    Username, 
                    UserPassword, 
                    DateOfBirth, 
                    CountryCode, 
                    RoleId, 
                    StatusId) 
                VALUES (
                    :email, 
                    :username, 
                    :userPassword, 
                    :dateOfBirth, 
                    :countryCode,
                    :roleId,
                    :statusId)";
            $handle = $conn->prepare($query);

            $sanitizedEmail = htmlspecialchars($data['email']);
            $sanitizedUsername = htmlspecialchars($data['username']);
            $sanitizedDateOfBirth = htmlspecialchars($data['birthdate']);

            $hashPassword = password_hash($data['password'], PASSWORD_DEFAULT);

            $handle->bindParam(':email', $sanitizedEmail);
            $handle->bindParam(':username', $sanitizedUsername);
            $handle->bindValue(':dateOfBirth', $sanitizedDateOfBirth);
            $handle->bindValue(':userPassword', $hashPassword);

            /**
             * Hardcoded for now :)
             */
            $handle->bindValue(':countryCode', "DNK");
            $handle->bindValue(':roleId', 1);
            $handle->bindValue(':statusId', 1);

            $handle->execute();
            // Close database connection
            $this->closeDbConnection();
            return true;
        } catch (PDOException $e) {
            echo  $e->getMessage();
            return false;
        }
    }

    /**
     * Returns single user with the passed email
     */
    public function getUserByEmail($email)
    {
        try {
            // Open database connection and prepare statement
            $conn = $this->openDbConnetion();
            $query = "SELECT * FROM User WHERE Email = :userEmail";
            $handle = $conn->prepare($query);
            // Sanetize input
            $sanitizedEmail = htmlspecialchars($email);
            // Bind parameters and execute
            $handle->bindParam(':userEmail', $sanitizedEmail);
            $handle->execute(); 
            // Get result
            $result = $handle->fetch(PDO::FETCH_OBJ);
            // Close database connection
            $this->closeDbConnection();
            // Return result
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Returns single user with the passed username
     */
    public function getUserByUsername($username)
    {
        try {
            // Open database connection and prepare statement
            $conn = $this->openDbConnetion();
            $query = "SELECT * FROM User WHERE Username = :username";
            $handle = $conn->prepare($query);
            // Sanetize input
            $sanitizedUsername = htmlspecialchars($username);
            // Bind parameters and execute
            $handle->bindParam(':username', $sanitizedUsername);
            $handle->execute();
            // Get result
            $result = $handle->fetch(PDO::FETCH_OBJ);
            // Close database connection
            $this->closeDbConnection();
            // Return result
            return $result;
        } catch (PDOException $e) {
            echo  $e->getMessage();
        }
    }

    /**
     * Validates user with passed email and password
     * Returns password is correct
     */
    public function validateUser($email, $password)
    {
        $user = $this->getUserByEmail($email);
        if (password_verify($password, $user->UserPassword)) {
            return $user;
        } else {
            return null;
        }
    }

    /**
     * @return User[] 
     */
    public function getAll(int $statusId, int $roleId)
    {
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "SELECT UserId, Email, Username, ProfileImgUrl, StatusId,CountryCode, RoleId 
            FROM `User` 
            WHERE StatusId = :StatusId AND RoleId = :RoleId
            ORDER BY UserId";

            $handle = $conn->prepare($query);
            $handle->bindParam(':StatusId', $statusId);
            $handle->bindParam(':RoleId', $roleId);
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
