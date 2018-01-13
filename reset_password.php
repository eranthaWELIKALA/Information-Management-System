<?php
session_start();

//access controlling
if(!isset($_SESSION["memID"]) || !isset($_SESSION["password"])){
	if($_SESSION['memID']!="admin000"){
		header ("location:login.php");
	}
}

//resetting password
require 'connect.php';
		$get_query="SELECT * FROM members_login_details WHERE MembershipID='".$_SESSION['searched_memID']."'";
		$is_get_query_run=mysqli_query($connect,$get_query);
		$get_query_execute=mysqli_fetch_assoc($is_get_query_run);
		$reseted_password=sha1($get_query_execute["MembershipID"]);
		$reset_query="UPDATE members_login_details SET `Password` = '".$reseted_password."'  WHERE `members_login_details`.`MembershipID` = '".$_SESSION['searched_memID']."'";
		$is_reset_query_run=mysqli_query($connect,$reset_query);
		header("location:admin.php");
?>
