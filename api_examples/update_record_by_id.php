<?php
	include ("connect.php");
	// database table name
	$tableName = "wa_groups";
	
	//modify rowArray and valArray as per your need.

	if(isset($_REQUEST['where_id']) && isset($_REQUEST['group_name']) && isset($_REQUEST['group_link'])){
		// based on where_id your data will be updated.
		$where_id = $_REQUEST['where_id'];

		// group name and link will be updated where id = "".
		$groupName = $_REQUEST['group_name'];
		$groupLink = $_REQUEST['group_link'];

		// rowArray will contain your table col names.
		// valArary will contain values for that columns.
			$rowUpdate = array(
				"name"=>$groupName,
				"link"=>$groupLink,
			);
		// check duplicate 
			
			$whereCondition = "id='".$where_id."'";

		// getting all records
			$status = "success";
			$msg = "Group Updated Successfully";
			$db->updateData($tableName,$rowUpdate,$whereCondition);
	}
	else{
		$status= "failed";
		$msg = "One of the parameter is missing. (where_id | group_name | group_link)";
	}
  $result = array(
  	"status" => $status,
  	"msg" => $msg,
  );
  echo json_encode($result);
?>