<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/autoload.php";
include_files(array(
  "Console",
  "DbConnectionController",
  "CoreModel",
  "Badge"
));

class BadgeModel extends CoreModel
{


  /**
   * @param int BadgeId 
   * @return Badge 
   */
  public function getById($badgeId)
  {
    //Sanitize this and make sure is safe
    try {
      $conn = CoreModel::openDbConnetion();

      $query = "SELECT * FROM Badge WHERE BadgeId = :BadgeId";

      $handle = $conn->prepare($query);
      $handle->bindParam(':BadgeId', $badgeId);
      $handle->execute();

      $row = $handle->fetch(PDO::FETCH_OBJ);
      $badge = new Badge(
        $row->BadgeId,
        $row->BadgeName
      );

      //close the connection
      CoreModel::closeDbConnection();
      $conn = null;

      return $badge;
    } catch (PDOException $e) {
      print($e->getMessage());
    }
  }

  /**
   * @return Badge[]  
   */
  public function getAll()
  {
    try {
      $conn = CoreModel::openDbConnetion();

      $query = "SELECT * FROM Badge ORDER BY BadgeName";

      $handle = $conn->prepare($query);
      $handle->execute();

      $result = array();
      while ($row = $handle->fetch(PDO::FETCH_OBJ)) {
        $badge = new Badge(
          $row->BadgeId,
          $row->BadgeName
        );

        $result[] = $badge;
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
   * @return Badge[]  
   */
  public function getByUserId($userId)
  {
    try {
      $conn = CoreModel::openDbConnetion();

      $query = "SELECT Badge.*, UserHasBadge.*
      FROM UserHasBadge
      INNER JOIN Badge ON Badge.BadgeId=UserHasBadge.BadgeId
      WHERE UserHasBadge.UserId = :UserId
      ORDER BY BadgeName";

      $handle = $conn->prepare($query);
      $handle->bindParam(':UserId', $userId);
      $handle->execute();

      $result = array();
      while ($row = $handle->fetch(PDO::FETCH_OBJ)) {
        $badge = new Badge(
          $row->BadgeId,
          $row->BadgeName
        );

        $result[] = $badge;
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
