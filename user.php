<!DOCTYPE html>
<?php session_start(); session_destroy(); ?>
<html><head><title>Home</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
	<link rel="stylesheet" href="bootstrap.min.css">
	<script src="jquery.min.js"></script>
	<script src="bootstrap.min.js"></script>
	</head>
<body>
<div class="container">
	<form action="signup.php" method="post">
	<p align="center">
		<div class="row">
			<div class="col-md-4" align="right">Membership Id : </div>
			<div class="col-md-4"><input class="form-control" type="text" name="memID" placeholder="ex: 123" required oninvalid="this.setCustomValidity('Please Enter Membership ID')" oninput="setCustomValidity('')"></div>
		</div>
		<div class="row">
			<div class="col-md-4" align="right">Password: </div>
			<div class="col-md-4"><input class="form-control" type="password" name="password" placeholder="ex: ****" required oninvalid="this.setCustomValidity('Please Enter Password')" oninput="setCustomValidity('')"></div>
		</div>
		<div class="row">
			<div class="col-md-4" align="right"></div>
			<div class="col-md-4"><input class="form-control" type="submit" value="SIGNUP" name="signup" ></div>
		</div>
	</p>
	</form>
		<div class="row">
			<div class="col-md-4" align="right"></div>
			<div div class="col-md-4" align="center"><a href="login.php">Already Have an Account?</a></div>
		</div>
</div>
<?php
if(isset($_POST["signup_submit"])){
	echo '<div class="container">
						<div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-4">
								<div class="alert alert-info alert-dismissable">
								<a href="login.php" class="close" data-dismiss="alert" arial-label="close">&times</a>
								<strong>Your signup request is sent successfully!</strong></div><br>
							</div>
							<div class="col-md-4"></div>
						</div>
					</div>';
}
?>

<div class="container">
<div class="row"> 
<div class="col-md-4"></div>
<div class="col-md-4">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="1.jpg" style="width:100%;">
      </div>

      <div class="item">
        <img src="2.jpg" style="width:100%;">
      </div>
    
      <div class="item">
        <img src="3.jpg" style="width:100%;">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev" width="300" height="300">
      <span class=><<</span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span >>></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
</div>
</div>
</body>
</html>
