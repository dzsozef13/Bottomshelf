<?php

include_once $_SERVER['DOCUMENT_ROOT']."/autoload.php";
include_files(array(
    "DbConnectionController"
));

class BaseModel {
    protected $db;

    public function __construct() {
        $this->db = new DbConnectionController();
    }

    public function openDbConnetion() {
       
        if($this->db->useDb() !== null) {
           return $this->db->useDb();
        }
        
    }

    public function closeDbConnection() {
        if(isset($this->db)) {
            $this->db->destroy();
        }
        
    }

}