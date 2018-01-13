<?php
session_start();

//access controlling
if(!isset($_SESSION["memID"]) || !isset($_SESSION["password"])){
	if($_SESSION['memID']!="reg000"){
		header ("location:login.php");
	}
}

//importing pages
require 'connect.php';require 'function.php';


$count_query="SELECT COUNT(*) FROM member_details";
$memID_temp="oba".count_queries($count_query);
$memID=++$memID_temp;
$passowrd=sha1($memID);

//updating attributes
if(isset($_POST["add_member"])){
	$check_query="SELECT * FROM member_details WHERE Admission='".$_POST['admission']."'";
	if(check_queries($check_query)){
		echo "yes";
		$add_query="INSERT INTO members_login_details (MembershipID, Password) VALUES ('$memID', '$passowrd')";
		$add2_query="INSERT INTO members_contributions (MembershipID,Contributions) VALUES ('$memID',NULL)";
		$update_memID_firstname_lastname_admission_query="INSERT INTO member_details (MembershipID, Firstname, Lastname, Address1, Address2,Mobile, Fixed, Email, Birthday, NIC, Occupation, Civil_status, Admission,Begin, End) VALUES ('$memID', '".$_POST["firstname"]."','".$_POST["lastname"]."', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL,'".$_POST["admission"]."', NULL, NULL)";
		$update_address1_query="UPDATE `member_details` SET `Address1` = '".$_POST["address1"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
		$update_address2_query="UPDATE `member_details` SET `Address2` = '".$_POST["address2"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
		$update_mobile_query="UPDATE `member_details` SET `Mobile` = '".$_POST["mobile"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
		$update_fixed_query="UPDATE `member_details` SET `Fixed` = '".$_POST["fixed"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
		$update_email_query="UPDATE `member_details` SET `Email` = '".$_POST["email"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
		$update_birthday_query="UPDATE `member_details` SET `Birthday` = '".$_POST["birthday"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
		$update_nic_query="UPDATE `member_details` SET `NIC` = '".$_POST["nic"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
		$update_occupation_query="UPDATE `member_details` SET `Occupation` = '".$_POST["occupation"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
		$update_begin_query="UPDATE `member_details` SET `Begin` = '".$_POST["begin"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
		$update_end_query="UPDATE `member_details` SET `End` = '".$_POST["end"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
		$update_pic_query="UPDATE `member_details` SET `Pic` = 'NULL'  WHERE `member_details`.`MembershipID` = '".$memID."'";

		$is_add_query_run=mysqli_query($connect,$add_query);
		$is_add2_query_run=mysqli_query($connect,$add2_query);
		$is_update_memID_query_run=mysqli_query($connect,$update_memID_firstname_lastname_admission_query );
		if(isset($_POST["address1"])){$is_update_address1_query_run=mysqli_query($connect,$update_address1_query );}
		if(isset($_POST["address2"])){$is_update_address2_query_run=mysqli_query($connect,$update_address2_query );}
		if(isset($_POST["mobile"])){$is_update_mobile_query_run=mysqli_query($connect,$update_mobile_query );}
		if(isset($_POST["fixed"])){$is_update_fixed_query_run=mysqli_query($connect,$update_fixed_query );}
		if(isset($_POST["email"])){$is_update_email_query_run=mysqli_query($connect,$update_email_query );}
		if(isset($_POST["birthday"])){$is_update_birthday_query_run=mysqli_query($connect,$update_birthday_query );}
		if(isset($_POST["nic"])){$is_update_nic_query_run=mysqli_query($connect,$update_nic_query );}
		if(isset($_POST["occupation"])){$is_update_occupation_query_run=mysqli_query($connect,$update_occupation_query );}
		//if(isset($_POST["civil_status"])){$is_update_civil_status_query_run=mysqli_query($connect,$update_civil_status_query );}
		if(isset($_POST["begin"])){$update_begin_query_run=mysqli_query($connect,$update_begin_query );}
		if(isset($_POST["end"])){$update_end_query_run=mysqli_query($connect,$update_end_query );}
	}header ("location:reg_advanced_signup.php");
}

?>

<html>
<head>
<!--setting the title-->
<title>Add a Member</title>
	<!--importing bootstrap-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
body{
	width:100%;
	height:100%;
	background-size:cover;
}
#one{
			width:100%;
			height:100%;
			background-color:#000;
			background-size:cover;
		}
</style>
</head>
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
      <a class="navbar-brand"><?php echo "<b>Add A Member</b>"; ?></a>
    </div>
    <div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="#details1"></a></li>
		  <li><a href="reg.php"><span class="glyphicon glyphicon-chevron-left"></span> Back</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>
<br><br><br>

<!-- form area -->
<form enctype="multipart/form-data" action="reg_advanced_signup.php" method="post">
	<div class="container" align="center" style="background-color:#AFEEEE">
		<div class="container-fluid" style="background-color:#00EEEE"><h2>Contact Details</h2></div><h2></h2>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>MembershipID </label></div>
			<div class="col-md-4"><input class="form-control" type="text" name="memID" readonly value="<?php echo $memID;?>">
			</div>
		</div>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>First Name </label></div>
			<div class="col-md-4"><input class="form-control" type="text" name="firstname" required>
			</div>
		</div>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>Last Name </label></div>
			<div class="col-md-4"><input class="form-control" type="text" name="lastname" required>
			</div>
		</div>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>Address1 </label></div>
			<div class="col-md-4"><input class="form-control" type="text" name="address1">
			</div>
		</div>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>Address2 </label></div>
			<div class="col-md-4"><input class="form-control" type="text" name="address2">
			</div>
		</div>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>Mobile No. </label></div>
			<div class="col-md-4"><input class="form-control" type="text" name="mobile" placeholder="07X-XXXXXXX">
			</div>
		</div>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>Fixed Tel No. </label></div>
			<div class="col-md-4"><input class="form-control" type="text" name="fixed" placeholder="0XX-XXXXXXX">
			</div>
		</div>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>e-mail </label></div>
			<div class="col-md-4"><input class="form-control" type="email" name="email" placeholder="example@email.com">
			</div>
		</div>

		<div class="row"><h2></h2></div>
	</div><h2></h2>

	<div class="container" align="center" style="background-color:#AFEEEE;">
		<div class="container-fluid" style="background-color:#00EEEE"><h2>Personal Details</h2></div><h2></h2>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>Birthday</label></div>
			<div class="col-md-4"><input class="form-control" type="date" name="birthday" placeholder="YYYY-MM-DD">
			</div>
		</div>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>National ID no.</label></div>
			<div class="col-md-4"><input class="form-control" type="text" name="nic" placeholder="XXXXXXXXXV">
			</div>
		</div>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>Occupation</label></div>
			<div class="col-md-4"><input class="form-control" type="text" name="occupation">
			</div>
		</div>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>Civil Status</label></div>
			<div class='col-md-2'><label>Single  </label><input type='radio' name='civil_status' value='Single'></div>
			<div class='col-md-2'><label>Married  </label><input type='radio' name='civil_status' value='Married'></div>
		</div>

		<div class="row"><h2></h2></div>
	</div><h2></h2>

	<div class="container" align="center"style="background-color:#AFEEEE"><h2></h2>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>Admission no.</label></div>
			<div class="col-md-4"><input class="form-control" type="text" name="admission" required>
			</div>
		</div>

		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-2" align="left"><label>Period of Study</label></div>
			<div class="col-md-2"><label>From </label><input class="form-control" type="date" name="begin" placeholder="YYYY-MM-DD">
			</div>
			<div class="col-md-2"><label>To </label><input class="form-control" type="date" name="end" placeholder="YYYY-MM-DD">
			</div>
		</div><h2></h2>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4"><input class="form-control" type="submit" name="add_member" value="ADD MEMBER"></div>
		</div><br><br>
	</div>
</form>
</body>
</html>
