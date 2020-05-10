<?php

	include_once 'config/database.php';
	include_once 'objects/item.php';
	 
	$database = new Database();
	$db = $database->getConnection();
	 
	$Item = new Item($db);
	$stmt = $Item->getCount();

	$page_title = "Task1";
	include_once "layout_header.php";

	$items = [];
	// while ($row = $stmt->fetch(PDO::FETCH_OBJ)){
	// 	$items[] = $row;
	// }


?>
	
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">CategoryName</th>
      <th scope="col">Total Items</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
  </tbody>
</table>
 <?php
include_once "layout_footer.php";
?>

<s