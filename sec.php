<!DOCTYPE html><!DOCTYPE html>
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


<head><title>Hello, Secretary!</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
body{
	width:100%;
	height:100%;
	background-image:url('background1.jpg');
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
<div class="container" id="one"><h2></h2>
	<div class="col-md-10"></div><div class="col-md-2">
	<ul class="nav nav-pills">
		<li class="active"><a href="#"><?php echo "Secretary";?></a></li>
		<li><a href="login.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
	</ul><h2></h2></div>
</div>
<div class='container'>
<div class='row'><div class='col-md-9'>

<div class='container'>
	<div class='row'>
	<h2></h2>
		<form action='sec.php' method='post'>
		<div class='col-md-4'>
		<input class='form-control' type='text' name='search_memID' value="<?php
		if(isset($_SESSION['searched_memID'])){echo $_SESSION['searched_memID'];}?>">
		</div>
		<div class='col-md-2'>
		<input class='form-control' type='submit' name='search' value='Search by ID'>
		</div>
		<div class='col-md-2'>
		<input class='form-control' type='button' name='advanced_search' onclick="location.href='advanced_search.php'" value='Advanced Search'>
		</div>
		</form>
	</div>
	<h2></h2>
</div>
</div>
</div></div>

<?php

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
							<a href="sec.php" class="close" data-dismiss="alert" arial-label="close">&times</a>
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

if(isset($_SESSION['searched_memID'])){
	if(isset($_POST['add_con'])){
		if(isset($_POST['add'])){
			update_query();
		}
		
		else{ 
			echo '<div class="container">
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<div class="alert alert-warning alert-dismissable">
							<a href="sec.php" class="close" data-dismiss="alert" arial-label="close">&times</a>
							<strong>There is no new contribution</strong>
							</div><br>
						</div>
						<div class="col-md-4"></div>
					</div>
				</div>';
		}
	}
	 echo "<div class='container'><div class='row'><div class='col-md-9'><textarea class='form-control' rows='6' cols='25' readonly>". show_query()."</textarea></div></div></div>";
}
?>

</body>
</html>