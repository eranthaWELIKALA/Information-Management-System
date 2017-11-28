<?php
session_start();session_destroy();
?>

<html>
<head><title>LOGIN</title>
<link href="bootstrap.min.css" rel="stylesheet">
<script src="bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<div class="row"><div class="col-md-10"></div><div class="col-md-2">
	<ul class="nav nav-pills">
		<li><a href="home.php">Home</a></li>
		<li class="active"><a>Login</a></li>
	</ul>
	</div></div>
</div>
<fieldset>
<div class="container" align="center" >
	<div style="width:196;height:196;border:2px solid #33b2ff;background-color:Gray;border-radius: 25px;">
	<img src="login.png" class="img-circle" alt="Cinque Terre" width="176" height="176"> 
	</div>
</div>
</fieldset>
<br>
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
				if($_SESSION['memID']=="reg000"){
					header ("location:reg.php");
				}
				else{
					header ("location:user.php");
				}
			}
			else{ echo '<div class="container">
						<div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-4">
								<div class="alert alert-danger alert-dismissable">
								<a href="login.php" class="close" data-dismiss="alert" arial-label="close">&times</a>
								<strong>Incorrect username or password</strong></div><br>
							</div>
							<div class="col-md-4"></div>
						</div>
					</div>';
			}
		}
		
	}
}

?>
