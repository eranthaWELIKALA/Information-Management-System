<?php
		session_start();

		//access controlling
		if(!isset($_SESSION["memID"]) || !isset($_SESSION["password"])){
			header ("location:login.php");
		}
		if($_SESSION["memID"]=="sec000" || $_SESSION["memID"]=="reg000" || $_SESSION["memID"]=="admin000"){
			header ("location:login.php");
		}

		//setting variables
		$memID=$_SESSION['memID'];
		$password=$_SESSION['password'];

		//importing pages
		require 'connect.php';require 'function.php';

		$details_query="SELECT * FROM member_details  WHERE MembershipID='$memID'";
		$contribution_details_query="SELECT * FROM `members_contributions` WHERE MembershipID='$memID'";
		if($is_details_query_run=mysqli_query($connect,$details_query)){
			$query_execute=mysqli_fetch_assoc($is_details_query_run);

			//calculate age
			//echo strtotime(date("d/m/Y"));
			$date1=date_create($query_execute["Birthday"]);
			$date2=date_create(strtotime(date("d/m/Y")));
			$age=date_diff($date1,$date2);
		}
		if($is_contribution_details_query_run=mysqli_query($connect,$contribution_details_query)){
			$contribution_query_execute=mysqli_fetch_assoc($is_contribution_details_query_run);
		}
		
?>

<!DOCTYPE html>
<html>
<head>
<title>
	<?php
		echo "Hello ". $query_execute['Firstname'];
	?>
</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
			background-image:url('background-1.jpg');
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

<?php
	$file_uploaded = '0';
	$upload_to = 'pics/';
