<?php
	include ("connect.php");
	// database table name
	$tableName = "wa_groups";
	$checkDuplicate = true;
	
	//modify rowArray and valArray as per your need.

	if(isset($_REQUEST['cat_id']) && isset($_REQUEST['cat_id']) && isset($_REQUEST['cat_id'])){
		$categoryId = $_REQUEST['cat_id'];
		$groupName = $_REQUEST['group_name'];
		$groupLink = $_REQUEST['group_link'];

		// rowArray will contain your table col names.
		// valArary will contain values for that columns.
			$rowArray = array(
				"category_id",
				"name",
				"link",
			);
			$valArray = array(
				$categoryId,
				$groupName,
				$groupLink,
			);

		// check duplicate 
			
			$duplicateWhereCondition = "name='".$groupName."'";
			$duplicateMessage = "Group Name Already Exist";

		// getting all records
		$duplicateObject = $db->getData($tableName,"id",$duplicateWhereCondition);
		if($duplicateObject->rowCount()>0 && $checkDuplicate==true){
			$status= "failed";
			$msg = $duplicateMessage;
		}else{
			$status = "success";
			$msg = "Group Added Successfully";
			$lastInsertID = $db->saveData($tableName,$valArray,$rowArray);
		}
	}else{
		$status= "failed";
		$msg = "One of the parameter is missing. (cat_id | group_name | group_link)";
	}
	
  $result = array(
  	"status" => $status,
  	"msg" => $msg,
  );
  echo json_encode($result);
?>