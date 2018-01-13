<?php
	session_start();
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
			$insert_pic_query="INSERT INTO `home` (`Pic`, `Comment`) VALUES ('".$upload_to.$file_name."', NULL)";
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
</head>
<body>
	<div class="container middle">
		<h1>Image Upload</h1>
		<h3>Choose an Image and click Upload</h3>

		<form action="add_event.php" method="post" enctype="multipart/form-data">
			<input type="file" name="image" id="">
			<button type="submit" name="submit">Submit / Reset</button>
			<!-- <button type="reset">Reset</button> -->
		</form>
	</div>

</body>
</html>