//updating attributes
if(isset($_POST["update"])){
	$update_firstname_query="UPDATE `member_details` SET `Firstname` = '".$_POST["firstname"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
	$update_lastname_query="UPDATE `member_details` SET `Lastname` = '".$_POST["lastname"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
	$update_address1_query="UPDATE `member_details` SET `Address1` = '".$_POST["address1"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
	$update_address2_query="UPDATE `member_details` SET `Address2` = '".$_POST["address2"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
	$update_mobile_query="UPDATE `member_details` SET `Mobile` = '".$_POST["mobile"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
	$update_fixed_query="UPDATE `member_details` SET `Fixed` = '".$_POST["fixed"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
	$update_email_query="UPDATE `member_details` SET `Email` = '".$_POST["email"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
	$update_birthday_query="UPDATE `member_details` SET `Birthday` = '".$_POST["birthday"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
	$update_nic_query="UPDATE `member_details` SET `NIC` = '".$_POST["nic"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
	$update_occupation_query="UPDATE `member_details` SET `Occupation` = '".$_POST["occupation"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
	$update_civil_status_query="UPDATE `member_details` SET `Civil_status` = '".$_POST["civil_status"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
	$update_begin_query="UPDATE `member_details` SET `Begin` = '".$_POST["begin"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
	$update_end_query="UPDATE `member_details` SET `End` = '".$_POST["end"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";

	if(isset($_POST["firstname"])){$is_update_firstname_query_run=mysqli_query($connect,$update_firstname_query );}
	if(isset($_POST["lastname"])){$is_update_lastname_query_run=mysqli_query($connect,$update_lastname_query );}
	if(isset($_POST["address1"])){$is_update_address1_query_run=mysqli_query($connect,$update_address1_query );}
	if(isset($_POST["address2"])){$is_update_address2_query_run=mysqli_query($connect,$update_address2_query );}
	if(isset($_POST["mobile"])){$is_update_mobile_query_run=mysqli_query($connect,$update_mobile_query );}
	if(isset($_POST["fixed"])){$is_update_fixed_query_run=mysqli_query($connect,$update_fixed_query );}
	if(isset($_POST["email"])){$is_update_email_query_run=mysqli_query($connect,$update_email_query );}
	if(isset($_POST["birthday"])){$is_update_birthday_query_run=mysqli_query($connect,$update_birthday_query );}
	if(isset($_POST["nic"])){$is_update_nic_query_run=mysqli_query($connect,$update_nic_query );}
	if(isset($_POST["occupation"])){$is_update_occupation_query_run=mysqli_query($connect,$update_occupation_query );}
	if(isset($_POST["civil_status"])){$is_update_civil_status_query_run=mysqli_query($connect,$update_civil_status_query );}
	if(isset($_POST["begin"])){$update_begin_query_run=mysqli_query($connect,$update_begin_query );}
	if(isset($_POST["end"])){$update_end_query_run=mysqli_query($connect,$update_end_query );}
	
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
			$file_uploaded = move_uploaded_file($file_tmp_name, $upload_to.$memID.$valid_file_extension);
			require 'connect.php';
			$update_pic_query="UPDATE `member_details` SET `Pic` = '".$upload_to.$memID.$valid_file_extension."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
			$update_pic_query_run=mysqli_query($connect,$update_pic_query );
			//header('location:user.php');
		}
		else{
			//header('location:user.php');
		}
	$delete_edit_request_query="DELETE FROM `edit_requests` WHERE `edit_requests`.`MembershipID` = '".$memID."' ";
	$is_delete_edit_query_run=mysqli_query($connect,$delete_edit_request_query);
	header ("location:user.php");
}



?>

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
      <a class="navbar-brand" href="#"><?php echo "<b>".$_SESSION['memID']."</b>"; ?></a>
    </div>
    <div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
			<li><a href="user.php"><span class="glyphicon glyphicon-chevron-left"></span> Back</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<br>
<br>
<br>

<div style="float:left;width:80%">
<form enctype="multipart/form-data" action="user_edit.php" method="post">
	<div class="container" align="center" style="background-color:#AFEEEE">
		<div class="container-fluid" style="background-color:#00EEEE"><h2>Contact Details</h2></div><h2></h2>

		<div class="row">
			<div class="col-md-7"></div>
			<div class="col-md-3">
					<input class="form-control" type="file" name="image" id="">
			 </div>
			<div class="col-md-2"> <?php if($query_execute['Pic']!=NULL){echo "<img src = '".$query_execute['Pic']."' style = 'height:150px;width:150px'>";}else{echo "<img src = 'pics/default.png' style = 'height:150px;width:150px'>";} ?> </div>
		</div>
<br>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>First Name </label></div>
			<div class="col-md-4"><input class="form-control" type="text" name="firstname" value="<?php
																										echo $query_execute['Firstname'];
																										refresh('Firstname');
																									?>">
			</div>
			<div class="col-md-2"></div>
			<div class="col-md-2"><input class="form-control" type="submit" name="update" value="Update"></div>
		</div>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>Last Name </label></div>
			<div class="col-md-4"><input class="form-control" type="text" name="lastname" value="<?php
																									echo $query_execute['Lastname'];
																									refresh('Lastname');
																								?>">
			</div>
		</div>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>Address1 </label></div>
			<div class="col-md-4"><input class="form-control" type="text" name="address1" value="<?php
																									echo $query_execute['Address1'];
																									refresh('Address1');
																								?>">
			</div>
		</div>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>Address2 </label></div>
			<div class="col-md-4"><input class="form-control" type="text" name="address2" value="<?php
																									echo $query_execute['Address2'];
																									refresh('Address2');
																								?>">
			</div>
		</div>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>Mobile No. </label></div>
			<div class="col-md-4"><input class="form-control" type="text" name="mobile" placeholder="07X-XXXXXXX" value="<?php
																															echo $query_execute['Mobile'];
																															refresh('Mobile');
																														?>">
			</div>
		</div>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>Fixed Tel No. </label></div>
			<div class="col-md-4"><input class="form-control" type="text" name="fixed" placeholder="0XX-XXXXXXX" value="<?php
																															echo $query_execute['Fixed'];
																															refresh('Fixed');
																														?>">
			</div>
		</div>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>e-mail </label></div>
			<div class="col-md-4"><input class="form-control" type="email" name="email" placeholder="example@email.com" value="<?php
																																	echo $query_execute['Email'];
																																	refresh('Email');
																																?>">
			</div>
		</div>

		<div class="row"><h2></h2></div>
	</div><h2></h2>

	<div class="container" align="center" style="background-color:#AFEEEE;">
		<div class="container-fluid" style="background-color:#00EEEE"><h2>Personal Details</h2></div><h2></h2>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>Birthday</label></div>
			<div class="col-md-4"><input class="form-control" type="date" name="birthday" placeholder="YYYY-MM-DD" value=<?php
																														echo $query_execute["Birthday"];
																																	refresh('Birthday');
																															?> >
			</div>
		</div>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>Age</label></div>
			<div class="col-md-4"><input class="form-control" type="text" placeholder="YYYY-MM-DD" readonly value="<?php

																																echo $age->format("Years: %y, Months: %m, Days: %d.");
																															?>">
			</div>
		</div>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>National ID no.</label></div>
			<div class="col-md-4"><input class="form-control" type="text" name="nic" placeholder="XXXXXXXXXV" value="<?php
																															echo $query_execute["NIC"];
																															refresh('NIC');
																														?>">
			</div>
		</div>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>Occupation</label></div>
			<div class="col-md-4"><input class="form-control" type="text" name="occupation" value="<?php
																										echo $query_execute["Occupation"];
																										refresh('Occupation');
																									?>">
			</div>
		</div>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>Civil Status</label></div>
			<?php
			if($query_execute["Civil_status"]=="Single"){
				echo "<div class='col-md-2'><label>Single  </label><input type='radio' name='civil_status' value='Single' checked></div>
					<div class='col-md-2'><label>Married  </label><input type='radio' name='civil_status' value='Married'></div>";
			}
			else if($query_execute["Civil_status"]=="Married"){
				echo "<div class='col-md-2'><label>Single  </label><input type='radio' name='civil_status' value='Single'></div>
					<div class='col-md-2'><label>Married  </label><input type='radio' name='civil_status' value='Married' checked></div>";
			}else{
				echo "<div class='col-md-2'><label>Single  </label><input type='radio' name='civil_status' value='Single'></div>
					<div class='col-md-2'><label>Married  </label><input type='radio' name='civil_status' value='Married'></div>";
			}
			?>
		</div>

		<div class="row"><h2></h2></div>
	</div><h2></h2>

	<div class="container" align="center"style="background-color:#AFEEEE"><h2></h2>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>Admission no.</label></div>
			<div class="col-md-4"><input class="form-control" type="text" name="admission" value="<?php
																										echo $query_execute["Admission"];
																									?>" readonly>
			</div>
		</div>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>Period of Study</label></div>
			<div class="col-md-2"><label>From </label><input class="form-control" type="date" name="begin" placeholder="YYYY-MM-DD" value="<?php
																																			echo $query_execute["Begin"];
																																			refresh('Begin');
																																		?>">
			</div>
			<div class="col-md-2"><label>To </label><input class="form-control" type="date" name="end" placeholder="YYYY-MM-DD" value="<?php
																																		echo $query_execute["End"];
																																		refresh('End');
																																		?>">
			</div>
		</div><h2></h2>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>Contribution</label></div>
			<div class="col-md-4"><textarea class='form-control' rows='6' cols='25' readonly><?php	echo $contribution_query_execute['Contributions'];?></textarea>
			</div>
		</div><br>
	</div>
</form>
</div>

</body>
</html>
