<?php

//every php function is here

function refresh($attribute){
	if(isset($_POST["update"])){
		echo $query_execute[$attribute];
	}
}

function seach_query(){
	require 'connect.php';
	$search_query="SELECT * FROM `member_details` WHERE MembershipID='".$_POST['search_memID']."'";
	if($is_search_query_run=mysqli_query($connect,$search_query)){
		if(!empty($search_query_execute=mysqli_fetch_assoc($is_search_query_run))){
			$_SESSION['searched_memID']=$search_query_execute['MembershipID'];
			$returning_array[0]=$search_query_execute['MembershipID'];
			$returning_array[1]=$search_query_execute['Firstname'];
			$returning_array[2]=$search_query_execute['Lastname'];
			return $returning_array;
		}
			else{
				return false;
		}
	}
}

function show_query(){
	require 'connect.php';
	$show_contribution_query="SELECT * FROM `members_contributions` WHERE MembershipID='".$_SESSION['searched_memID']."'";
	$is_show_contribution_query_run=mysqli_query($connect,$show_contribution_query);
	$show_contribution_query_execute=mysqli_fetch_assoc($is_show_contribution_query_run);
	return $show_contribution_query_execute['Contributions'];
}

function notification($requests_query){
	require 'connect.php';
	if($is_requests_query_run=mysqli_query($connect,$requests_query)){
		while($requests_query_execute=mysqli_fetch_assoc($is_requests_query_run)){
			echo $requests_query_execute['COUNT(*)'];
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
}

function update_query(){
	require 'connect.php';
	$update_contribution_query="UPDATE `members_contributions` SET `Contributions` = '".show_query()." ".$_POST['add'].".' WHERE `members_contributions`.`MembershipID` = '".$_SESSION['searched_memID']."'" ;
	$is_update_contribution_query_run=mysqli_query($connect,$update_contribution_query);
}

function count_queries($attribute){
	require 'connect.php';
	if($is_count_query_run=mysqli_query($connect,$attribute)){
		while($count_query_execute=mysqli_fetch_assoc($is_count_query_run)){
			return $count_query_execute['COUNT(*)'];
		}
	}
}

function check_queries($attribute){
	require 'connect.php';
	if($is_check_query_run=mysqli_query($connect,$attribute)){
		if(mysqli_num_rows($is_check_query_run) == 1){
			return false;
		}
		else {return true;}
	}
}

function dislplay_alerts($type,$link,$message){
	echo '<div class="container">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="alert alert-'.$type.'" alert-dismissable">
					<a href="'.$link.'" class="close" data-dismiss="alert" arial-label="close">&times</a>
					<strong>'.$message.'</strong>
					</div><br>
				</div>
				<div class="col-md-3"></div>
			</div>
		</div>';
}
 ?>
