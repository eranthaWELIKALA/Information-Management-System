<!DOCTYPE html>
<?php
session_start();require 'connect.php';
if(!isset($_SESSION["memID"]) || !isset($_SESSION["password"])){
	header ("location:login.php");
}

if(isset($_POST['search'])){
	seach_query();
}
?>


<html>


<head><title>Hello, Registrar!</title>
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
	background-size:cover;
	padding:15px;
}
#one{
			width:100%;
			height:100%;
			background-image:url('navbar.jpg');
			background-size:cover;
		}
</style>
	</head>
	<body>
	<!--<input type="submit" name="button" id="button" value="Submit" disabled>
	<input type="checkbox" name="accept" id="accept" value="abc">-->
<div class="container" id="one"><h2></h2>
	<div class="col-md-2"><input class='form-control' type='button' name='add_account' onclick="location.href='reg_advanced_signup.php'" value='Add Account'></div>
	<div class="col-md-2"><button type="button" class="btn btn-default" onclick="location.href='change_password.php';">Change Password</button></div>
	<div class="col-md-6"></div>
	<div class="col-md-2">
	<ul class="nav nav-pills">
		<li class="active"><a href="#"><?php echo "Registrar";?></a></li>
		<li><a href="login.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
	</ul><h2></h2></div>
</div>
<div class='container'>
	<div class='row'>
		<div class='col-md-9'>
		<div class='container'>
			<div class='row'>
			<h2></h2>
				<form action='reg.php' method='post'>
				<div class='col-md-4'>
				<input class='form-control' type='text' name='search_memID' value="<?php
				if(isset($_SESSION['searched_memID'])){echo $_SESSION['searched_memID'];}?>">
				</div>
				<div class='col-md-2'>
				<input class='form-control' type='submit' name='search' value='Search by ID'>
				</div>
				<div class='col-md-2'>
				<input class='form-control' type='button' name='advanced_search' onclick="location.href='reg_advanced_search.php'" value='Advanced Search'>
				</div>
				</form>
			</div>
			<h2></h2>
			<div class='row'>
			<?php if(isset($_POST['search'])){echo "<h1>".seach_query()[0]."</h1><h1>".seach_query()[1]."</h1><h1>".seach_query()[2]."</h1>" ;}?>
			</div>
		</div>
		</div>
	<div class='col-md-3'>
		<h2></h2>
		<div class='panel-group'><div class='panel panel-info'><div class='panel-heading'>Notifications</div>
		<div class='panel-body'><table><tr><td>
		<a href="requests.php"><span class="glyphicon glyphicon-envelope"></span>unseen requests</a></td><td>
		<span class="badge">
				  <?php
				  $requests1_query="SELECT COUNT(*) FROM signup_requests WHERE Accepted=false";
				  notification($requests1_query);
					?>
			  </span>
			  </td></tr><tr><td>
			  <a href="requests.php"><span class="glyphicon glyphicon-envelope"></span>pending requests</a></td><td>
			  <span class="badge">
				  <?php
				  $requests2_query="SELECT COUNT(*) FROM signup_requests";
				  notification($requests2_query);
					?>
			  </span></td></tr></table>
		</div></div></div></div></div></div>

<?php
function notification($requests_query){
	require 'connect.php';
	if($is_requests_query_run=mysqli_query($connect,$requests_query)){
		while($requests_query_execute=mysqli_fetch_assoc($is_requests_query_run)){
			echo $requests_query_execute['COUNT(*)'];
		}
	}
	else
	{
		echo '<div class="container">
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4">
						<div class="alert alert-danger alert-dismissable">
						<a href="reg.php" class="close" data-dismiss="alert" arial-label="close">&times</a>
						<strong>WTF</strong></div><br>
					</div>
					<div class="col-md-4"></div>
				</div>
			</div>';
	}
}

function seach_query(){
	require 'connect.php';
	$search_query="SELECT * FROM `member_details` WHERE MembershipID='".$_POST['search_memID']."'";
	if($is_search_query_run=mysqli_query($connect,$search_query)){
		if(!empty($search_query_execute=mysqli_fetch_assoc($is_search_query_run))){
			$_SESSION['searched_memID']=$search_query_execute['MembershipID'];
			$returning_array[0]=$search_query_execute['MembershipID'];
			$returning_array[1]=$search_query_execute['Firstname'];
			$returning_array[2]=$search_query_execute['Lastname'];
			return $returning_array;
		}
			else{ 
			echo '<div class="container">
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<div class="alert alert-danger alert-dismissable">
							<a href="reg.php" class="close" data-dismiss="alert" arial-label="close">&times</a>
							<strong>There is no account from this membershipID</strong>
							</div><br>
						</div>
						<div class="col-md-4"></div>
					</div>
				</div>';
		}
	}
}

function show_query(){
	require 'connect.php';
	$show_contribution_query="SELECT * FROM `members_contributions` WHERE MembershipID='".$_SESSION['searched_memID']."'";
	$is_show_contribution_query_run=mysqli_query($connect,$show_contribution_query);
	$show_contribution_query_execute=mysqli_fetch_assoc($is_show_contribution_query_run);
	return $show_contribution_query_execute['Contributions'];
}
function update_query(){
	require 'connect.php';
	$update_contribution_query="UPDATE `members_contributions` SET `Contributions` = '".show_query()." ".$_POST['add'].".' WHERE `members_contributions`.`MembershipID` = '".$_SESSION['searched_memID']."'" ;
	$is_update_contribution_query_run=mysqli_query($connect,$update_contribution_query);
}
?>

</body>
</html>