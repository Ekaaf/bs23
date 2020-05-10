<?php
class CatetoryRelations{
 
    // database connection and table name
    private $conn;
    private $table_name = "category";
 
    // object properties
    public $Id;
    public $UUID;
    public $categoryId;
    public $ParentcategoryId;

 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // used by select drop-down list
    function readAll(){
        //select all data
        $query = "select category.Id as categoryId,ParentcategoryId from category left join catetory_relations
            on category.Id = catetory_relations.categoryId order by ParentcategoryId";  
 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
 
        return $stmt;
    }
 
}
?>