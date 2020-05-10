<?php
	
	include_once 'config/database.php';
	include_once 'objects/catetoryRelations.php';
	 
	$database = new Database();
	$db = $database->getConnection();
	 
	$CatetoryRelations = new CatetoryRelations($db);
	$stmt = $CatetoryRelations->readAll();

	$page_title = "Task2";
	include_once "layout_header.php";

	$items = [];
	while ($row = $stmt->fetch(PDO::FETCH_OBJ)){
		$items[] = $row;
	}

print_r($items);
$childs = array();

foreach($items as $item)
    $childs[$item->ParentcategoryId][] = $item;

foreach($items as $item) if (isset($childs[$item->categoryId]))
    $item->childs = $childs[$item->categoryId];

$tree = $childs;


?>
	

<!-- <ul id="myUL">
  <li><span class="caret">Beverages</span>
    <ul class="nested">
      <li>Water</li>
      <li>Coffee</li>
      <li><span class="caret">Tea</span>
        <ul class="nested">
          <li>Black Tea</li>
          <li>White Tea</li>
          <li><span class="caret">Green Tea</span>
            <ul class="nested">
              <li>Sencha</li>
              <li>Gyokuro</li>
              <li>Matcha</li>
              <li>Pi Lo Chun</li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
  </li>
</ul> -->

 <?php
include_once "layout_footer.php";
?>

<s