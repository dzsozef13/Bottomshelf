<?php
include_files(array(
    "Console",
    "DbConnectionController",
    "CoreModel"
));

class PostModel extends CoreModel {
    // Try to implement filter_var for more protection

      /**
     * @param array data all values needed to create a post
     */
    public function createPost($data) {
        try {
		$conn = CoreModel::openDbConnetion();
     
		$query = "INSERT INTO Post (Title, PostDescription, IsPublic, IsSticky, UserId, StatusId) VALUES (:title, :postDescription, :isPublic, :isSticky, :userId, :statusId)";
          
		$handle = $conn->prepare($query);

            $sanitizedTitle = htmlspecialchars($data['title']);
            $sanitizedDescription = htmlspecialchars($data['description']);

            $handle->bindParam(':title', $sanitizedTitle);
            $handle->bindParam(':postDescription', $sanitizedDescription);
            $handle->bindValue(':isPublic', $data['isPublic']);
            $handle->bindValue(':isSticky', $data['isSticky']);
            $handle->bindValue(':userId', $data['userId']);
            $handle->bindValue(':statusId', $data['statusId']);

		    $handle->execute();

		    //close the connection
                CoreModel::closeDbConnection();
            $conn = null;
		} catch (PDOException $e) {
            echo  $e->getMessage();
          }

    }

    /**
     * @param int postId is the id of the post you would like to fetch
     * @return Post post with matching Id  (if none then false)
     */
    public function getById($postId) {
       //Sanitize this and make sure is safe
        try {
		$conn = CoreModel::openDbConnetion();
     
		$query = "SELECT * FROM Post WHERE PostId = :PostId";
          
		$handle = $conn->prepare($query);
		$handle->bindParam(':PostId', $postId);
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
     * @return Post[]  (if none then empty array [])
     */
    public function getAll() {
      // might improve the get all functions to avoid fetching too much
        try {
		$conn = CoreModel::openDbConnetion();
     
		$query = "SELECT * FROM Post ORDER BY CreatedAt";
          
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

    /**
     * @param int userId
     * @return Post[] (if none then empty array [])
     */
    public function getAllByUserId($userId) {
        try {
		$conn = CoreModel::openDbConnetion();
     
		$query = "SELECT * FROM Post WHERE UserId = :UserId ORDER BY CreatedAt";
          
		$handle = $conn->prepare($query);
            $handle->bindParam(':UserId', $userId);
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

    /**
     * @param int statusId
     * @return Post[]  (if none then empty array [])
     */
    public function getAllByStatusId($statusId) {
        try {
		$conn = CoreModel::openDbConnetion();
     
		$query = "SELECT * FROM Post WHERE StatusId = :StatusId ORDER BY CreatedAt";
          
		$handle = $conn->prepare($query);
            $handle->bindParam(':StatusId', $statusId);
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

   /**
      * @param int postId
      * @param array updatable data
     */
    public function updatePost($id, $data) {
      try {
            $conn = CoreModel::openDbConnetion();
            $query = "UPDATE Post SET Title = :title, PostDescription = :postDescription, IsPublic = :isPublic WHERE PostId = :postId";
      
            $handle = $conn->prepare($query);
      
            $sanitizedTitle = htmlspecialchars($data['title']);
            $sanitizedDescription = htmlspecialchars($data['description']);
      
            $handle->bindParam(':title', $sanitizedTitle);
            $handle->bindParam(':postDescription', $sanitizedDescription);
            $handle->bindValue(':isPublic', $data['isPublic']);
            $handle->bindParam(':postId', $id);
      
            $handle->execute();
      
            //close the connection
            CoreModel::closeDbConnection();
            $conn = null;
      } catch (PDOException $e) {
            print($e->getMessage());
      }

    }


   /**
      * @param int postId
      * @param int statusId
     */
    // in the controller the logic will be split into markAsBanned, markAsActive, markAsReported
    public function updatePostStatus($id, $statusId) {
            try {
                  $conn = CoreModel::openDbConnetion();
                  $query = "UPDATE Post SET StatusId = :statusId WHERE PostId = :postId";
            
                  $handle = $conn->prepare($query);
            
                  $handle->bindParam(':statusId', $statusId);
                  $handle->bindParam(':postId', $id);
            
                  $handle->execute();
            
                  //close the connection
                  CoreModel::closeDbConnection();
                  $conn = null;
            } catch (PDOException $e) {
                  print($e->getMessage());
            }
      }

    public function deletePost($id) {
     
    }

    public function softDeletePost($id) {

}
}