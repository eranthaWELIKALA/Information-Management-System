<html>
<head><title>
<?php
session_start();

if(isset($_POST["save"])){
	echo "Hello ".$_POST["firstname"];
}
else echo "Hello ".$_SESSION['memID'];
?>
</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"></head>

<?php
$memID=$_SESSION['memID'];
$member_type=$_SESSION['memID'];
?>

<form action="user.php" method="post">
<h2><p align="center">Contact Details</p></h2>
<p align="center"><table>
<tr><td>First Name </td>
<td><input class="form-control" type="text" name="firstname" value=<?php if(isset($_POST["save"])){echo $_POST["firstname"];} ?>></td></tr>
<tr><td>Last Name </td>
<td><input class="form-control" type="text" name="lastname" value=<?php if(isset($_POST["save"])){echo $_POST["lastname"];} ?>></td></tr>
<tr><td>Address1 </td>
<td><input class="form-control" type="text" name="address1" value=<?php if(isset($_POST["save"])){echo $_POST["address1"];} ?>></td></tr>
<tr><td>Address2 </td>
<td><input class="form-control" type="text" name="address2" value=<?php if(isset($_POST["save"])){echo $_POST["address2"];} ?>></td></tr>
<tr><td>Mobile No. </td>
<td><input class="form-control" type="text" name="mobile" value=<?php if(isset($_POST["save"])){echo $_POST["mobile"];} ?>></td></tr>
<tr><td>Fixed Tel No. </td>
<td><input class="form-control" type="text" name="fixed" value=<?php if(isset($_POST["save"])){echo $_POST["fixed"];} ?>></td></tr>
<tr><td>e-mail </td>
<td><input class="form-control" type="text" name="email" value=<?php if(isset($_POST["save"])){echo $_POST["email"];} ?>></td></tr>
<tr><td></td><td><input class="form-control" type="submit" name="save" value="SAVE"></td></tr>
</table>
</p>
</form>
</html>                 