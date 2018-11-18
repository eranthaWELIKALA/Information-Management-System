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
<title>Edit Requests</title>
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

$requests_query="SELECT COUNT(*) FROM edit_requests";
if($is_requests_query_run=mysqli_query($connect,$requests_query)){
	while($requests_query_execute=mysqli_fetch_assoc($is_requests_query_run)){
		if($requests_query_execute['COUNT(*)']==0){
			echo "<div class='row'><div class='col-md-4'></div><div class='col-md-4'>"."<p align='center'><label>No new edit requests</label></p>"."</div></div>";
		}
	}
}

$requests_query="SELECT * FROM edit_requests WHERE Seen=0";
$itr1=0;
if($is_requests_query_run=mysqli_query($connect,$requests_query)){
	
	echo "<div class='container'><table class='table table-striped'><thead><tr><th>Firstname</th><th>Lastname</th><th></th></tr></thead><tbody>";
	while($requests_query_execute=mysqli_fetch_assoc($is_requests_query_run)){
		$membershipId=$requests_query_execute['MembershipID'];
		$requests_query2="SELECT * FROM member_details WHERE MembershipID='".$membershipId."'";
		$is_requests_query2_run=mysqli_query($connect,$requests_query2);
		$requests_query2_execute=mysqli_fetch_assoc($is_requests_query2_run);
		$firstnameArray[$itr1]=$requests_query2_execute['Firstname'];
		$lastnameArray[$itr1]=$requests_query2_execute['Lastname'];
		$memIDArray[$itr1]=$requests_query_execute['MembershipID'];
		$seenArray[$itr1]=$requests_query_execute['Seen'];
		echo "<tr>";
		echo "<td>".$requests_query2_execute['Firstname']."</td>";
		echo "<td>".$requests_query2_execute['Lastname']."</td>";
		if($seenArray[$itr1]){echo "<td><input class='form-control' type='radio' checked disabled></td>";}
		else{echo "<td><input class='form-control' type='radio' disabled></td>";}
		echo "<td><form method='post' action='edit_requests.php'><input class='form-control' type='submit' name='".$memIDArray[$itr1]."' value='ACCEPT'></td>";
		echo "<td><input class='form-control' type='submit' name='".$memIDArray[$itr1]."undo"."' value='REJECT'></form></td>";
		$itr1++;
		echo "</tr>";
	}
	echo "</table></div>";
}

for($itr2=0;$itr2<$itr1;$itr2++){
	$accept=(string)$memIDArray[$itr2];
	$accepted_query="UPDATE `edit_requests` SET `Seen` = '1' WHERE `edit_requests`.`MembershipID` = '".$accept."' ";
	if(isset($_POST[$accept])){
		$is_accepted_query_run=mysqli_query($connect,$accepted_query);
		if($is_accepted_query_run){
			header ("location:edit_requests.php");
		}

	}
}

for($itr3=0;$itr3<$itr1;$itr3++){
	$accept=(string)$memIDArray[$itr3];
	$undo=(string)$memIDArray[$itr3]."undo";
	$undo_query="UPDATE edit_requests SET Seen = '0' WHERE edit_requests.MembershipID = '".$accept."' ";
	if(isset($_POST[$undo])){
		$is_undo_query_run=mysqli_query($connect,$undo_query);
		if($is_undo_query_run){
			//echo "jump";
			header ("location:edit_requests.php");
		}

	}
}

if(isset($_POST["done"])){
	header ('location:reg.php');
}

if(isset($_POST["deleteall"])){
	$delete_query="DELETE FROM edit_requests";
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
<script type="text/javascript">

$(document).ready(function () {

window.setTimeout(function() {
    $(".alert").fadeTo(1500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 3000);

});
</script>



</html>
