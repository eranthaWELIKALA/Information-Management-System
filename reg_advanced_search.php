<?php
	session_start();

	//access controlling
	if(!isset($_SESSION["memID"]) || !isset($_SESSION["password"])){
		if($_SESSION['memID']!="reg000"){
			header ("location:login.php");
		}
	}

	//checking page function requirements
	if(!isset($_SESSION['searched_memID'])){header ("location:reg.php");}

	//importing pages
	require 'connect.php';	require 'function.php';

	$details_query="SELECT * FROM member_details  WHERE MembershipID='".$_SESSION['searched_memID']."'";
	$memID=$_SESSION['searched_memID'];
	if($is_details_query_run=mysqli_query($connect,$details_query)){
		$query_execute=mysqli_fetch_assoc($is_details_query_run);
	}


//updating attributes
if(isset($_POST["update"])){
	$update_firstname_query="SELECT * `member_details` WHERE `Firstname` = '".$_POST["firstname"]."'";
	$update_lastname_query="SELECT * `member_details` WHERE `Lastname` = '".$_POST["lastname"]."'";
	$update_address1_query="SELECT * `member_details` WHERE `Address1` = '".$_POST["address1"]."'";
	$update_address2_query="SELECT * `member_details` WHERE `Address2` = '".$_POST["address2"]."'";
	$update_mobile_query="SELECT * `member_details` WHERE `Mobile` = '".$_POST["mobile"]."'";
	$update_fixed_query="SELECT * `member_details` WHERE `Fixed` = '".$_POST["fixed"]."'";
	$update_email_query="SELECT * `member_details` WHERE `Email` = '".$_POST["email"]."'";
	$update_birthday_query="SELECT * `member_details` WHERE `Birthday` = '".$_POST["birthday"]."'";
	$update_nic_query="SELECT * `member_details` WHERE `NIC` = '".$_POST["nic"]."'";
	$update_occupation_query="SELECT * `member_details` WHERE `Occupation` = '".$_POST["occupation"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
	$update_civil_status_query="SELECT * `member_details` WHERE `Civil_status` = '".$_POST["civil_status"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
	$update_addmission_query="SELECT * `member_details` WHERE `Admission` = '".$_POST["admission"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
	$update_begin_query="SELECT * `member_details` WHERE `Begin` = '".$_POST["begin"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";
	$update_end_query="SELECT * `member_details` WHERE `End` = '".$_POST["end"]."'  WHERE `member_details`.`MembershipID` = '".$memID."'";

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
	header ("location:reg_advanced_search.php");
}


?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $_SESSION['searched_memID']; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  body {
      position: relative;
  }
  #details1 {padding-top:50px;height:775px;color: #000; background-color: #1E88E5;}
  #details2 {padding-top:50px;height:675px;color: #000; background-color: #673ab7;}
  #details3 {padding-top:50px;height:675px;color: #000; background-color: #ff9800;}
  </style>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">

<!-- navigation bar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><?php echo "<b>".$_SESSION['searched_memID']."</b>"; ?></a>
    </div>
    <div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="#details1">Contact Details</a></li>
          <li><a href="#details2">Personal Details</a></li>
		  <li><a href="#details3">Contributions</a></li>
		  <li><a href="reg.php"><span class="glyphicon glyphicon-chevron-left"></span> Back</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<!-- form area -->
<form action="reg_advanced_search.php" method="post">
<div id="details1" class="container-fluid"><br><br>
  <h1>Contact Details</h1>
  <div class='container'>
		<div class="row">
			<div class="col-md-10"></div>
			<div class="col-md-2"><?php if($query_execute['Pic']!=NULL){echo "<img src = '".$query_execute['Pic']."' style = 'height:150px;width:150px'>";}else{echo "<img src = 'pics/default.png' style = 'height:150px;width:150px'>";} ?></div>
		</div><br>
	<table class='table table-bordered table-striped'><tbody><input class="form-control" type="submit" name="update" value="Update"><br>
  <tr><td>Firstname</td><td><input class="form-control" type="text" name="firstname" value="<?php
																										echo $query_execute['Firstname'];
																										refresh('Firstname');
																									?>"></td></tr>
  <tr><td>Lastname</td><td><input class="form-control" type="text" name="lastname" value="<?php
																									echo $query_execute['Lastname'];
																									refresh('Lastname');
																								?>"></td></tr>
  <tr><td>Address1</td><td><input class="form-control" type="text" name="address1" value="<?php
																									echo $query_execute['Address1'];
																									refresh('Address1');
																								?>"></td></tr>
  <tr><td>Address2</td><td><input class="form-control" type="text" name="address2" value="<?php
																									echo $query_execute['Address2'];
																									refresh('Address2');
																								?>"></td></tr>
  <tr><td>Mobile No.</td><td><input class="form-control" type="text" name="mobile" placeholder="07X-XXXXXXX" value="<?php
																															echo $query_execute['Mobile'];
																															refresh('Mobile');
																														?>"></td></tr>
  <tr><td>Fixed Tel No.</td><td><input class="form-control" type="text" name="fixed" placeholder="0XX-XXXXXXX" value="<?php
																															echo $query_execute['Fixed'];
																															refresh('Fixed');
																														?>"></td></tr>
  <tr><td>email</td><td><input class="form-control" type="email" name="email" placeholder="example@email.com" value="<?php
																																	echo $query_execute['Email'];
																																	refresh('Email');
																																?>"></td></tr>
  </tbody></table></div>
</div>
<div id="details2" class="container-fluid"><br><br>
  <h1>Personal Details</h1><br><br>
  <div class='container'><table class='table table-bordered table-striped'><tbody>
  <tr><td>Birthday</td><td><input class="form-control" type="date" name="birthday" placeholder="YYYY-MM-DD" value="<?php
																																echo $query_execute["Birthday"];
																																refresh('Birthday');
																															?>"></td></tr>
  <tr><td>National ID no.</td><td><input class="form-control" type="text" name="nic" placeholder="XXXXXXXXXV" value="<?php
																															echo $query_execute["NIC"];
																															refresh('NIC');
																														?>"></td></tr>
  <tr><td>Occupation</td><td><input class="form-control" type="text" name="occupation" value="<?php
																										echo $query_execute["Occupation"];
																										refresh('Occupation');
																									?>"></td></tr>
  <tr><td>Civil Status</td><td><?php
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
			?></td></tr>
  </tbody></table>
  <table class='table table-bordered table-striped'><tbody>
  <tr><td>Admission no.</td><td><input class="form-control" type="text" name="admission" value="<?php
																										echo $query_execute["Admission"];
																										refresh('Admission');
																									?>"></td><td></td></tr>
  <tr><td>Period of Study</td><td>from: <input class="form-control" type="date" name="begin" placeholder="YYYY-MM-DD" value="<?php
																																			echo $query_execute["Begin"];
																																			refresh('Begin');
																																		?>"></td><td>to: <input class="form-control" type="date" name="end" placeholder="YYYY-MM-DD" value="<?php
																																		echo $query_execute["End"];
																																		refresh('End');
																																		?>"></td></tr>
  </tbody></table></form>
  </div>
</div>

<!-- contribution form area -->
<div id="details3" class="container-fluid"><br><br>
  <h1>Contributions</h1><br><br>
  <div class='container'>
	<div class='row'>
		<form action='reg_advanced_search.php' method='post'>
		<div class='col-md-4'>
		<input class='form-control' type='text' name='add' placeholder='This is a new contribution.'>
		</div>
		<div class='col-md-2'>
		<input class='form-control' type='submit' name='add_con' value='Add new a contribution' >
		</div>
		</form>
	</div>
  </div><br><br>

  <?php
	//updating contribution
	if(isset($_SESSION['searched_memID'])){
	if(isset($_POST['add_con'])){
		if(isset($_POST['add'])){
			update_query();
		}
		else{
			display_alerts("warning","reg_advanced_search.php","There is no new contribution");
		}
	}
	 echo "<div class='container'><div class='row'><div class='col-md-9'><textarea class='form-control' rows='6' cols='25' readonly>". show_query()."</textarea></div></div></div>";
}
	?>
</div>
<script type="text/javascript">

$(document).ready(function () {

window.setTimeout(function() {
    $(".alert").fadeTo(1500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 3000);

});
</script>
</body>
</html>
