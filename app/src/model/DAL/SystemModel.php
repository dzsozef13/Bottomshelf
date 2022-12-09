<?php
include_files(array(
    "Console",
    "DbConnectionController",
    "CoreModel"
));

class SystemModel extends CoreModel
{

    public function getById($systemId)
    {
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "SELECT * FROM `System` WHERE SystemId = :SystemId";

            $handle = $conn->prepare($query);
            $handle->bindParam(':SystemId', $systemId);
            $handle->execute();

            $result = $handle->fetch(PDO::FETCH_ASSOC);
            $system = new System(
                $result->Id,
                $result->ServiceDescription,
                $result->Rules,
                $result->PhoneNumber,
                $result->SystemEmail,
                $result->Address,
                $result->UsersCount,
            );
            //close the connection
            CoreModel::closeDbConnection();
            $conn = null;

            return $system;
        } catch (PDOException $e) {
            print($e->getMessage());
        }
    }

    public function getAll()
    {
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "SELECT * FROM `System` ORDER BY Id";

            $handle = $conn->prepare($query);
            $handle->execute();

            $result = array();
            while ($row = $handle->fetch(PDO::FETCH_OBJ)) {
                $system = new System(
                    $row->Id,
                    $row->ServiceDescription,
                    $row->Rules,
                    $row->PhoneNumber,
                    $row->SystemEmail,
                    $row->Address,
                    $row->UsersCount,
                );

                $result[] = $system;
            }
            return $result;

            //close the connection
            CoreModel::closeDbConnection();
            $conn = null;

            return $result;
        } catch (PDOException $e) {
            print($e->getMessage());
        }
    }

    public function createSystem($data)
    {
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "INSERT INTO `System` (ServiceDescription, Rules, PhoneNumber, SystemEmail, `Address`)  VALUES (:ServiceDescription, :Rules, :PhoneNumber, :SystemEmail, :Address)";

            $handle = $conn->prepare($query);

            $sanitizedDescription = htmlspecialchars($data['systemDescription']);
            $sanitizedRules = htmlspecialchars($data['rules']);
            $sanitizedPhoneNumber = htmlspecialchars($data['phoneNumber']);
            $sanitizedEmail = htmlspecialchars($data['email']);
            $sanitizedAddress = htmlspecialchars($data['address']);

            $handle->bindParam(':ServiceDescription', $sanitizedDescription);
            $handle->bindParam(':Rules', $sanitizedRules);
            $handle->bindParam(':PhoneNumber', $sanitizedPhoneNumber);
            $handle->bindParam(':SystemEmail', $sanitizedEmail);
            $handle->bindParam(':Address', $sanitizedAddress);

            $handle->execute();
            $lastInsertedPostId = $conn->lastInsertId();
            return $lastInsertedPostId;
        } catch (PDOException $e) {
            echo  $e->getMessage();
        }
    }

    public function updateSystem(int $systemId, $data)
    {
        try {
            $conn = CoreModel::openDbConnetion();

            $query = "UPDATE `System` SET (ServiceDescription = :ServiceDescription, Rules = :Rules, PhoneNumber = :PhoneNumber, SystemEmail = :SystemEmail, `Address` = :Address) WHERE Id = :Id)";

            $handle = $conn->prepare($query);

            $sanitizedDescription = htmlspecialchars($data['systemDescription']);
            $sanitizedRules = htmlspecialchars($data['rules']);
            $sanitizedPhoneNumber = htmlspecialchars($data['phoneNumber']);
            $sanitizedEmail = htmlspecialchars($data['email']);
            $sanitizedAddress = htmlspecialchars($data['address']);

            $handle->bindParam(':Id', $systemId);
            $handle->bindParam(':ServiceDescription', $sanitizedDescription);
            $handle->bindParam(':Rules', $sanitizedRules);
            $handle->bindParam(':PhoneNumber', $sanitizedPhoneNumber);
            $handle->bindParam(':SystemEmail', $sanitizedEmail);
            $handle->bindParam(':Address', $sanitizedAddress);

            $handle->execute();
            $lastInsertedPostId = $conn->lastInsertId();
            return $lastInsertedPostId;
        } catch (PDOException $e) {
            echo  $e->getMessage();
        }
    }

    public function deleteSystem(int $id)
    {
        try {
            $conn = CoreModel::openDbConnetion();
            $query = "DELETE FROM `System` WHERE Id = :Id";

            $handle = $conn->prepare($query);

            $handle->bindParam(':Id', $id);

            $handle->execute();

            //close the connection
            CoreModel::closeDbConnection();
            $conn = null;
        } catch (PDOException $e) {
            print($e->getMessage());
        }
    }
}
