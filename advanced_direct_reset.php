<?php

session_start();

//access controlling
if(!isset($_SESSION["memID"]) || !isset($_SESSION["password"])){
		header ("location:login.php");
}
if($_SESSION["memID"]!="admin000"){
  header ("location:login.php");
}

$_SESSION['searched_memID']=$_GET['direct_searched_memID'];
header('location:reset_password.php');
?>
