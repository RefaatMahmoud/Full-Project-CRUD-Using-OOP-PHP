<?php
require_once 'databaseClass.php';
class productClass extends databaseClass
{
    //properties of this class in product table
    public $id;
    public $name;
    public $price;
    public $cat_id;
    public $description;

    //Create Product Method
    public function create(){
        $query = "INSERT INTO products (name,price,description,cat_id) VALUES (:name,:price,:description,:cat_id)";
        //prepare Statement
        $stmt = $this->conn->prepare($query);
        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":cat_id", $this->cat_id);
        $stmt->execute();
/*
 * or if you not userd bindParam
 *  $stmt->execute(array(
            "name" => $this->name,
            "price" => $this->price,
            "description" => $this->description,
            "cat_id" => $this->cat_id
            ));
 * */
    }

    /*
     * readAll Data in products Table
     * */
    public function readALl()
    {
        $query = "SELECT * FROM products ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $rows =  $stmt->fetchAll();
        return $rows;
    }

    /*
     * Delete single record in products table
     * */
    public function Delete($id)
    {
        $query = "DELETE FROM products WHERE id = $id ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam($id,$this->id);
        $stmt->execute();
    }

}