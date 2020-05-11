<?php
	
	include_once 'config/database.php';
	include_once 'objects/category.php';
	 
	$database = new Database();
	$db = $database->getConnection();
	
	$page_title = "Task2";
	include_once "layout_header.php";

	$Category = new Category($db);
	$categoriesStmt = $Category->getCategoriesList();
	$categories = [];
	while ($row = $categoriesStmt->fetch(PDO::FETCH_ASSOC)){
		$categories[$row['Id']] = $row['Name'];
	}

	$stmt = $Category->getCountByCategory();
	$items = [];
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$items[] = $row;
	}

$data = array_slice($items, 0,5);
$data = $items;
// var_dump(count($data));exit();
?>
	
<h2>Please click to open</h2>
<ul id="myUL">
	<?php
		$depth = 1;
		$prevLev1 = ''; 
		$prevLev2 = '';
		$prevLev3 = '';
		$prevLev4 = '';
		$prevLev5 = '';
		$prevLev6 = '';
		$prevLev7 = '';
		$check1 = 0;$check2 = 0;$check3 = 0;$check4 = 0;$check1 = 0;$check1 = 0;$check1 = 0;
		$li = ""; 
		foreach ($data as $d) {
		
			if(!is_null($d['lev2']) && $prevLev1 != $d['lev1']){
				if($check1 == 1){
					$li .= "</ul>";
					$check1 = 0;
				}
				$li .= '<li><span class="caret">'.$categories[$d['lev1']].'1</span><ul class="nested">';
				$check1 = 1;
			}
			if(is_null($d['lev2'])){
				$li .= "<li>".$d['lev1']."</li>";
			}
			$prevLev1 = $d['lev1'];
				
		} 
		echo $li;
  ?>
</ul>

<br><br>
<ul id="myUL">
  <li><span class="caret">aaa</span>
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
</ul>

 <?php
include_once "layout_footer.php";
?>

<s