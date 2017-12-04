<?php
	session_start();
	if(!isset($_SESSION['searched_memID'])){header ("location:sec.php");}
	require 'connect.php';

	$details_query="SELECT * FROM member_details  WHERE MembershipID='".$_SESSION['searched_memID']."'";

	if($is_details_query_run=mysqli_query($connect,$details_query)){
		$query_execute=mysqli_fetch_assoc($is_details_query_run);
	}
?><!DOCTYPE html>
<html>
<head>
  <title><?php echo $_SESSION['searched_memID']; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  body {
      position: relative; 
  }
  #details1 {padding-top:50px;height:675px;color: #000; background-color: #1E88E5;}
  #details2 {padding-top:50px;height:675px;color: #000; background-color: #673ab7;}
  #details3 {padding-top:50px;height:675px;color: #000; background-color: #ff9800;}
  </style>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#"><?php echo "<b>".$_SESSION['searched_memID']."</b>"; ?></a>
    </div>
    <div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="#details1">Contact Details</a></li>
          <li><a href="#details2">Personal Details</a></li>
          <li><a href="#details3">Other</a></li>
		  <li><a href="sec.php"><span class="glyphicon glyphicon-chevron-left"></span> Back</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>    

<div id="details1" class="container-fluid"><br><br>
  <h1>Contact Details</h1><br><br>
  <div class='container'><table class='table table-striped'><tbody>
  <tr><td>Firstname</td><td><?php echo $query_execute['Firstname']; ?></td></tr>
  <tr><td>Lastname</td><td><?php echo $query_execute['Lastname']; ?></td></tr>
  <tr><td>Address1</td><td><?php echo $query_execute['Address1']; ?></td></tr>
  <tr><td>Address2</td><td><?php echo $query_execute['Address2']; ?></td></tr>
  <tr><td>Mobile No.</td><td><?php echo $query_execute['Mobile']; ?></td></tr>
  <tr><td>Fixed Tel No.</td><td><?php echo $query_execute['Fixed']; ?></td></tr>
  <tr><td>email</td><td><?php echo $query_execute['Email']; ?></td></tr>
  </tbody></table></div>
</div>
<div id="details2" class="container-fluid"><br><br>
  <h1>Personal Details</h1><br><br>
  <div class='container'><table class='table table-striped'><tbody>
  <tr><td>Birthday</td><td><?php echo $query_execute['Birthday']; ?></td></tr>
  <tr><td>National ID no.</td><td><?php echo $query_execute['NIC']; ?></td></tr>
  <tr><td>Occupation</td><td><?php echo $query_execute['Occupation']; ?></td></tr>
  <tr><td>Civil Status</td><td><?php echo $query_execute['Civil_status']; ?></td></tr>
  </tbody></table></div>
</div>
<div id="details3" class="container-fluid"><br><br>
  <h1>Other</h1><br><br>
  <div class='container'><table class='table table-striped'><tbody>
  <tr><td>Admission no.</td><td><?php echo $query_execute['Admission']; ?></td><td></td></tr>
  <tr><td>Period of Study</td><td>from: <?php echo $query_execute['Begin']; ?></td><td>to: <?php echo $query_execute['End']; ?></td></tr>
  </tbody></table></div>
</div>

</body>
</html>