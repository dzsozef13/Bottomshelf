<?php
include_files(array(
    "Console",
    "DbConnectionController",
    "CoreModel",
    "User"
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
     * Returns single user with the passed username
     */
    public function getUserById($id): User
    {
        try {
            // Open database connection and prepare statement
            $conn = $this->openDbConnetion();
            $query = "SELECT 
                User.UserId,
                User.Email, 
                User.Username,
                User.DateOfBirth, 
                User.ProfileImgUrl, 
                User.BioDescription, 
                User.RoleId, 
                User.StatusId, 
                Country.*, 
                Role.*, 
                EntityStatus.*
            FROM User 
            INNER JOIN Country ON User.CountryCode=Country.CountryCode
            INNER JOIN `Role` ON Role.RoleId=User.RoleId
            INNER JOIN EntityStatus ON EntityStatus.StatusId=User.StatusId
            WHERE UserId = :userId";
            $handle = $conn->prepare($query);
            // Bind parameters and execute
            $handle->bindParam(':userId', $id);
            $handle->execute();
            // Get result
            $result = $handle->fetch(PDO::FETCH_OBJ);
            $entity = new User($result->UserId, $result->Email, $result->Username, $result->DateOfBirth, $result->ProfileImgUrl, $result->BioDescription, $result->CountryCode, $result->RoleId,  $result->StatusId);
            // Close database connection
            $this->closeDbConnection();
            // Return result
            return $entity;
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

    /**
     * @param int userId
     * @param array updatable data
     */
    public function updateUser(int $id, $data)
    {
        try {
            $conn = CoreModel::openDbConnetion();
            $query = "UPDATE `User` SET Username = :Username, BioDescription = :BioDescription, CountryCode = :CountryCode WHERE UserId = :UserId";

            $handle = $conn->prepare($query);

            $sanitizedTitle = htmlspecialchars($data['username']);
            $sanitizedDescription = htmlspecialchars($data['description']);

            $handle->bindParam(':Username', $sanitizedTitle);
            $handle->bindParam(':BioDescription', $sanitizedDescription);
            $handle->bindValue(':CountryCode', $data['countryCode']);
            $handle->bindParam(':UserId', $id);

            $handle->execute();

            //close the connection
            CoreModel::closeDbConnection();
            $conn = null;
        } catch (PDOException $e) {
            print($e->getMessage());
        }
    }

    /**
     * @param int userId
     * @param array updatable data
     */
    public function uploadProfilePicture($data)
    {
        try {
            $conn = CoreModel::openDbConnetion();
            $query = "UPDATE `User` SET ProfileImgUrl = :ProfileImgUrl WHERE UserId = :UserId";

            $handle = $conn->prepare($query);

            $handle->bindParam(':ProfileImgUrl', $data['media']);
            $handle->bindValue(':UserId', $data['userId']);

            $handle->execute();

            //close the connection
            CoreModel::closeDbConnection();
            $conn = null;
        } catch (PDOException $e) {
            print($e->getMessage());
        }
    }
}
