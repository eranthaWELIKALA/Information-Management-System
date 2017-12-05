<?php
session_start();
require 'connect.php';
		if(!isset($_SESSION["memID"]) || !isset($_SESSION["password"])){
			header ("location:login.php");
		}

		$memID=$_SESSION['memID'];
		$password=$_SESSION['password'];
?>
<!DOCTYPE html>
<html>
<head>
<title>Change Password</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap.min.css">
	<script src="jquery.min.js"></script>
	<script src="bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<style>
		body{
			width:100%;
			height:100%;
			background-image:url('userbackground.jpg');
			background-size:cover;
			padding:15px;
		}
		#one{
			width:100%;
			height:100%;
			background-image:url('navbar.jpg');
			background-size:cover;
		}
				
		.nav-pills > li.active > a, .nav-pills > li.active > a:focus {
			color: black;
			background-color: #fcd900;
		}

		.nav-pills > li.active > a:hover {
			background-color: #000000;
			color:white;
		}
	</style>
</head>

<body>
<form action="change_password.php" method="post">
	<div class="container"><br><br><h1 align='center'>Change Password</h1><br><br>
		<div class="row" align="right">
			<div class="col-md-4"><h4>Old Password</h4></div>
			<div class="col-md-4"><input class="form-control" type="password" name="old_password" required></div>
		</div>
		<div class="row" align="right">
			<div class="col-md-4"><h4>New Password</h4></div>
			<div class="col-md-4"><input class="form-control" type="password" name="new_password" required></div>
		</div>
		<div class="row" align="right">
			<div class="col-md-4"><h4>Re-enter Password</h4></div>
			<div class="col-md-4"><input class="form-control" type="password" name="rnew_password" required></div>
		</div><br>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4"><input class="form-control" type="submit" name="change" value="CHANGE"></div>
		</div>
	</div>
</form>

</body>
<?php
		if(isset($_POST['change'])){
			if($_POST['old_password']!=$password){
				echo '<div class="container" align="center">
									<div class="row">
										<div class="col-md-3"></div>
										<div class="col-md-6">
											<div class="alert alert-info alert-dismissable">
											<a href="change_password.php" class="close" data-dismiss="alert" arial-label="close">&times</a>
											<strong>Old password is not correct</strong></div><br>
										</div>
										<div class="col-md-3"></div>
									</div>
								</div>';
			}else{
				if($_POST['new_password']!=$_POST['rnew_password']){
					echo '<div class="container" align="center">
									<div class="row">
										<div class="col-md-3"></div>
										<div class="col-md-6">
											<div class="alert alert-info alert-dismissable">
											<a href="change_password.php" class="close" data-dismiss="alert" arial-label="close">&times</a>
											<strong>New password are not matching</strong></div><br>
										</div>
										<div class="col-md-3"></div>
									</div>
								</div>';
				}
				else{
					$update_password_query="UPDATE `members_login_details` SET `Password` = '".$_POST['new_password']."' WHERE `members_login_details`.`MembershipID` = '".$memID."'";
					$is_update_firstname_query_run=mysqli_query($connect,$update_password_query );
					$_SESSION['password']=$_POST['new_password'];
					header ('location:user.php');
				}
			}
		}
?>

</html>