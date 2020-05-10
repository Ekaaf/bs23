<?php
class Item{
 
    // database connection and table name
    private $conn;
    private $table_name = "item";
 
    // object properties
    public $Id;
    public $CustomData;
    public $Number;
    public $Barcode;
    public $Name1;
    public $Name2;
    public $Name3;
    public $Note;

 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    function getCount(){
        //select all data
        $query = "select category.Id as categoryId,ParentcategoryId from category left join catetory_relations
on category.Id = catetory_relations.categoryId order by ParentcategoryId";  
 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
 
        return $stmt;
    }
 
}
?>