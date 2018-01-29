<?php

class databaseClass
{
    // specify your own database authentication
    private $host = "localhost";
    private $db_name = "app";
    private $username = "root";
    private $password = "";
    public $conn;

    // get the database connection
    public function __construct()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            //print_r($this->conn) ;
            //echo "connected";
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

?>