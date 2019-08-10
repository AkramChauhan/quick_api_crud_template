<?php
	include ("connect.php");
	// database table name
	$tableName = "";

	// your code goes here.
	$result = array(
		"status"=>"success",
		"msg"=>"Great, You are ready to create your first API with Quick API CRUD Template",
		"data"=> array(
			"Step_1"=>"Read readme.md file",
			"Step_2"=>"Modify Define.php with your SiteURL and update database credentials.",
			"Step_3"=>"Checkout few examples inside Example folder. and create your own API",
		)
	);
	echo json_encode($result);
?>