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
        $query = "select cat.Name as catname, sum(total) as total
            from catetory_relations as t1 
            left join catetory_relations as t2 on t1.categoryId = t2.ParentcategoryId
            left join catetory_relations as t3 on t2.categoryId = t3.ParentcategoryId
            left join catetory_relations as t4 on t3.categoryId = t4.ParentcategoryId
            left join catetory_relations as t5 on t4.categoryId = t5.ParentcategoryId
            left join catetory_relations as t6 on t5.categoryId = t6.ParentcategoryId
            LEFT join (SELECT categoryId as cat, count(ItemNumber) as total 
            FROM Item_category_relations group by categoryId)
            as test
            on t6.categoryId = test.cat OR t5.categoryId = test.cat OR t4.categoryId = test.cat 
            OR t3.categoryId = test.cat OR t2.categoryId = test.cat OR t1.categoryId = test.cat
            OR t1.ParentcategoryId = test.cat 
            inner join (SELECT * FROM category where Id not in 
            (Select categoryId from catetory_relations)) as cat
            on t1.ParentcategoryId = cat.Id
            group by t1.ParentcategoryId";  
 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
 
        return $stmt;
    }
 
}
?>