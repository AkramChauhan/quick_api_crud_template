<?php
  include ("connect.php");
  // database table name
  $tableName = "wa_categories";

  // you can enter multiple column name like "name, phone_number"
  $selectData = "*";

  // you can also specify where condition. like categoryID='10'
  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $whereCondition = "id = '".$id."'";
  }else{
    $whereCondition = "1=1";
  }

  // you can also specify order by || add limit at end of order variable like "id desc limit 4"
  $orderBy = "id desc";
  $result = array();
  // getting all records
    $categoryObject = $db->getData($tableName,$selectData,$whereCondition,$orderBy,0);
    if($categoryObject->rowCount()>0){
      $categoryObject = $categoryObject->fetchAll(PDO::FETCH_ASSOC);
      //result array;
     
      $result['status'] = "success";
      foreach($categoryObject as $category){
        $result['data'][] = $category;
      }
    }else{
      $result = array(
        "status"=>"failed",
        "msg"=> "Record not available for provided information.",
        "data"=> array(),
      ); 
    }

    echo json_encode($result);
?>