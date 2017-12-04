<!DOCTYPE html>
<html>
<head>
	<title>
		<?php
			if(isset($_POST['memID']))echo "SIGNUP ".$_POST['memID'];
		?>
	</title>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
		body{
			width:100%;
			height:100%;
			background-image:url('background-2.jpg');
			background-size:cover;
			padding: 15px;
		}
		#one{
			width:100%;
			height:100%;
			background-image:url('background-6.jpg');
			background-position: center;
			background-size:cover;
		}
		#two{
			background-image:url('background-9.jpg');
			background-repeat:no-repeat;
			background-size: 900px 400px;
			background-position: center;
			padding: 35px;
			border-radius: 50px;
		}
		.nav-pills > li.active > a, .nav-pills > li.active > a:focus {
			color: white;
			background-color: #800000;
		}

		.nav-pills > li.inactive{
			background-color: #ADD8E6;
			border-radius:5px;
		}

        .nav-pills > li.active > a:hover {
            background-color: #800000;
            color:white;
        }
		.form-control.submit{
			background-color: #800000;
		}
	</style>
</head>

<body>

<!--navigation bar-->
<div class="container" id="one"><h2></h2>
	<div class="row">
		<div class="col-md-10"></div>
		<div class="col-md-2">
			<ul class="nav nav-pills red">
				<li class="inactive"><a href="home.php"><font color=black>Home</font></a></li>
				<li class="active"><a>Signup</a></li>
			</ul>
		</div>
	</div><h2></h2>
</div>

<?php
if(!isset($_POST["signup"])){
	header ("location:home.php");
}
$memIDStatus=true;
$passwordStatus=true;
require 'connect.php';

$memID = mysqli_real_escape_string($connect, $_POST['memID']);
$password = mysqli_real_escape_string($connect, $_POST['password']);

$signup_query="SELECT * FROM members_login_details WHERE MembershipID='{$memID}'";

if($is_signup_query_run=mysqli_query($connect,$signup_query)){
			if(mysqli_num_rows($is_signup_query_run) == 1){
				$memIDStatus=false;
				echo '<div class="container" align="center">
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-6">
								<div class="alert alert-info alert-dismissable">
								<a href="signup.php" class="close" data-dismiss="alert" arial-label="close">&times</a>
								<strong>Account for this Membership Id, is already created.</strong></div><br>
							</div>
							<div class="col-md-3"></div>
						</div>
					</div>';
			}
}
if(isset($_POST['password'])&&isset($_POST['rpassword'])){
	if($_POST['password']==$_POST['rpassword']){
		if(isset($_POST["signup_submit"])){
			$memID = mysqli_real_escape_string($connect, $_POST['memID']);
			$password = mysqli_real_escape_string($connect, $_POST['password']);

			$signup_query="SELECT * FROM members_login_details WHERE MembershipID='{$memID}'";

			if($is_signup_query_run=mysqli_query($connect,$signup_query)){
						if(mysqli_num_rows($is_signup_query_run) == 1){
							$memIDStatus=false;
							echo '<div class="container" align="center">
									<div class="row">
										<div class="col-md-3"></div>
										<div class="col-md-6">
											<div class="alert alert-info alert-dismissable">
											<a href="signup.php" class="close" data-dismiss="alert" arial-label="close">&times</a>
											<strong>Account for this Membership Id, is already created.</strong></div><br>
										</div>
										<div class="col-md-3"></div>
									</div>
								</div>';
						}else{
							require 'connect.php';
							$memID = mysqli_real_escape_string($connect, $_POST['memID']);
							$firstname = mysqli_real_escape_string($connect, $_POST['firstname']);
							$lastname = mysqli_real_escape_string($connect, $_POST['lastname']);
							$accepted = mysqli_real_escape_string($connect, 'false');
							$request_query="INSERT INTO signup_requests (MembershipID, Firstname, Lastname, Password, Accepted) VALUES ('$memID', '$firstname', '$lastname', '$password',false)";
							$is_request_query_run=mysqli_query($connect,$request_query);
							if(!$is_request_query_run){
									echo '<div class="container">
												<div class="row">
													<div class="col-md-4"></div>
													<div class="col-md-4">
														<div class="alert alert-danger alert-dismissable">
														<a href="signup.php" class="close" data-dismiss="alert" arial-label="close">&times</a>
														<strong>Your signup request isn\'t sent successfully!</strong></div><br>
													</div>
													<div class="col-md-4"></div>
												</div>
											</div>';		
							}
							header ("location:home.php");
						}
			}
		}
	}
	else {
		$passwordStatus=false;
		echo '<div class="container">
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4">
						<div class="alert alert-danger alert-dismissable">
							<a href="signup.php" class="close" data-dismiss="alert" arial-label="close">&times</a>
							<strong>Your signup request isn\'t sent successfully!</strong>
							</div><br>
					</div>
					<div class="col-md-4"></div>
				</div>
			</div>';
	}
}
?>

<h6></h6>

<!--form area-->
<div class="container" id="two">
	<form action="signup.php" method="post">
		<p align="center">
			<div class="row">
				<div class="col-md-4" align="right"><label><font color="#FFFFFF">First Name </font></label></div>
				<div class="col-md-6" align="right"> <input class="form-control" type="text" name="firstname" required></div>
			</div><h6></h6>
			<div class="row">
				<div class="col-md-4" align="right"><label><font color="#FFFFFF">Last Name </font></label></div>
				<div class="col-md-6" align="right"> <input class="form-control" type="text" name="lastname" required></div>
			</div><h6></h6>
			<div class="row">
				<div class="col-md-4" align="right"><label><font color="#FFFFFF">Membership ID </font></label></div>
				<div class="col-md-6" align="right"> <input class="form-control" type="text" name="memID" value=<?php if($memIDStatus){echo $_POST['memID'];}else {echo '';}?>></div>
			</div><h6></h6>
			<div class="row">
				<div class="col-md-4" align="right"><label><font color="#FFFFFF">Password </font></label></div>
				<div class="col-md-6" align="right"> <input class="form-control" type="password" name="password" value=<?php if($passwordStatus){echo $_POST['password'];}else{echo '';}?>></div>
			</div><h6></h6>
			<div class="row">
				<div class="col-md-4" align="right"><label><font color="#FFFFFF">Re-enter Password </font></label></div>
				<div class="col-md-6" align="right"><input class="form-control" type="password" name="rpassword"></div>
			</div><h6></h6>
			<div class="row">
				<div class="col-md-4" align="right"></div>
				<div class="col-md-6" align="right"><input class="form-control" type="submit" value="SIGNUP" name="signup_submit"></div>
			</div>
		</p>
	</form>
</div>

</body>

</html>
