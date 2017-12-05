<?php
		session_start();
		if(!isset($_SESSION["admission"]) || !isset($_SESSION["password"])){
			header ("location:temp_login.php");
		}

		$admission=$_SESSION['admission'];
		$password=$_SESSION['password'];
		
		require 'connect.php';
		$details_query="SELECT * FROM temp_login_details  WHERE Admission='$admission'";

		if($is_details_query_run=mysqli_query($connect,$details_query)){
			$details_query_execute=mysqli_fetch_assoc($is_details_query_run);
		} 
		
		if(isset($_POST['done'])){
		$delete_query="DELETE FROM `temp_login_details` WHERE `temp_login_details`.`Admission` = '$admission' ";
			if($is_delete_query_run=mysqli_query($connect,$delete_query)){
				//echo "Done";
				header ("location:login.php");
			}
		}
?>
<!DOCTYPE html>
<html>
<head>
<title>
	<?php
		echo "Hello ". $details_query_execute['Admission'];
	?>
</title>
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
	</style>
</head>
<body>
<div class="container"><form action="temp_user.php" method="post">
		<div class='row'>
		<?php echo "<p align='center'><h1>Your MembershipID is ".$details_query_execute['MembershipID'].'</h1></p>'; ?>
		</div>
		<div class='row'>
		<div class='col-md-5'></div>
		<div class='col-md-2'><input class='form-control' type='submit' name='done' value='DONE !'></div>
</form></div>
</body>
</html>