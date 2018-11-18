<!DOCTYPE html>
<?php
//importing pages
	require 'connect.php';require 'function.php';
	
session_start();
if(isset($_SESSION['status'])){
	if($_SESSION['status']=true){
		display_alerts("success","index.php","<p align='center'>Your request was sent successfully. <br>Temporary Login will be available, if request is approved</p>");
	}
}

session_destroy(); ?>
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

	<!--<link rel="stylesheet" href="bootstrap.min.css">
	<script src="jquery.min.js"></script>
	<script src="bootstrap.min.js"></script>-->
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
			padding: 15px;
		}

		a:link{color:#FFFF}
		.carousel .item{
			height: 400px;
		}
		@media screen and (max-width: 992px) {
            .carousel .item{
    			height:150px;
    		}
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
					<div class="col-md-4" align="right"><h4><font color="#FFFFFF">Admissioon No. : </font></h4></div>
					<div class="col-md-4"><input class="form-control" type="text" name="admission" placeholder="ex: 123" required oninvalid="this.setCustomValidity('Please Enter an Admission no.')" oninput="setCustomValidity('')"></div>
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
			<div class="row">
				<div class="col-md-4" align="right"></div>
				<div div class="col-md-4" align="center"><a href="help.php"><font color="#ffff00">Click here for help</font></a></div>
			</div>
	</div>

<br>
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

			<!-- Wrapper for slides -->

			<?php
				$home_pics_query="SELECT * FROM home";
				$is_home_pics_query=mysqli_query($connect,$home_pics_query);
				$itr=1;
				echo "<div class='carousel-inner'>";
				while($home_pics_query_execute=mysqli_fetch_assoc($is_home_pics_query)){
					$pic=$home_pics_query_execute['Pic'];
					if($itr==1){
						echo "<div class='item active'>
					<img src='".$pic."' width='100%'>
					</div>";
					}
					else{
					echo "<div class='item'>
					<img src='".$pic."' width='100%'>
					<div class='carousel-caption'>
                						    ".home_pics_query_execute['Description']."
                						</div>
					</div>";
					}$itr++;
				}
				echo "</div>";
			?>
				<a href="#imageCarousel" class="carousel-control left" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
				<a href="#imageCarousel" class="carousel-control right" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
		  </div>
		</div>
	</div>
</div>

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
