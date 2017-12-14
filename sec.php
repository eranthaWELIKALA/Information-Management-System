<!DOCTYPE html>
<?php
session_start();
$_SESSION['searched_memID']='';

//importing pages
require 'connect.php';require 'function.php';

//access controlling
if(!isset($_SESSION["memID"]) || !isset($_SESSION["password"])){
		header ("location:login.php");
}
if($_SESSION["memID"]!="sec000"){
	header ("location:login.php");
}

if(isset($_POST['search']) && isset($_POST['search_memID'])){
	if(!seach_query()){
		dislplay_alerts("danger","sec.php","There is no account from this membershipID");
	}
}
?>

<html>


<head><title>Hello, Secretary!</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- importing boostrap -->
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

<div class="container-fluid" id="one"><h2></h2>
	<div class="col-md-10"></div>
	<ul class="nav nav-pills">
		<li class="active"><a href="#">Secretary</a></li>
		<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-tasks"></span> Options<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="change_password.php"><span class="glyphicon glyphicon-pushpin"></span> Change Password</a></li>
				<li><a href="login.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
			</ul>
	</li></ul>
</div><h2></h2>


<div class='container'>
<div class='row'>
<div class='col-md-9'>
<div class='container'><br>
	<div class="row">
		<form action="sec.php" method="post">
		<div class='col-md-4'>
		<input class='form-control' type='text' name='search_name'>
		</div>
		<div class="col-md-2">
			<input class="form-control" type="submit" name="searchN" value="Search by Name">
		</div>
	</form>
	</div>
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
		<button type="button" class='form-control' name='advanced_search' onclick="location.href='advanced_search.php'">Advanced Search</button>
		</div>
		</form>
	</div>
	<h2></h2>
	<div class='row'>
	<?php if(isset($_POST['search']) && isset($_POST['search_memID'])){echo "<h1>".seach_query()[0]."</h1><h1>".seach_query()[1]."</h1><h1>".seach_query()[2]."</h1>" ;}?>
	</div>
</div>
</div>
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
			echo "<td> <a href='advanced_direct.php?direct_searched_memID=".$seach_by_name_query_execute['MembershipID']."' >More</a></td>";
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
			echo "<td> <a href='advanced_direct.php?direct_searched_memID=".$seach_by_lname_query_execute['MembershipID']."' >More</a></td>";
			$itr1++;
			echo "</tr>";
		}
	}
	echo "</table></div>";

}

?>

</body>
</html>
