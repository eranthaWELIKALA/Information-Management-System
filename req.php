<?php

/*session_start();
if(!isset($_SESSION["memIDArray"]) || !isset($_SESSION["password"])){
	header ("location:home.php");
}*/

?>

<html>
<head><title>Requests</title>
<link href="bootstrap.min.css" rel="stylesheet">
<script src="bootstrap.min.js"></script></head>
<body>
<div class='container'>
<div class='col-md-12'>
<?php
require 'connect.php';

$requests_query="SELECT * FROM signup_requests";
if($is_requests_query_run=mysqli_query($connect,$requests_query)){
	$itr1=0;
	$value=1;
	$memIDArray=array();
	while($query_execute=mysqli_fetch_assoc($is_requests_query_run)){
		$memIDArray[$itr1]=$query_execute['MembershipID'];
		$firstnameArray[$itr1]=$query_execute['Firstname'];
		$lastnameArray[$itr1]=$query_execute['Lastname'];
		$passwordArray[$itr1]=$query_execute['Password'];
		$acceptedArray[$itr1]=$query_execute['Accepted'];
		echo "<div class='col-md-2'>".$query_execute['MembershipID']." ".$query_execute['Firstname']." ".$query_execute['Lastname']."</div>";
		echo "<div class='col-md-2'><form method='post' action='requests.php'><input class='form-control' type='submit' name='".$memIDArray[$itr1]."' value='ACCEPT'></div>";
		echo "<div class='col-md-2'><input class='form-control' type='submit' name='".$memIDArray[$itr1]."undo"."' value='UNDO'></div></form>";
		$itr1++;
	}
}
for($itr2=0;$itr2<$itr1;$itr2++){
	$accept=(string)$memIDArray[$itr2];
	$accepted_query="UPDATE `signup_requests` SET `Accepted` = '1' WHERE `signup_requests`.`MembershipID` = '".$accept."' ";
	if(isset($_POST[$accept])){
		$is_accepted_query_run=mysqli_query($connect,$accepted_query);
		if($is_accepted_query_run){
			header ("location:requests.php");
		}
		
	}
}
for($itr3=0;$itr3<$itr1;$itr3++){
	$accept=(string)$memIDArray[$itr3];
	$undo=(string)$memIDArray[$itr3]."undo";
	$undo_query="UPDATE signup_requests SET Accepted = '0' WHERE signup_requests.MembershipID = '".$accept."' ";
	if(isset($_POST[$undo])){
		$is_undo_query_run=mysqli_query($connect,$undo_query);
		if($is_undo_query_run){
			//echo "jump";
		}
		
	}
}



if(isset($_POST["done"])){
	for($itr4=0;$itr4<$itr1;$itr4++){
		$memID=(string)$memIDArray[$itr4];
		$password=(string)$passwordArray[$itr4];
		$accepted=(string)$acceptedArray[$itr4];
		$add_query="INSERT INTO members_login_details (MembershipID, Password) VALUES ('$memID', '$password')";
		if($accepted=='1'){
			$is_add_query_run=mysqli_query($connect,$add_query);
			if($is_add_query_run){
				//echo "jump";
			}	
		}
	}
	$delete_query="DELETE FROM signup_requests WHERE Accepted='1'";
	$is_delete_query_run=mysqli_query($connect,$delete_query);
	if($is_delete_query_run){
		header ('location:reg.php');
	}
}
?>
<form action='requests.php' method='post'>
<input class="form-control" type="submit" name="done" value="DONE">
</form>
</div>
</div>
</body>




</html>



