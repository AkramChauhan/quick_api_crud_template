<?php
date_default_timezone_set('Asia/Kolkata');
include("../include/define.php");
include("../include/main_class.php");

$db= new Database();
$conn = $db->connect(HOST,MYSQL_USERNAME,MYSQL_PASSWORD,MYSQL_DATABASE);

?>