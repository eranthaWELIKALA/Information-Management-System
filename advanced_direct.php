<?php

session_start();

//access controlling and directing controlling
if(!isset($_SESSION["memID"]) || !isset($_SESSION["password"])){
  header ("location:login.php");
}
if($_SESSION["memID"]=="sec000" || $_SESSION["memID"]=="reg000"){
  $_SESSION['searched_memID']=$_GET['direct_searched_memID'];
  header('location:advanced_search.php');
}
else{
  header ("location:login.php");
}

?>
