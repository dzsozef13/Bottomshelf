<?php

include_once $_SERVER['DOCUMENT_ROOT']."/autoload.php";
include_files(array(
    "Console",
    "DbConnectionController"
));

class Post {
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
        $conn = new DbConnectionController();
        $query = "SELECT * FROM Post (FullName, Contents) VALUES (:fullName, :contents)";

        if(isset($conn)) {
            // $handle = $conn->dbcon->prepare("SELECT * FROM Review WHERE ReviewID = $reviewID");
        }
    }

    public function getAll() {

    }

    public function update(int $id, array $data) {

    }

    public function delete(int $id) {

    }
}