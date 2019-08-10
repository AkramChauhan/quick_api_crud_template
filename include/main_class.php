<?php
class database {
  function connect($servername,$username,$password,$database){  
    try { 
      $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $conn;
    }
    catch(PDOException $e)
    {
      $result = array(
        "status" => "failed",
        "msg"=>"Connection Error",
        "error_message"=>$e->getMessage(),
        "solution"=>"Double Check your credentials at include/define.php file"
      );
      echo json_encode($result);
      exit();
    }
  }
  function getData($table, $rows = '*', $where = null, $order = null,$die=0){
    GLOBAL $conn;
    $results = array();
      $q = 'SELECT '.$rows.' FROM '.$table;
      if($where != null)
        $q .= ' WHERE '.$where;
      if($order != null)
        $q .= ' ORDER BY '.$order;
    if($die==1){ 
      echo $q;die; 
    }
    $result = $conn->query($q);
    return $result;
  }
  function tableExists($table, $conn) {
    // Try a select statement against the table
    // Run it in try/catch in case PDO is in ERRMODE_EXCEPTION.
    try {
      $result = $conn->query("SELECT 1 FROM $table LIMIT 1");
    } catch (Exception $e) {
      // We got an exception == table not found
      return FALSE;
    }

    // Result is either boolean FALSE (no table found) or PDOStatement Object (table found)
    return $result !== FALSE;
  }
  function saveData($table,$values,$rows = 0,$die=0){
    // mac_insert - Insert and Die Values By Akram Chauhan
    GLOBAL $conn;

    $insert = 'INSERT INTO '.$table;
    if(count($rows) > 0){
      $insert .= ' ('.implode(",",$rows).')';
    }
    for($i = 0; $i < count($values); $i++){
    if(is_string($values[$i]))
      $values[$i] = '"'.$values[$i].'"';
    }
    $values = implode(',',$values);
    $insert .= ' VALUES ('.$values.')';
    if($die==1){
    echo $insert;die;
    }
    $conn->exec($insert);
    return $conn->lastInsertId();
  }
  
  function updateData($table,$rows,$where,$die=0){ //update query by Akram Chauhan
    GLOBAL $conn;

    $update = 'UPDATE '.$table.' SET ';
    $keys = array_keys($rows);
    for($i = 0; $i < count($rows); $i++)
    {
      if(is_string($rows[$keys[$i]]))
      {
        $update .= $keys[$i].'="'.$rows[$keys[$i]].'"';
      }
      else
      {
        $update .= $keys[$i].'='.$rows[$keys[$i]];
      }
       
      // Parse to add commas
      if($i != count($rows)-1)
      {
        $update .= ',';
      }
    }
    $update .= ' WHERE '.$where;
    if($die==1){
      echo $update;die;
    }
    
    //$update = trim($update," AND");
    $result  = $conn->query($update);
    if($result)
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  function deleteData($table,$where = null,$die=0){
    GLOBAL $conn;
    if($where=='' || $where==null || empty($where) || !isset($where)){ echo $q; die; }
      
    $results = array();
    $q = 'DELETE FROM '.$table;
    if($where != null)
      $q .= ' WHERE '.$where;
    if($die==1){ echo $q;die; }
  
    $result = $conn->query($q);
    return 1;
  }
  function redirectTo($redirectPageName=null){ // Lcaotion BY Akram Chauhan
    if($redirectPageName==null){
      header("Location:".$this->SITEURL);
      exit;
    }else{
      header("Location:".$redirectPageName);
      exit;
    }
  }
  
  function cleanString($string){
    $string = trim($string);        // Trim empty space before and after
    return $string;
  }
}
?>
