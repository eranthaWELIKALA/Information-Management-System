<!DOCTYPE html>
<?php
session_start();
/*if(!isset($_SESSION["memID"]) || !isset($_SESSION["password"])){
	header ("location:login.php");
}*/
?>
<html>
<head>
<!--setting the title-->
<title>Requests</title>
<!--adding bootstrap-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
body{
	width:100%;
	height:100%;
	background-image:url('background.jpg');
	background-size:cover;
}
#one{
			width:100%;
			height:100%;
			background-color:#000;
			background-size:cover;
		}
</style>
</head>
<body>

<div class="container" id="one"><h2></h2>
	<div class="col-md-10"></div><div class="col-md-2">
	<ul class="nav nav-pills">
		<li class="active"><a href="#"><?php echo "Registrar";?></a></li>
		<li><a href="login.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
	</ul><h2></h2></div>
</div>

<div class='container'>

<?php

require 'connect.php';

$requests_query="SELECT COUNT(*) FROM signup_requests";
if($is_requests_query_run=mysqli_query($connect,$requests_query)){
	while($query_execute=mysqli_fetch_assoc($is_requests_query_run)){
		if($query_execute['COUNT(*)']==0){
			echo "<div class='row'><div class='col-md-4'></div><div class='col-md-4'>"."<p align='center'><label>No new requests</label></p>"."</div></div>";
		}
	}
}

$requests_query="SELECT * FROM signup_requests";

if($is_requests_query_run=mysqli_query($connect,$requests_query)){
	$itr1=0;
	$value=1;
	$memIDArray=array();
	echo "<div class='container'><table class='table table-striped'><thead><tr><th>MembershipID</th><th>Firstname</th><th>Lastname</th><th></th></tr></thead><tbody>";
	while($query_execute=mysqli_fetch_assoc($is_requests_query_run)){
		$memIDArray[$itr1]=$query_execute['MembershipID'];
		$firstnameArray[$itr1]=$query_execute['Firstname'];
		$lastnameArray[$itr1]=$query_execute['Lastname'];
		$passwordArray[$itr1]=$query_execute['Password'];
		$acceptedArray[$itr1]=$query_execute['Accepted'];
		echo "<tr>";
		echo "<td>".$query_execute['MembershipID']."</td>";
		echo "<td>".$query_execute['Firstname']."</td>";
		echo "<td>".$query_execute['Lastname']."</td>";
		echo "<td><form method='post' action='requests.php'><input class='form-control' type='submit' name='".$memIDArray[$itr1]."' value='ACCEPT'></td>";
		echo "<td><input class='form-control' type='submit' name='".$memIDArray[$itr1]."undo"."' value='UNDO'></form></td>";
		/*echo "<div class='row'><div class='col-md-2' style='align:center'>".$query_execute['MembershipID']."</div><div class='col-md-3' style='align:center'>".$query_execute['Firstname']."</div><div class='col-md-3' style='align:center'>".$query_execute['Lastname']."</div>";
		echo "<div class='col-md-2'><form method='post' action='requests.php'><input class='form-control' type='submit' name='".$memIDArray[$itr1]."' value='ACCEPT'></div>";
		echo "<div class='col-md-2'><input class='form-control' type='submit' name='".$memIDArray[$itr1]."undo"."' value='UNDO'></div></div></form>";*/
		$itr1++;
		echo "</tr>";
	}
	echo "</table></div>";
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
			echo "jump";
		}
		
	}
}

if(isset($_POST["done"])){
	for($itr4=0;$itr4<$itr1;$itr4++){
		$memID=(string)$memIDArray[$itr4];
		$password=(string)$passwordArray[$itr4];
		$firstname=(string)$firstnameArray[$itr4];
		$lastname=(string)$lastnameArray[$itr4];
		$accepted=(string)$acceptedArray[$itr4];
		$add_query="INSERT INTO members_login_details (MembershipID, Password) VALUES ('$memID', '$password')";
		$add2_query="INSERT INTO `member_details` (`MembershipID`, `Firstname`, `Lastname`, `Address1`, `Address2`, `Mobile`, `Fixed`, `Email`, `Birthday`, `NIC`, `Occupation`, `Civil_status`, `Admission`, `Begin`, `End`) VALUES ('$memID', '$firstname', '$lastname', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)";
		if($accepted=='1'){
			$is_add_query_run=mysqli_query($connect,$add_query);
			$is_add2_query_run=mysqli_query($connect,$add2_query);
			if($is_add_query_run){
				//echo "jump";
			}
			if($is_add2_query_run){
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

if(isset($_POST["deleteall"])){
	$delete_query="DELETE FROM signup_requests";
	$is_delete_query_run=mysqli_query($connect,$delete_query);
	if($is_delete_query_run){
		header ('location:reg.php');
	}
} 
?>
<form action='requests.php' method='post'>
<div class='row'><div class='col-md-4'></div><div class='col-md-4'><input class="form-control" type="submit" name="done" value="DONE"></div></div>
<div class='row'><div class='col-md-4'></div><div class='col-md-4'><input class="form-control" type="submit" name="deleteall" value="DELETE ALL"></div></div>
</form>
</div>
</body>




</html>



