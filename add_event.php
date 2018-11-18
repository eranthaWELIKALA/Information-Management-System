<?php
	session_start();
	
	//access controlling
	if(!isset($_SESSION["memID"]) || !isset($_SESSION["password"])){
		if($_SESSION['memID']!="reg000"){
			header ("location:login.php");
		}
	}

	//checking page function requirements
	if(!isset($_SESSION['searched_memID'])){header ("location:reg.php");}

	//importing pages
	require 'connect.php';	require 'function.php';
	
	$file_uploaded = '0';
	$upload_to = 'home_pics/';

	if (isset($_POST['submit'])) {
		# code...
		$file_name = $_FILES['image']['name'];
		$file_type = $_FILES['image']['type'];
		$file_size = $_FILES['image']['size'];
		$file_tmp_name = $_FILES['image']['tmp_name'];
		$file_extension = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));

		$valid_file_types = array('jpeg', 'jpg', 'png', 'gif');

		//checking file type is valid or not
		if(in_array($file_extension,$valid_file_types)){
			$valid_file_extension = ".".strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
			$file_uploaded = move_uploaded_file($file_tmp_name, $upload_to.$file_name.$valid_file_extension);
			require 'connect.php';
			$insert_pic_query="INSERT INTO `home` (`Pic`, `Description`) VALUES ('".$upload_to.$file_name."', NULL)";
			$insert_pic_query_run=mysqli_query($connect,$insert_pic_query );
			header('location:reg.php');
		}
		else{
			header('location:reg.php');
		}
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>IMage Upload</title>
	<style type="text/css">
		.middle {
		    position: absolute;
		    top: 50%;
		    left: 50%;
		    transform: translate(-50%, -50%);
		    text-align: center;
		    margin-top: -50px;
		}
		.print{

			margin: 5px;
			background-color: green;
		}
	</style>
	<!-- importing bootstrap -->
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
	<div class="container middle">
		<h1>Image Upload</h1>
		<h3>Choose an Image and click Upload</h3>

		<form action="add_event.php" method="post" enctype="multipart/form-data">
			<input class="form-control" type="file" name="image" id="">
			<button type="submit" name="submit">Submit / Reset</button>
			<!-- <button type="reset">Reset</button> -->
		</form>
	</div>

</body>
</html>
