<?php
session_start();
$memID=$_SESSION["memID"];
require 'connect.php';require 'function.php';
?>
<html>
<head>
	<title>Recommendation Requests</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
      <a class="navbar-brand" href="#"><?php echo "<b>".$_SESSION['memID']."</b>"; ?></a>
    </div>
    <div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
			<li><a href="user.php"><span class="glyphicon glyphicon-chevron-left"></span>Back</a></li>
			<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-tasks"></span> Options<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="change_password.php"><span class="glyphicon glyphicon-pushpin"></span> Change Password</a></li>
				<li><a href="edit_request.php"><span class="glyphicon glyphicon-plus"></span> Send An Editing Request</a></li>
				<li><a href="login.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
			</ul>
			</li>
        </ul>
      </div>
    </div>
  </div>
</nav>



</body>
</html>

<br>
<?php

$requests_query="SELECT COUNT(*) FROM signup_requests WHERE Recommendation1='$memID' OR Recommendation2='$memID'";
if($is_requests_query_run=mysqli_query($connect,$requests_query)){
	while($requests_query_execute=mysqli_fetch_assoc($is_requests_query_run)){
		if($requests_query_execute['COUNT(*)']==0){
			echo "<div class='row'><div class='col-md-4'></div><div class='col-md-4'>"."<p align='center'><label>No recommendation requests</label></p>"."</div></div>";
		}
	}
}

$requests_query="SELECT * FROM signup_requests WHERE Recommendation1='$memID' OR Recommendation2='$memID'";
if($is_requests_query_run=mysqli_query($connect,$requests_query)){
	$itr1=0;
	echo "<div class='container'><table class='table table-striped'><thead><tr><th>Admission No.</th><th>Firstname</th><th>Lastname</th><th></th></tr></thead><tbody>";
	while($requests_query_execute=mysqli_fetch_assoc($is_requests_query_run)){
		$admissionArray[$itr1]=$requests_query_execute['Admission'];
		$firstnameArray[$itr1]=$requests_query_execute['Firstname'];
		$lastnameArray[$itr1]=$requests_query_execute['Lastname'];
		$passwordArray[$itr1]=$requests_query_execute['Password'];
		$recommendation1Array[$itr1]=$requests_query_execute['Recommendation1'];
		$recommendation2Array[$itr1]=$requests_query_execute['Recommendation2'];
		if($recommendation1Array[$itr1]==$memID){
			$acceptedArray[$itr1]=$requests_query_execute['Recommendation1_Accept'];
		}
		else{
			$acceptedArray[$itr1]=$requests_query_execute['Recommendation2_Accept'];
		}
		echo "<tr>";
		echo "<td>".$requests_query_execute['Admission']."</td>";
		echo "<td>".$requests_query_execute['Firstname']."</td>";
		echo "<td>".$requests_query_execute['Lastname']."</td>";
		if($acceptedArray[$itr1]){echo "<td><input class='form-control' type='radio' checked disabled></td>";}
		else{echo "<td><input class='form-control' type='radio' disabled></td>";}
		echo "<td><form method='post' action='recommendation.php'><input class='form-control' type='submit' name='".$admissionArray[$itr1]."' value='RECOMMEND'></td>";
		echo "<td><input class='form-control' type='submit' name='".$admissionArray[$itr1]."undo"."' value='DO NOT'></form></td>";
		$itr1++;
		echo "</tr>";
	}
	echo "</table></div>";
}

for($itr2=0;$itr2<$itr1;$itr2++){
	$accept=(string)$admissionArray[$itr2];
	if($recommendation1Array[$itr2]==$memID){
		$accepted_query="UPDATE `signup_requests` SET `Recommendation1_Accept` = '1' WHERE `signup_requests`.`Admission` = '".$accept."' ";
	}
	else if($recommendation2Array[$itr2]==$memID){
		$accepted_query="UPDATE `signup_requests` SET `Recommendation2_Accept` = '1' WHERE `signup_requests`.`Admission` = '".$accept."' ";
	}
	if(isset($_POST[$accept])){
		$is_accepted_query_run=mysqli_query($connect,$accepted_query);
		if($is_accepted_query_run){
			header ("location:recommendation.php");
		}

	}
}

for($itr3=0;$itr3<$itr1;$itr3++){
	$accept=(string)$admissionArray[$itr3];
	$undo=(string)$admissionArray[$itr3]."undo";
	if($recommendation1Array[$itr3]==$memID){
		$undo_query="UPDATE signup_requests SET Recommendation1_Accept = '0' WHERE signup_requests.Admission = '".$accept."' ";
	}
	else if($recommendation2Array[$itr3]==$memID){
		$undo_query="UPDATE signup_requests SET Recommendation2_Accept = '0' WHERE signup_requests.Admission = '".$accept."' ";
	}
	if(isset($_POST[$undo])){
		$is_undo_query_run=mysqli_query($connect,$undo_query);
		if($is_undo_query_run){
			//echo "jump";
			header ("location:recommendation.php");
		}

	}
}

?>