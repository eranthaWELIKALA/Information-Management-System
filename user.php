<?php
		session_start();
		if(!isset($_SESSION["memID"]) || !isset($_SESSION["password"])){
			header ("location:login.php");
		}

		$memID=$_SESSION['memID'];
		$password=$_SESSION['password'];
		
		require 'connect.php';

		$details_query="SELECT * FROM member_details  WHERE MembershipID='$memID'";

		if($is_details_query_run=mysqli_query($connect,$details_query)){
			$query_execute=mysqli_fetch_assoc($is_details_query_run);
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

<?php

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
	$update_addmission_query="UPDATE `member_details` SET `Admission` = '".$_POST["admission"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
	$update_begin_query="UPDATE `member_details` SET `Begin` = '".$_POST["begin"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
	$update_end_query="UPDATE `member_details` SET `End` = '".$_POST["end"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
	$update_image_query="UPDATE `member_details` SET `Image` = '".$_POST["image"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
	
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
	if(isset($_POST["admission"])){$update_addmission_query_run=mysqli_query($connect,$update_addmission_query );}
	if(isset($_POST["begin"])){$update_begin_query_run=mysqli_query($connect,$update_begin_query );}
	if(isset($_POST["end"])){$update_end_query_run=mysqli_query($connect,$update_end_query );}
	if(isset($_POST["image"])){$update_image_query_run=mysqli_query($connect,$update_image_query );}
	header ("location:user.php");
}

function refresh($attribute){
	if(isset($_POST["update"])){
		echo $query_execute[$attribute];
	}
}

?>

<body>

<br>

<div class="container" id="one">
	<div class="row"><div class="col-md-10">
									<?php
								require_once('connect.php');
								$result = $conn->prepare("SELECT * FROM tbl_image ORDER BY tbl_image_id ASC");
								$result->execute();
								for($i=0; $row = $result->fetch(); $i++){
								$id=$row['tbl_image_id'];
							?>
					
								
									<?php if($row['image_location'] != ""): ?>
									<img src="uploads/<?php echo $row['image_location']; ?>" width="100px" height="100px" style="border:1px solid #333333;">
									<?php else: ?>
									<img src="images/default.png" width="100px" height="100px" style="border:1px solid #333333;">
									<?php endif; ?>
								
								
								
									 <a href="#delete<?php echo $id;?>"  data-toggle="modal"  class="btn btn-warning" >Update Image</a>
										
										
										
										
										<!-- Modal -->
							<div id="delete<?php  echo $id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							
							<div class="modal-header">
							<h3 id="myModalLabel">Update profile picture</h3>
							</div>
							<div class="modal-body">
							<div class="alert alert-danger">
							<?php if($row['image_location'] != ""): ?>
							
							<img src="uploads/<?php echo $row['image_location']; ?>" width="100px" height="100px" style="border:1px solid #333333; margin-left: 30px;">
							<?php else: ?>
							<img src="images/default.png" width="100px" height="100px" style="border:1px solid #333333; margin-left: 30px;">
							<?php endif; ?>
							<form action="edit_PDO.php<?php echo '?tbl_image_id='.$id; ?>" method="post" enctype="multipart/form-data">
							<div style="color:blue; margin-left:150px; font-size:30px;">
								<input type="file" name="image" style="margin-top:-115px;">
							</div>
							
							</div>
							<hr>
							<div class="modal-footer">
							<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">No</button>
							<button type="submit" name="submit" class="btn btn-danger">Yes</button>
							</form>
							</div>
							</div>
							</div>
								<?php } ?>
								</div><div class="col-md-2"><h2></h2>
	<div class="container" align="center">
	<ul class="nav nav-pills">
		<li class="active"><a href="#"><?php echo $memID;?></a></li>
		<li><a href="login.php"><span class="glyphicon glyphicon-off" style="color:#ffd900"></span><font color="#fcd900"> Logout</font></a></li>
	</ul>
	</div><h2></h2>
	</div>
	</div>
</div>

<h2></h2>

<form enctype="multipart/form-data" action="user.php" method="post">
	<div class="container" align="center" style="background-color:#AFEEEE">
		<h2>Contact Details</h2>

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
		<h2>Personal Details</h2>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>Birthday</label></div>
			<div class="col-md-4"><input class="form-control" type="text" name="birthday" placeholder="YYYY-MM-DD" value="<?php 
																																echo $query_execute["Birthday"];
																																refresh('Birthday');
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
																										refresh('Admission');
																									?>">
			</div>
		</div>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>Period of Study</label></div>
			<div class="col-md-2"><label>From </label><input class="form-control" type="text" name="begin" placeholder="YYYY-MM-DD" value="<?php 
																																			echo $query_execute["Begin"];
																																			refresh('Begin');
																																		?>">
			</div>
			<div class="col-md-2"><label>To </label><input class="form-control" type="text" name="end" placeholder="YYYY-MM-DD" value="<?php 
																																		echo $query_execute["End"];
																																		refresh('End');
																																		?>">
			</div>
		</div><h2></h2>
	</div>
</form>

</body>
</html>                 
