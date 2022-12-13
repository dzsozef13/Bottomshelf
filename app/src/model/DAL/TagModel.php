<?php
include_files(array(
  "Console",
  "DbConnectionController",
  "CoreModel",
  "Tag"
));

class TagModel extends CoreModel
{


  /**
   * @param int TagId 
   * @return Tag 
   */
  public function getById($tagId)
  {
    //Sanitize this and make sure is safe
    try {
      $conn = CoreModel::openDbConnetion();

      $query = "SELECT * FROM Tag WHERE TagId = :TagId";

      $handle = $conn->prepare($query);
      $handle->bindParam(':TagId', $tagId);
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
   * @return Tag[]  
   */
  public function getAll()
  {
    // might improve the get all functions to avoid fetching too much
    try {
      $conn = CoreModel::openDbConnetion();

      $query = "SELECT * FROM Tag ORDER BY TagName";

      $handle = $conn->prepare($query);
      $handle->execute();

      $result = array();
      while ($row = $handle->fetch(PDO::FETCH_OBJ)) {
        $post = new Tag(
          $row->TagId,
          $row->TagName,
        );

        $result[] = $post;
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
   * @return Tag[]  
   */
  public function getAllForPost($postId)
  {
    // might improve the get all functions to avoid fetching too much
    try {
      $conn = CoreModel::openDbConnetion();

      $query = 
        "SELECT * FROM Tag 
        INNER JOIN PostHasTag ON PostHasTag.TagId = Tag.TagId
        WHERE PostHasTag.PostId = :PostId
        ORDER BY TagName";

        $handle = $conn->prepare($query);
        $handle->bindParam(':PostId', $postId);
        $handle->execute();

        $result = array();
        while ($row = $handle->fetch(PDO::FETCH_OBJ)) {
          $post = new Tag(
          $row->TagId,
          $row->TagName,
        );

        $result[] = $post;
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
