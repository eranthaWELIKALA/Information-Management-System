<!DOCTYPE html>
<?php
 $mysql_host='localhost';
 $mysql_user='root';
 $mysql_password='';
 
 if($connect=mysqli_connect($mysql_host,$mysql_user,$mysql_password,'members')){
	//echo "mySQL Connection Successful<br>";
	/*if(@mysqli_select_db($connect,'members')){
		echo "database connected<br>";
	}else die('database not connected<br>');*/
 }else die("Connection Unsuccessful<br>");
 $conn = new PDO('mysql:host=localhost; dbname=members','root', ''); 
?>