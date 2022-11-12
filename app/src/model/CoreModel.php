<?php
include_files(array(
    "DbConnectionController"
));

class CoreModel {
    // Data Access Layer Model
    protected $db;

    public function __construct() {
        $this->db = new DbConnectionController();
    }

    /**
     * Opens database connection
     */
    public function openDbConnetion() {
        if($this->db->useDb() !== null) {
           return $this->db->useDb();
        }
    }

    /**
     * Closes database connection
     */
    public function closeDbConnection() {
        if(isset($this->db)) {
            $this->db->destroy();
            $this->db = null;
        }
    }

}