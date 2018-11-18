<!DOCTYPE html>
<html>
<head>
	<title>
		<?php
			if(isset($_POST['admission']))echo "SIGNUP ".$_POST['admission'];
		?>
	</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
				<li class="inactive"><a href="index.php"><font color=black>Home</font></a></li>
				<li class="active"><a>Signup</a></li>
			</ul>
		</div>
	</div><h2></h2>
</div>

<?php
if(!isset($_POST["password"])){
	header ("location:index.php");
}
$admissionStatus=true;
$passwordStatus=true;
//importing pages
require 'connect.php';require 'function.php';

$admission = mysqli_real_escape_string($connect, $_POST['admission']);
$password = mysqli_real_escape_string($connect, $_POST['password']);

$signup_query="SELECT * FROM member_details WHERE Admission='{$admission}'";

if($is_signup_query_run=mysqli_query($connect,$signup_query)){
			if(mysqli_num_rows($is_signup_query_run) == 1){
				$admissionStatus=false;
				display_alerts("info","signup.php","Account for this Admission No , is already created.");
			}
}
if(isset($_POST["signup_submit"])){
	if(isset($_POST['password'])&&isset($_POST['rpassword'])){
		if($_POST['password']==$_POST['rpassword']){
			$admission = mysqli_real_escape_string($connect, $_POST['admission']);
			$password = sha1(mysqli_real_escape_string($connect, $_POST['password']));

			$signup_query="SELECT * FROM member_details WHERE Admission='".$admission."'";

			if($is_signup_query_run=mysqli_query($connect,$signup_query)){
						if(mysqli_num_rows($is_signup_query_run) == 1){
							$admissionStatus=false;
							display_alerts("info","signup.php","Your request was unsuccessful.");

						}else{
							$firstname = mysqli_real_escape_string($connect, $_POST['firstname']);
							$lastname = mysqli_real_escape_string($connect, $_POST['lastname']);
							$recommendation1 = mysqli_real_escape_string($connect, $_POST['recommendation1']);
							$recommendation2 = mysqli_real_escape_string($connect, $_POST['recommendation2']);
							$accepted = mysqli_real_escape_string($connect, 'false');
							$memID_searching_query1="SELECT MembershipID FROM member_details WHERE Admission='$recommendation1' ";
							$memID_searching_query2="SELECT MembershipID FROM member_details WHERE Admission='$recommendation2' ";
							$is_memID_searching_query1_run=mysqli_query($connect,$memID_searching_query1);
							$is_memID_searching_query2_run=mysqli_query($connect,$memID_searching_query2);
							$memID_searching_query1_execute=mysqli_fetch_assoc($is_memID_searching_query1_run);
							$memID_searching_query2_execute=mysqli_fetch_assoc($is_memID_searching_query2_run);
							$recommendation1_memID=$memID_searching_query1_execute["MembershipID"];
							$recommendation2_memID=$memID_searching_query2_execute["MembershipID"];
							$request_query="INSERT INTO `signup_requests` (`Admission`, `Firstname`, `Lastname`, `Password`, `Recommendation1`, `Recommendation1_Accept`, `Recommendation2`, `Recommendation2_Accept`, `Accepted`) VALUES ('$admission', '$firstname', '$lastname', '$password', '$recommendation1_memID', false, '$recommendation2_memID', false, false)";
							$is_request_query_run=mysqli_query($connect,$request_query);
							if(!$is_request_query_run){
								display_alerts("danger","signup.php","Your signup request isn't sent successfully!");
							}
							session_start();
							$_SESSION['status']=true;
							header ("location:index.php");
						}
			}
		}
		else{
			display_alerts("info","signup.php","Passwords aren't matching");
		}
	}
	else {
		$passwordStatus=false;
		display_alerts("danger","signup.php","Your signup request isn't sent successfully!");
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
				<div class="col-md-4" align="right"><label><font color="#FFFFFF">Admission No. </font></label></div>
				<div class="col-md-6" align="right"> <input class="form-control" type="text" name="admission" value=<?php if($admissionStatus){echo $_POST['admission'];}else {echo '';}?>></div>
			</div><h6></h6>
			<div class="row">
				<div class="col-md-4" align="right"><label><font color="#FFFFFF">Add Recommendations </font></label></div>
				<div class="col-md-3" align="right"> <input class="form-control" type="text" name="recommendation1" placeholder="admission no." title="Enter admission no." required></div>
				<div class="col-md-3" align="right"> <input class="form-control" type="text" name="recommendation2" placeholder="admission no." title="Enter admission no." required></div>
			</div><h6></h6>
			<div class="row">
				<div class="col-md-4" align="right"><label><font color="#FFFFFF">Password </font></label> </div>
				<div class="col-md-6" align="right"> <input class="form-control" type="password" name="password" id="password" value="<?php if($passwordStatus){echo $_POST['password'];}else{echo '';}?>" required></div>
			<a class="btn" onclick="myFunction()"><span class="glyphicon glyphicon-eye-open"></span></a>
		</div><h6></h6>
			<div class="row">
				<div class="col-md-4" align="right"><label><font color="#FFFFFF">Re-enter Password </font></label></div>
				<div class="col-md-6" align="right"><input class="form-control" type="password" name="rpassword" id="rpassword"></div><a class="btn" onclick="myFunctionR()"><span class="glyphicon glyphicon-eye-open"></span></a>
			</div><h6></h6>
			<div class="row">
				<div class="col-md-4" align="right"></div>
				<div class="col-md-6" align="right"><input class="form-control" type="submit" value="SIGNUP" name="signup_submit"></div>
			</div>
		</p>
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

function myFunctionR() {
    var x = document.getElementById("rpassword");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
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
