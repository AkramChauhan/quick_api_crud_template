<?php
	include ("connect.php");
	// database table name
	$tableName = "wa_categories";

	// you can enter multiple column name like "name, phone_number"
	$selectData = "*";

	// you can also specify where condition. like categoryID='10'
	$whereCondition = "1=1";

	// you can also specify order by || add limit at end of order variable like "id desc limit 4"
	$orderBy = "id desc";

	// getting all records
    $categoryObject = $db->getData($tableName,$selectData,$whereCondition,$orderBy);
    $totalCategoies = $categoryObject->rowCount();    

    echo "Total Categories: ".$totalCategoies;
  
?>