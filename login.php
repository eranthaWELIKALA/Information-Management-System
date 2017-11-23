


<html>
<head><title>LOGIN</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<form action="login.php" method="post"><p align="center">
<table>
<tr>
<td>Membership ID : </td>
<td><input class="form-control" type="text" name="memID" placeholder="ex: 123" required></td>
</tr>
<tr>
<td>Password : </td>
<td><input class="form-control" type="password" name="password" placeholder="ex: ****" required></td>
<td><input class="form-control" type="submit" value="LOGIN" name="submit"></td>
</tr></table><table>
</p>
</form>
</body>
</html>
<?php
if(isset($_POST["submit"])){
	$error =array();
	if(empty(trim($_POST["memID"]))){
		$error="memID";	
	}
	if(empty(trim($_POST["password"]))){
		$error="password";	
	}
	if(empty($error)){
		session_start();
		require 'connect.php';
		$memID = mysqli_real_escape_string($connect, $_POST['memID']);
		$password = mysqli_real_escape_string($connect, $_POST['password']);
		$query="SELECT * FROM members_login_details WHERE MembershipID='{$memID}' AND Password='{$password}' LIMIT 1";
		if($is_query_run=mysqli_query($connect,$query)){
			if(mysqli_num_rows($is_query_run) == 1){
				$_SESSION['memID']=$_POST["memID"];
				$_SESSION['password']=$_POST["password"];
				//$row =  mysqli_fetch_assoc($is_query_run);
				header ("location:user.php");
			}
			else{ echo '<div class="container">
						<div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-4">
								<div class="alert alert-danger alert-dismissable">
								<a href="login.php" class="close" data-dismiss="alert" arial-label="close">&times</a>
								<strong>Incorrect username</strong></div><br>
							</div>
							<div class="col-md-4"></div>
						</div>
					</div>';
			}
		}
		
	}
}

?>