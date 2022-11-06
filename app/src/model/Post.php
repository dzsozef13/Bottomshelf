<?php

include_once $_SERVER['DOCUMENT_ROOT']."/autoload.php";
include_files(array(
    "Console",
    "DbConnectionController",
    "BaseModel"
));

class Post extends BaseModel {
    // protected $id;
    // protected $title;
    // protected $description;
    // protected $tags;
    // protected $isSticky;
    // protected $isPublic;
    // protected $timestamp;
    // // protected $media;
    // // protected $comments;
    // // protected $reactions;

    // // GET METHODS
    // public function getId() {
    //     return $this->id;
    // }

    // public function getTitle() {
    //     return $this->title;
    // }

    // public function getDescription() {
    //     return $this->description;
    // }

    // CRUD OPERATIONS
      /**
     * @param array data all values needed to create a post
     */
    public function createPost($data) {
        try {
		$conn = BaseModel::openDbConnetion();
     
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
            BaseModel::closeDbConnection();
            $conn = null;
		} catch (PDOException $e) {
            echo  $e->getMessage();
          }

    }

    /**
     * @param int postId is the id of the post you would like to fetch
     * @return Post post with matching Id  (if none then false)
     */
    public function getByPostId($postId) {
       //Sanitize this and make sure is safe
        try {
		$conn = BaseModel::openDbConnetion();
     
		$query = "SELECT * FROM Post WHERE PostId = :PostId";
          
		$handle = $conn->prepare($query);
		$handle->bindParam(':PostId', $postId);
		$handle->execute();
	
            $result = $handle->fetch(PDO::FETCH_ASSOC);

		    //close the connection
            BaseModel::closeDbConnection();
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
		$conn = BaseModel::openDbConnetion();
     
		$query = "SELECT * FROM Post ORDER BY CreatedAt";
          
		$handle = $conn->prepare($query);
		$handle->execute();
	
            $result = $handle->fetchAll(PDO::FETCH_ASSOC);

		    //close the connection
            BaseModel::closeDbConnection();
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
		$conn = BaseModel::openDbConnetion();
     
		$query = "SELECT * FROM Post WHERE UserId = :UserId ORDER BY CreatedAt";
          
		$handle = $conn->prepare($query);
            $handle->bindParam(':UserId', $userId);
		    $handle->execute();
	
            $result = $handle->fetchAll(PDO::FETCH_ASSOC);

		    //close the connection
            BaseModel::closeDbConnection();
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
		$conn = BaseModel::openDbConnetion();
     
		$query = "SELECT * FROM Post WHERE StatusId = :StatusId ORDER BY CreatedAt";
          
		$handle = $conn->prepare($query);
            $handle->bindParam(':StatusId', $statusId);
		$handle->execute();
	
            $result = $handle->fetchAll(PDO::FETCH_ASSOC);

		    //close the connection
            BaseModel::closeDbConnection();
            $conn = null;

            return $result;
		} catch (PDOException $e) {
                  print($e->getMessage());
		}
    }


    public function updatePost($id, $data) {
      try {
            $conn = BaseModel::openDbConnetion();
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
            BaseModel::closeDbConnection();
            $conn = null;
      } catch (PDOException $e) {
            print($e->getMessage());
      }

    }

    // in the controller the logic will be split into markAsBanned, markAsActive, markAsReported
    public function updatePostStatus($id, $statusId) {
            try {
                  $conn = BaseModel::openDbConnetion();
                  $query = "UPDATE Post SET StatusId = :statusId WHERE PostId = :postId";
            
                  $handle = $conn->prepare($query);
            
                  $handle->bindParam(':statusId', $statusId);
                  $handle->bindParam(':postId', $id);
            
                  $handle->execute();
            
                  //close the connection
                  BaseModel::closeDbConnection();
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