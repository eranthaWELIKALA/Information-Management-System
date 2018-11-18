<!DOCTYPE html>
<?php
session_start();session_destroy();
//importing pages
	require 'connect.php';require 'function.php';
?>

<html>
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<style>
		body{
			width:100%;
			height:100%;
			background-size:cover;
			padding: 15px;
		}
		#one{
			width:100%;
			height:100%;
			background-color:#157DEC;
			background-position: center;
			background-size:cover;
		}
		.nav-pills > li.active > a, .nav-pills > li.active > a:focus {
			color: black;
			background-color: #FFFFFF;
		}
		.nav-pills > li.active > a:hover {
            background-color: #000000;
            color:white;
        }
		.nav-pills > li.inactive{
			color:black;
			background-color: #000000;
			border-radius:5px;
		}

        
	</style>
</head>

<body>
<br>
<!--navigation bar-->
<div class="container" id="one">
	<br>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8" align="center"><h2><font color="#FFFFFF">Old Boys Association - Login</font></h2></div>
		<div class="col-md-2">
			<ul class="nav nav-pills">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" style="color:#000000"></span><font color="#000000"> Home</font></a></li>
				<li class="active"><a><span class="glyphicon glyphicon-user"></span> Login</a></li>
			</ul>
		</div>
	</div>
	<br>
</div>

<br><br>

<div class="container">
	<!--login logo-->
	<fieldset>
	<div class="container" align="center" >
		<div>
		<img src="login.png" class="img-circle" alt="Cinque Terre" width="176" height="176">
		</div>
	</div>
	</fieldset>

	<br><br>

	<!--login form area-->
	<form action="login.php" method="post">
		<div class="row">
			<div class="col-md-4" align="right"><label><font color="#ff0000">Membership ID : </font></label></div>
			<div class="col-md-4"><input class="form-control" type="text" name="memID" placeholder="ex: 123" required></div><div class='col-md-1'><a href="temp_login.php" class="btn btn-info btn-lg" title="No Membership ID ? Try this out">
          <span class="glyphicon glyphicon-question-sign"></span></a></div>
		</div>
		<div class="row" align="center">
			<div class="col-md-4" align="right"><label><font color="#ff0000">Password : </font></label></div>
			<div class="col-md-4"><input class="form-control" type="password" name="password" id="password" placeholder="ex: ****" required></div>
			<div class="col-md-1" align="left"><a class="btn" onclick="myFunction()"><span class="glyphicon glyphicon-eye-open"></span></a></div>
		</div><h6></h6>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4"><input class="form-control" style="background-color:#38ACEC;color:black;" type="submit" value="LOGIN" name="submit"></div>
		</div>
	</form>
</div>
<script type="text/javascript">

$(document).ready(function () {

		window.setTimeout(function() {
		    $(".alert").fadeTo(1500, 0).slideUp(500, function(){
		        $(this).remove();
		    });
		}, 3000);

		});

function myFunction() {
		var x = document.getElementById("password");
		if (x.type === "password") {
				x.type = "text";
		} else {
				x.type = "password";
		}
}
</script>
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
		$password = sha1(mysqli_real_escape_string($connect, $_POST['password']));
		$query="SELECT * FROM members_login_details WHERE MembershipID='{$memID}' AND Password='{$password}' LIMIT 1";
		if($is_query_run=mysqli_query($connect,$query)){
			$query_execute=mysqli_fetch_assoc($is_query_run);
			if(mysqli_num_rows($is_query_run) == 1){
				if($memID==$query_execute['MembershipID'] && $password==$query_execute['Password']){
				$_SESSION['memID']=$_POST["memID"];
				$_SESSION['password']=$_POST["password"];
				//$row =  mysqli_fetch_assoc($is_query_run);
				if($_SESSION['memID']=="reg000"){
					header ("location:reg.php");
				}
				else if($_SESSION['memID']=="sec000"){
					header ("location:sec.php");
				}
				else if($_SESSION['memID']=="admin000"){
					header ("location:admin.php");
				}
				else{
					header ("location:user.php");
				}
				}else{ 
				display_alerts("danger","login.php","<p align='center'>Incorrect username or password.</p>");
			}
			}
			else{ 
				display_alerts("danger","login.php","<p align='center'>Incorrect username or password.</p>");
			}
		}

	}
}

?>
