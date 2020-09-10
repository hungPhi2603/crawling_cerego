<?php
class Word {
    private $conn;
    private $table_name = 'words';

    public $id;
    public $concept;
    public $meaning;

    public function __construct($db)
    {
        $this->conn = $db;

    }

    // read products
    function read(){

        // select all query
        $query = "SELECT * from " . $this->table_name . " ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}