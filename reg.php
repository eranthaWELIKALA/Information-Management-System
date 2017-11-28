<?php
session_start();
if(!isset($_SESSION["memID"]) || !isset($_SESSION["password"])){
	header ("location:login.php");
}
?>

<html>
<head><title>Hello, Registrar!</title>
<link href="bootstrap.min.css" rel="stylesheet">
<script src="bootstrap.min.js"></script></head>
	<ul class="nav nav-pills">
		<li class="active"><a href="#"><?php echo "Registrar";?></a></li>
		<li><a href="login.php">Logout</a></li>
	</ul>
	
<div class="container">
  <h2>Notifications</h2>
  <div class="row">
	  <div class="col-md-4"><a href="requests.php">unseen requests</a></div>
	  <div class="col-md-1">
		  <span class="badge">
		  <?php
		  require 'connect.php';
		  $requests_query="SELECT COUNT(*) FROM signup_requests WHERE Accepted=false";
			if($is_requests_query_run=mysqli_query($connect,$requests_query)){
				while($query_execute=mysqli_fetch_assoc($is_requests_query_run)){
					echo $query_execute['COUNT(*)'];
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
				$requests_query="SELECT COUNT(*) FROM signup_requests";
				if($is_requests_query_run=mysqli_query($connect,$requests_query)){
						while($query_execute=mysqli_fetch_assoc($is_requests_query_run)){
							echo $query_execute['COUNT(*)'];
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




</html>