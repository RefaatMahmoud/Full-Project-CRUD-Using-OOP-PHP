<?php
//Call DataBase File as require_once NOT require because will make error which will be two classes with same name
require_once 'databaseClass.php';

class categoryClass extends databaseClass
{
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
        $rows = $stmt->fetchAll();
        return $rows;
    }
}

?>