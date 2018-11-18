<!DOCTYPE html>
<?php
session_start();

//importing pages
require 'connect.php';require 'function.php';

//access controlling
if(!isset($_SESSION["memID"]) || !isset($_SESSION["password"])){
	if($_SESSION['memID']!="reg000"){
		header ("location:login.php");
	}
}
?>
<html>
<head>
<!--setting the title-->
<title>Requests</title>
<!--importing bootstrap-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
body{
	width:100%;
	height:100%;
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

<!-- navigation bar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Registrar</a>
    </div>
    <div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          
		  <li><a href="reg.php"><span class="glyphicon glyphicon-chevron-left"></span> Back</a></li>
		  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-tasks"></span> Options<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="change_password.php"><span class="glyphicon glyphicon-pushpin"></span> Change Password</a></li>
				<li><a href="reg_advanced_signup.php"><span class="glyphicon glyphicon-plus"></span> Add Account</a></li>
				<li><a href="add_event.php"><span class="glyphicon glyphicon-plus"></span> Add a Pic to Home</a></li>
				<li><a href="login.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
			</ul>
			</li>
        </ul>
      </div>
    </div>
  </div>
</nav>
<br><br><br>

<!-- request diplaying area -->
<div class='container'>

<?php

$requests_query="SELECT COUNT(*) FROM signup_requests";
if($is_requests_query_run=mysqli_query($connect,$requests_query)){
	while($requests_query_execute=mysqli_fetch_assoc($is_requests_query_run)){
		if($requests_query_execute['COUNT(*)']==0){
			echo "<div class='row'><div class='col-md-4'></div><div class='col-md-4'>"."<p align='center'><label>No new requests</label></p>"."</div></div>";
		}
	}
}

$requests_query="SELECT * FROM signup_requests WHERE Recommendation1_Accept=1 AND Recommendation2_Accept=1";

if($is_requests_query_run=mysqli_query($connect,$requests_query)){
	$itr1=0;
	echo "<div class='container'><table class='table table-striped'><thead><tr><th>Admission No.</th><th>Firstname</th><th>Lastname</th><th></th></tr></thead><tbody>";
	while($requests_query_execute=mysqli_fetch_assoc($is_requests_query_run)){
		$admissionArray[$itr1]=$requests_query_execute['Admission'];
		$firstnameArray[$itr1]=$requests_query_execute['Firstname'];
		$lastnameArray[$itr1]=$requests_query_execute['Lastname'];
		$passwordArray[$itr1]=$requests_query_execute['Password'];
		$acceptedArray[$itr1]=$requests_query_execute['Accepted'];
		echo "<tr>";
		echo "<td>".$requests_query_execute['Admission']."</td>";
		echo "<td>".$requests_query_execute['Firstname']."</td>";
		echo "<td>".$requests_query_execute['Lastname']."</td>";
		if($acceptedArray[$itr1]){echo "<td><input class='form-control' type='radio' checked disabled></td>";}
		else{echo "<td><input class='form-control' type='radio' disabled></td>";}
		echo "<td><form method='post' action='requests.php'><input class='form-control' type='submit' name='".$admissionArray[$itr1]."' value='ACCEPT'></td>";
		echo "<td><input class='form-control' type='submit' name='".$admissionArray[$itr1]."undo"."' value='REJECT'></form></td>";
		$itr1++;
		echo "</tr>";
	}
	echo "</table></div>";
}

for($itr2=0;$itr2<$itr1;$itr2++){
	$accept=(string)$admissionArray[$itr2];
	$accepted_query="UPDATE `signup_requests` SET `Accepted` = '1' WHERE `signup_requests`.`Admission` = '".$accept."' ";
	if(isset($_POST[$accept])){
		$is_accepted_query_run=mysqli_query($connect,$accepted_query);
		if($is_accepted_query_run){
			header ("location:requests.php");
		}

	}
}

for($itr3=0;$itr3<$itr1;$itr3++){
	$accept=(string)$admissionArray[$itr3];
	$undo=(string)$admissionArray[$itr3]."undo";
	$undo_query="UPDATE signup_requests SET Accepted = '0' WHERE signup_requests.Admission = '".$accept."' ";
	if(isset($_POST[$undo])){
		$is_undo_query_run=mysqli_query($connect,$undo_query);
		if($is_undo_query_run){
			//echo "jump";
			header ("location:requests.php");
		}

	}
}

if(isset($_POST["done"])){
	for($itr4=0;$itr4<$itr1;$itr4++){
		$admission=(string)$admissionArray[$itr4];
		$password=(string)$passwordArray[$itr4];
		$firstname=(string)$firstnameArray[$itr4];
		$lastname=(string)$lastnameArray[$itr4];
		$accepted=(string)$acceptedArray[$itr4];
		$count_query="SELECT COUNT(*) FROM member_details";
		$memID="oba".count_queries($count_query);
		echo ++$memID;
		echo $firstname;
		echo $lastname;
		echo $admission;
		$add1_query="INSERT INTO members_login_details (MembershipID, Password) VALUES ('$memID', '$password')";
		$add2_query="INSERT INTO member_details (MembershipID, Firstname, Lastname, Address1, Address2,Mobile, Fixed, Email, Birthday, NIC, Occupation, Civil_status, Admission,Begin, End,Pic) VALUES ('$memID', '$firstname', '$lastname', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$admission', NULL, NULL,NULL)";
		$add3_query="INSERT INTO temp_login_details (Admission, Password, MembershipID) VALUES ('$admission', '$password', '$memID')";
		$add4_query="INSERT INTO members_contributions (MembershipID, Contributions) VALUES ('$memID', NULL)";
		if($accepted=='1'){
			$is_add1_query_run=mysqli_query($connect,$add1_query);
			$is_add2_query_run=mysqli_query($connect,$add2_query);
			$is_add3_query_run=mysqli_query($connect,$add3_query);
			$is_add4_query_run=mysqli_query($connect,$add4_query);
			if($is_add1_query_run){
				//echo "jump";
			}
			if($is_add2_query_run){
				//echo "jump";
			}
			if($is_add3_query_run){
				//echo "jump";
			}
			if($is_add4_query_run){
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
