<?php
session_start();
$_SESSION['searched_memID']='';

//importing pages
require 'connect.php';require 'function.php';

//access controlling
if(!isset($_SESSION["memID"]) || !isset($_SESSION["password"])){
		header ("location:login.php");
}
if($_SESSION['memID']!="sec000"){
	header ("location:login.php");
}

if(isset($_POST['search']) && isset($_POST['search_memID'])){
	if(!seach_query()){
		display_alerts("danger","sec.php","There is no account from this membershipID");
	}
}
?>
<html>
<head><title>Hello, Secretary</title>
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
</style>
	</head>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Secretary</a>
    </div>
    <div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
			<li><a href="sec.php"><span class="glyphicon glyphicon-chevron-left"></span> Back</a></li>
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
</nav><br><br><br>
<script>
    $(document).ready(function(){
        $("#myInput").on("keyup",function(){
            var value=$(this).val().toLowerCase();
            $("#myTable tr").filter(function(){
                $(this).toggle($(this).text().toLowerCase().indexOf(value)>-1)
            });
        });
    });
</script>
	<div id="search1" >
  <input class="form-control" type="text" id="myInput" placeholder="Search..." >
</div>
</html>	
<?php
require 'connect.php';
$itr1=0;
echo "<div class='container'><table class='table table-striped'><thead><tr><th>MembershipID</th><th>Firstname</th><th>Lastname</th></tr></thead><tbody id='myTable'>";
			$seach_by_name_query="SELECT * FROM `member_details`";
			if($is_seach_by_name_query_run=mysqli_query($connect,$seach_by_name_query)){
				while($seach_by_name_query_execute=mysqli_fetch_assoc($is_seach_by_name_query_run)){
					echo "<tr>";
					echo "<td>".$seach_by_name_query_execute['MembershipID']."</td>";
					echo "<td>".$seach_by_name_query_execute['Firstname']."</td>";
					echo "<td>".$seach_by_name_query_execute['Lastname']."</td>";
					if($seach_by_name_query_execute['Pic']!=NULL){
						echo "<td><img src = '".$seach_by_name_query_execute['Pic']."' style = 'height:50px;width:50px'></td>";}
					else{
						echo "<td><img src = 'pics/default.png' style = 'height:50px;width:50px'></td>";}
					echo "<td> <a href='advanced_direct.php?direct_searched_memID=".$seach_by_name_query_execute['MembershipID']."' >More</a></td>";
					$itr1++;
					echo "</tr>";
				}
			}
			echo "</tbody></table>";
?>