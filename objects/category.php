<?php
class Category{
 
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


    function getCategoriesList(){
        //select all data
        $query = "SELECT * FROM category";  
 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
 
        return $stmt;
    }
 
    function getCountByCategory(){
        //select all data
        $query = "select t1.ParentcategoryId as lev1, t1.categoryId as lev2, t2.categoryId as lev3,t3.categoryId as lev4,
            t4.categoryId as lev5, t5.categoryId as lev6, t6.categoryId as lev7, cat, total
            from catetory_relations as t1 
            left join catetory_relations as t2 on t1.categoryId = t2.ParentcategoryId
            left join catetory_relations as t3 on t2.categoryId = t3.ParentcategoryId
            left join catetory_relations as t4 on t3.categoryId = t4.ParentcategoryId
            left join catetory_relations as t5 on t4.categoryId = t5.ParentcategoryId
            left join catetory_relations as t6 on t5.categoryId = t6.ParentcategoryId
            LEFT join (SELECT categoryId as cat, count(ItemNumber) as total 
            FROM bs.Item_category_relations group by categoryId)
            as test
            on t6.categoryId = test.cat OR t5.categoryId = test.cat OR t4.categoryId = test.cat 
            OR t3.categoryId = test.cat OR t2.categoryId = test.cat OR t1.categoryId = test.cat
            OR t1.ParentcategoryId = test.cat where t1.ParentcategoryId in 
            (SELECT Id FROM bs.category where Id not in (Select categoryId from catetory_relations))
            order by lev1,lev2,lev3,lev4,lev5,lev6,lev7";  
 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
 
        return $stmt;
    }
 
}
?>