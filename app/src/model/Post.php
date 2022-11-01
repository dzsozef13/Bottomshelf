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
        $db = new DbConnectionController();

        if($db != null) {
            var_dump($db);
        }
    }

    public function getById(int $id) {

    }

    public function getAll() {

    }

    public function update(int $id, array $data) {

    }

    public function delete(int $id) {

    }
}