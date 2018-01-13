<?php
session_start();

//importing pages
require 'connect.php';require 'function.php';

//access controlling
if(!isset($_SESSION["memID"]) || !isset($_SESSION["password"])){
	header ("location:login.php");
}

//assigning variables
$memID=$_SESSION['memID'];
$password=$_SESSION['password'];
?>
<!DOCTYPE html>
<html>
<head>
<title>Change Password</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- importing bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<!-- adding styles -->
	<style>
		body{
			width:100%;
			height:100%;
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
<button type="button" class="btn btn-default" onclick='location.href="<?php if($memID=="reg000"){echo "reg.php";}else if($memID=="sec000"){echo "sec.php";}else{echo "user.php";}?>";'><span class="glyphicon glyphicon-chevron-left"></span> Back</button>
<form action="change_password.php" method="post">
	<div class="container"><br><br><h1 align='center'>Change Password</h1><br><br>
		<div class="row" align="right">
			<div class="col-md-4"><h4>Old Password</h4></div>
			<div class="col-md-4"><input class="form-control" type="password" name="old_password" required></div>
		</div>
		<div class="row" align="right">
			<div class="col-md-4"><h4>New Password</h4></div>
			<div class="col-md-4"><input class="form-control" type="password" name="new_password" id="new_password" required></div>
			<div class="col-md-1" align="left"><a class="btn" onclick="myFunction()"><span class="glyphicon glyphicon-eye-open"></span></a></div>
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
<script type="text/javascript">

$(document).ready(function () {

window.setTimeout(function() {
    $(".alert").fadeTo(1500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 3000);

});

function myFunction() {
    var x = document.getElementById("new_password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>
</body>
<?php
		//displaying alerts & updating passwords
		if(isset($_POST['change'])){
			if($_POST['old_password']!=$password){
				display_alerts("info","change_password.php","Old password is not correct");
			}else{
				if($_POST['new_password']!=$_POST['rnew_password']){
					display_alerts("info","change_password.php","New password are not matching");
				}
				else{
					//updating passwords
					$new_password=sha1($_POST['new_password']);
					$update_password_query="UPDATE `members_login_details` SET `Password` = '".$new_password."' WHERE `members_login_details`.`MembershipID` = '".$memID."'";
					$is_update_firstname_query_run=mysqli_query($connect,$update_password_query );
					$_SESSION['password']=$_POST['new_password'];
					if($memID=="reg000"){header ('location:reg.php');}
					else if($memID=="sec000"){header ('location:sec.php');}
					else if($memID=="admin000"){header ('location:admin.php');}
					else{header ('location:user.php');}
				}
			}
		}
?>

</html>
