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
        $query = "SELECT count(*) as relID, cat.id as catID, cat_rel.parentName as categoryId, cat.Name as name
            FROM item_category_relations rel 
        inner join category cat on rel.categoryId = cat.id
        left join Item on rel.ItemNumber = Item.Number
        left join (select catetory_relations.id as cat_rel_id, catetory_relations.ParentcategoryId, catetory_relations.categoryId, category.name as parentName from catetory_relations left join category on catetory_relations.ParentcategoryId =category.id) cat_rel on cat.id = cat_rel.categoryId
        GROUP BY catID
        ORDER BY catID";  
 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
 
        return $stmt;
    }
 
}
?>