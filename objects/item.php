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
        $query = "SELECT COUNT(*)
        as total_item, cat_rel.parentName as category_name
        FROM Item_category_relations rel 
        left join category cat on rel.categoryId = cat.id
        left join Item on rel.ItemNumber = Item.Number
        left join (select catetory_relations.ParentcategoryId, catetory_relations.categoryId, category.name as parentName from catetory_relations left join category on catetory_relations.ParentcategoryId =category.id) cat_rel on cat.id = cat_rel.categoryId
        GROUP BY cat_rel.ParentcategoryId
        ORDER BY total_item DESC";  
 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
 
        return $stmt;
    }
 
}
?>