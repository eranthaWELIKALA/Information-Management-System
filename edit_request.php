<?php

	require 'connect.php';
	session_start();
	$edit_query="INSERT INTO `edit_requests`(`MembershipID`, `Seen`) VALUES ('".$_SESSION["memID"]."',false)";
	$is_edit_query_run=mysqli_query($connect,$edit_query);
	if($is_edit_query_run){
		$_SESSION['edit_request_status']=true;
		header("location:user.php");
	}
	
	

?>
