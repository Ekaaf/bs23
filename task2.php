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

// $data = array_slice($items, 0,5);
// $data = $items;
// $test = [];
// $prev1 = '';$prev1i = 0;
// $prev2 = '';$prev2i = 0;
// foreach ($data as $d) {
// 	$test[$d['lev1']] = $d['lev1'];
// 	if(!is_null($d['lev2'])){
// 		$test[$d['lev1']][] = $d['lev2'];
// 	}
// }
// // $new[0] =1;
// // $new[1] =5;
// // $new[2] =[23,24,25];
var_dump($items);exit();
?>
	
<h2>Please click to open</h2>
<ul id="myUL">
	<?php
		$prevLev1 = ''; 
		$prevLev2 = '';
		$prevLev3 = '';
		$prevLev4 = '';
		$prevLev5 = '';
		$prevLev6 = '';
		$prevLev7 = '';
		$check1 = 0;$check2 = 0;$check3 = 0;$check4 = 0;$check1 = 0;$check1 = 0;$check1 = 0;
		foreach ($data as $d) {
	?>
  	<?php
		  $li = ""; 
			if(!is_null($d['lev2'])){
				if($prevLev1!=$d['lev1']){
					$prevLev1 = $d['lev1'];
					if($check2==1){
						$li .= '</ul>';
					}
					$li .= '<li><span class="caret">'.$categories[$d['lev1']].'1</span><ul class="nested">';
					$check2 = 0;
				}
				
				if(!is_null($d['lev3'])){
					if($prevLev2!=$d['lev2']){
						$prevLev2 = $d['lev2'];
						if($check3==1){
							$li .= '</ul>';
						}
						$li .= '<li><span class="caret">'.$categories[$d['lev2']].'2</span><ul class="nested">';
						$check3 = 0;
					}
					else{
						$check3 = 1;
						$li .='<li>'.$categories[$d['lev3']].'3</li>';
					}
					if(!is_null($d['lev4']) ){
						if($prevLev3!=$d['lev3']){
							$prevLev3 = $d['lev3'];
							if($check4==1){
								$li .= '</ul>';
							}
							$li .= '<li><span class="caret">'.$categories[$d['lev3']].'</span><ul class="nested">';
							$check4 = 0;
						}
						else{
						$check4 = 1;
							$li .='<li>'.$categories[$d['lev3']].'3</li>';
						}
					}
				}
				
				// else{
				// 	$li .= '</li>'
				// }
			}

			echo $li;
		?>
  <?php } ?>
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