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
    public function createPost($title, $description, $isPublic, $isSticky, $userId, $statusId) {
        try {
			$conn = BaseModel::openDbConnetion();
     
			$query = "INSERT INTO Post (Title, PostDescription, IsPublic, IsSticky, UserId, StatusId) VALUES (:title, :postDescription, :isPublic, :isSticky, :userId, :statusId)";
          
			$handle = $conn->prepare($query);

            $handle->bindParam(':title', $title);
            $handle->bindParam(':postDescription', $description);
            $handle->bindParam(':isPublic', $isPublic);
            $handle->bindParam(':isSticky', $isSticky);
            $handle->bindParam(':userId', $userId);
            $handle->bindParam(':statusId', $statusId);

		    $handle->execute();

		    //close the connection
            BaseModel::closeDbConnection();
            $conn = null;
		} catch (PDOException $e) {
            echo  $e->getMessage();
          }

    }

    /**
     * @param int is the id of the post you would like to fetch
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
		} catch (PDOException $err) {
            print($err->getMessage());
		}
    }

     /**
     * @return Post[]  (if none then empty array [])
     */
    public function getAll() {
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
		} catch (PDOException $err) {
            print($err->getMessage());
		}
    }

    /**
     * @param int 
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
		} catch (PDOException $err) {
            print($err->getMessage());
		}
    }

    /**
     * @param int 
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
		} catch (PDOException $err) {
            print($err->getMessage());
		}
    }

    public function update(int $id, array $data) {

    }

    public function delete(int $id) {

    }
}