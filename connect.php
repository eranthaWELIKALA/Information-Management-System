<?php
 $mysql_host='localhost';
 $mysql_user='root';
 $mysql_password='';

//establishing mySQL connection
 if($connect=mysqli_connect($mysql_host,$mysql_user,$mysql_password,'members')){
 }else die("Connection Unsuccessful<br>");
?>
