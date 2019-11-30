<?php
class Diary{
 
    // database connection and table name
    private $conn;
    private $table_name = "diary";
 
    // object properties
    public $id;
    public $description;
    public $pulpo;
 
    public function __construct($db){
        $this->conn = $db;
    }
 

    function read() {
        //select all data
        $query = "SELECT
                     description, pulpo
                FROM
                    " . $this->table_name;
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
    }

    function insert() {

        $query = "INSERT INTO 
                    $this->table_name
                  VALUES
                    ({$this->description},{$this->pulpo})";

                $stmt = $this->conn->prepare($query);
                $stmt->execute();

                return $stmt;

    }
}
?>