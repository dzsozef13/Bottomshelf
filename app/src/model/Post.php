<?php

include_once $_SERVER['DOCUMENT_ROOT']."/autoload.php";
include_files(array(
    "Console",
    "DbConnectionController",
    "BaseModel"
));

class Post extends BaseModel {
    protected $id;
    protected $title;
    protected $description;
    protected $tags;
    protected $isSticky;
    protected $isPublic;
    protected $timestamp;
    // protected $media;
    // protected $comments;
    // protected $reactions;

    // GET METHODS
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    // CRUD OPERATIONS
    public function create(array $data) {
       
    }

    public function getById(int $id) {
       //Sanitize this and make sure is safe
        try {
			$conn = BaseModel::openDbConnetion();
     
			$query = "SELECT * FROM Post WHERE (:PostId)";
          
			$handle = $conn->prepare($query);
		    $handle->bindParam(':PostId', $id);
		    $handle->execute();
	
            $result = $handle->fetch(PDO::FETCH_ASSOC);

		    //close the connection
            BaseModel::closeDbConnection();
            $conn = null;

            return $result;
		} catch (PDOException $err) {
            console_log("Failed in Model");
		}
    }

    public function getAll() {

    }

    public function update(int $id, array $data) {

    }

    public function delete(int $id) {

    }
}