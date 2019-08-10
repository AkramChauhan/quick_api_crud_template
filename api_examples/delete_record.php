<?php
	include ("connect.php");
	// database table name
	$tableName = "wa_groups";
	
	//modify rowArray and valArray as per your need.

	if(isset($_REQUEST['where_id'])){
		// based on where_id your data will be updated.
		$where_id = $_REQUEST['where_id'];
		// group name and link will be updated where id = "".
		// check duplicate 			
			$whereCondition = "id='".$where_id."'";

		// getting all records
			$status = "success";
			$msg = "Group Deleted Successfully";
			$db->deleteData($tableName,$whereCondition);
	}
	else{
		$status= "failed";
		$msg = "One of the parameter is missing. (where_id)";
	}
  $result = array(
  	"status" => $status,
  	"msg" => $msg,
  );
  echo json_encode($result);
?>