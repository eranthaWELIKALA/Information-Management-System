<!DOCTYPE html>
<?php
session_start();require 'connect.php';
/*if(!isset($_SESSION["memID"]) || !isset($_SESSION["password"])){
	header ("location:login.php");
}*/

if(isset($_POST['search'])){
	$search_query="SELECT * FROM `member_details` WHERE MembershipID='".$_POST['search_memID']."'";
	if($is_search_query_run=mysqli_query($connect,$search_query)){
		if(!empty($search_query_execute=mysqli_fetch_assoc($is_search_query_run))){
			echo $searched_memID=$search_query_execute['MembershipID'];
			$_SESSION['searched_memID']=$searched_memID;
			echo $search_query_execute['Firstname']."<br>";
			echo $search_query_execute['Lastname'];
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


?>

<html>
<head><title>Hello, Registrar!</title>
<link href="bootstrap.min.css" rel="stylesheet">
<script src="bootstrap.min.js"></script>
<style>
body{
	width:100%;
	height:100%;
	background-image:url('background.jpg');
	background-size:cover;
}
</style>
</head>
<div class="container"><h2></h2>
	<ul class="nav nav-pills">
		<li class="active"><a href="#"><?php echo "Registrar";?></a></li>
		<li><a href="login.php">Logout</a></li>
	</ul>
</div>
<div class="container">
  <h2>Notifications</h2>
  <div class="row">
	  <div class="col-md-4"><a href="requests.php">unseen requests</a></div>
	  <div class="col-md-1">
		  <span class="badge">
		  <?php
		  $requests1_query="SELECT COUNT(*) FROM signup_requests WHERE Accepted=false";
			if($is_requests1_query_run=mysqli_query($connect,$requests1_query)){
				while($requests1_query_execute=mysqli_fetch_assoc($is_requests1_query_run)){
					echo $requests1_query_execute['COUNT(*)'];
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
			?>
		  </span>
	  </div>
  </div>
  <div class="row">
	<div class="col-md-4"><a href="requests.php">pending requests</a></div>
	<div class="col-md-1">
		  <span class="badge">
			  <?php
				require 'connect.php';
				//$requests = mysqli_real_escape_string($connect, $_POST['memID']);
				$requests2_query="SELECT COUNT(*) FROM signup_requests";
				if($is_requests2_query_run=mysqli_query($connect,$requests2_query)){
						while($requests2_query_execute=mysqli_fetch_assoc($is_requests2_query_run)){
							echo $requests2_query_execute['COUNT(*)'];
						}
					}
					else{ echo '<div class="container">
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
				?>
		  </span>
	</div>
  </div>
</div>
<div class='container'>
	<div class='row'>
		<form action='reg.php' method='post'>
		<div class='col-md-4'>
		<input class='form-control' type='text' name='search_memID' value="<?php
		if(isset($_POST['search'])){echo $_SESSION['searched_memID'];}else if(isset($_POST['add_con'])){echo $_SESSION['searched_memID'];}else{echo '';}?>">
		</div>
		<div class='col-md-2'>
		<input class='form-control' type='submit' name='search' value='Search by ID'>
		</div>
		</form>
	</div>
	<h2></h2>
</div>
<div class='container'>
	<div class='row'>
		<form action='reg.php' method='post'>
		<div class='col-md-4'>
		<input class='form-control' type='textbox
		' name='add'>
		</div>
		<div class='col-md-2'>
		<input class='form-control' type='submit' name='add_con' value='Add new a contribution'>
		</div>
		</form>
	</div>
</div>
<?php
if(isset($_SESSION['searched_memID'])){
	$show_contribution_query="SELECT * FROM `members_contributions` WHERE MembershipID='".$_SESSION['searched_memID']."'";
	$is_show_contribution_query_run=mysqli_query($connect,$show_contribution_query);
	$show_contribution_query_execute=mysqli_fetch_assoc($is_show_contribution_query_run);
	echo $show_contribution_query_execute['Contributions'];
	if(isset($_POST['add_con'])){
		$update_contribution_query="UPDATE `members_contributions` SET `Contributions` = '".$show_contribution_query_execute['Contributions']." ".$_POST['add']."."."' WHERE `members_contributions`.`MembershipID` = '".$_SESSION['searched_memID']."'" ;
		if(isset($_POST['add'])){$is_update_contribution_query_run=mysqli_query($connect,$update_contribution_query);}
		echo $show_contribution_query_execute['Contributions'];
		/*
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
		}*/
	}
	echo $show_contribution_query_execute['Contributions'];
}
?>



</html>