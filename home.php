<!DOCTYPE html>
<?php session_start(); session_destroy(); ?>
<html>
<head>
	<title>Home</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<!-- Latest compiled and minified CSS -->
			<!--Font Awesome CSS-->
			<link rel="stylesheet" href="css/font-awesome.min.css">
	
	<link rel="stylesheet" href="bootstrap.min.css">
	<script src="jquery.min.js"></script>
	<script src="bootstrap.min.js"></script>
	<style>
		body{
			width:100%;
			height:100%;
			background-image:url('background-2.jpg');
			background-size:cover;
		}
		
		#one{
			background-image:url('background-1.jpg');
			background-repeat:no-repeat;
			background-size: 720px 400px;
			background-position: center;
			padding: 35px;
		}
		
		a:link{color:#FFFF}
		
		.carousel .item{
			height: 200px;
		}
	</style>
</head>

<body>

<div style="color:#0000" link="white">
	
	<!--logo of the school-->
	<div class="container" align="center">
		<div class="row">
			<div class="col-sm-4" align="right"><img src="Logo.png" style="width:30%"></div>
			<div class="col-sm-4">
				<h2 style = "color: black"><strong>Old Boys' Association<br> St. Anthony's College<br>Kandy</strong></h2>
			</div>
			<div class="col-sm-4"></div>
		</div>
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4"></div>
			<div class="col-sm-4"></div>
		</div>
		<div class="row">
			<ul class="list-inline">
				<li style="list-style:none">
					<a href="https://goo.gl/maps/9rgRRv8z7N92" style="color: blue">	
							<i class="fa fa-map-marker"></i>								
						St. Anthony's College, Kandy.
					</a>
				</li>
				<li style="list-style:none color: black">
					<div style="color: black">
						<i class="fa fa-phone"></i>
						+94 812213652
					</div>
				</li>
				<li style="list-style:none color: black">
					<div style="color: black">
						<i class="fa fa-envelope-o"></i>
						sacollegekdy@sltnet.lk
					</div>
				</li>
			</ul>
		</div>
	</div>
	<hr>
	<!--signup form area-->
	<div class="container" id="one">
		<form action="signup.php" method="post">
			<p align="center">
				<div class="row">
					<div class="col-md-4" align="right"><h4><font color="#FFFFFF">Membership Id : </font></h4></div>
					<div class="col-md-4"><input class="form-control" type="text" name="memID" placeholder="ex: 123" required oninvalid="this.setCustomValidity('Please Enter Membership ID')" oninput="setCustomValidity('')"></div>
				</div>
				<div class="row">
					<div class="col-md-4" align="right"><h4><font color="#FFFFFF">Password: </font></h4></div>
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
				<div div class="col-md-4" align="center"><a href="login.php"><font color="#ffff00"><h4>Already Have an Account?</h4></font></a></div>
			</div>
	</div>

<h6></h6>
<!--slide show area-->
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
			<div class="carousel-inner" style="max-height: 100%, max-width:50%">
			  <div class="item active">
				<img src="College_Front.jpg" style="height:100%">
			  </div>

			  <div class="item">
				<img src="College_Bus.jpg" style="height:100%">
			  </div>
			
			  <div class="item">
				<img src="Centenary_Hall.jpg" style="height:100%, width:100%">
			  </div>
			</div>

			<!-- Left and right controls -->
			<a class="left carousel-control" href="#myCarousel" data-slide="prev" width="300" height="300">
			   <span class="glyphicon glyphicon-chevron-left"></span>
			  <span class="sr-only">Previous</span>
			</a>
			
			<a class="right carousel-control" href="#myCarousel" data-slide="next">
			   <span class="glyphicon glyphicon-chevron-right"></span>
			  <span class="sr-only">Next</span>
			</a>
			
		  </div>
		</div>
	</div>
</div>

</div>
</body>
</html>


