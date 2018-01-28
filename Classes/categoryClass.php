<?php
require_once 'databaseClass.php';
class categoryClass extends databaseClass
{
    private $table_name = "category";
    // object properties
    public $id;
    public $name;

    public function __construct()
    {
        return parent::__construct();
    }

    // used by select drop-down list "Select ALl Data"
    public function read()
    {
        $query = "SELECT * FROM category ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $rows =  $stmt->fetchAll();
        return $rows;
    }

}

?>