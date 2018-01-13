<!DOCTYPE html>
<?php
session_start();require 'connect.php';require 'function.php';


//access controlling
if(!isset($_SESSION["memID"]) || !isset($_SESSION["password"])){
	header ("location:login.php");
}
if($_SESSION["memID"]!="admin000") {
	header ("location:login.php");
}


if(isset($_POST['search'])){
	seach_query();
}

?>

<html>


<head><title>Hello, Admin!</title>

	<!-- importing bootstrap -->
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
	
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Admin</a>
    </div>
    <div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
			<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-tasks"></span> Options<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="change_password.php"><span class="glyphicon glyphicon-pushpin"></span> Change Password</a></li>
				<li><a href="login.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
			</ul>
			</li>
        </ul>
      </div>
    </div>
  </div>
</nav>	
<br>
<br>
<br>

<div class='container'>
	<div class="row">
		<form action="admin.php" method="post">
		<div class='col-md-4'>
		<input class='form-control' type='text' name='search_name' value="<?php
		if(isset($_SESSION['searched_name'])){echo $_SESSION['searched_name'];}?>">
		</div>
		<div class="col-md-2">
			<input class="form-control" type="submit" name="searchN" value="Search by Name">
		</div>
	</form>
	</div>
	<div class='row'>
	<h2></h2>
		<form action='admin.php' method='post'>
		<div class='col-md-4'>
		<input class='form-control' type='text' name='search_memID' value="<?php
		if(isset($_SESSION['searched_memID'])){echo $_SESSION['searched_memID'];}?>">
		</div>
		<div class='col-md-2'>
		<input class='form-control' type='submit' name='search' value='Search by ID'>
		</div>
		<div class='col-md-2'>
		<input class='form-control' type='button' name='reset_password' onclick="location.href='reset_password.php'" value='Reset Password'>
		</div>
		</form>
	</div>
	<h2></h2>
	<div class='row'>
	<?php if(isset($_POST['search'])){echo "<h1>".seach_query()[0]."</h1><h1>".seach_query()[1]."</h1><h1>".seach_query()[2]."</h1>" ;}?>
	</div>
</div>
<?php
$itr1=0;
if(isset($_POST['searchN'])){
	$_SESSION['searched_memID']='';
	echo "<div class='container'><table class='table table-striped'><thead><tr><th>MembershipID</th><th>Firstname</th><th>Lastname</th><th></th><th></th></tr></thead><tbody>";
	$seach_by_name_query="SELECT * FROM `member_details` WHERE Firstname='".$_POST['search_name']."'";
	if($is_seach_by_name_query_run=mysqli_query($connect,$seach_by_name_query)){
		while($seach_by_name_query_execute=mysqli_fetch_assoc($is_seach_by_name_query_run)){
			echo "<tr>";
			echo "<td>".$seach_by_name_query_execute['MembershipID']."</td>";
			echo "<td>".$seach_by_name_query_execute['Firstname']."</td>";
			echo "<td>".$seach_by_name_query_execute['Lastname']."</td>";
			if($seach_by_name_query_execute['Pic']!=NULL){
				echo "<td><img src = '".$seach_by_name_query_execute['Pic']."' style = 'height:150px;width:150px'></td>";}
			else{
				echo "<td><img src = 'pics/default.png' style = 'height:150px;width:150px'></td>";}
			echo "<td> <a href='advanced_direct_reset.php?direct_searched_memID=".$seach_by_name_query_execute['MembershipID']."' >Reset</a></td>";
			$itr1++;
			echo "</tr>";
		}
	}
	$seach_by_lname_query="SELECT * FROM `member_details` WHERE Lastname='".$_POST['search_name']."'";
	if($is_seach_by_lname_query_run=mysqli_query($connect,$seach_by_lname_query)){
		while($seach_by_lname_query_execute=mysqli_fetch_assoc($is_seach_by_lname_query_run)){
			echo "<tr>";
			echo "<td>".$seach_by_lname_query_execute['MembershipID']."</td>";
			echo "<td>".$seach_by_lname_query_execute['Firstname']."</td>";
			echo "<td>".$seach_by_lname_query_execute['Lastname']."</td>";
			if($seach_by_lname_query_execute['Pic']!=NULL){
				echo "<td><img src = '".$seach_by_lname_query_execute['Pic']."' style = 'height:150px;width:150px'></td>";}
			else{
				echo "<td><img src = 'pics/default.png' style = 'height:150px;width:150px'></td>";}
			echo "<td> <a href='advanced_direct_reset.php?direct_searched_memID=".$seach_by_lname_query_execute['MembershipID']."' >Reset</a></td>";
			$itr1++;
			echo "</tr>";
		}
	}
	echo "</table></div>";

}

?>
</body>
</html>
