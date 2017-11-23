<html><head><title>Home</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
<form action="signup.php" method="post"><p align="center">
<div class="row"><div class="col-md-6" align="right">Membership Id : </div><div><input class="form-control" type="text" name="memID" placeholder="ex: 123" required oninvalid="this.setCustomValidity('Please Enter Membership ID')" oninput="setCustomValidity('')"></div></div>
<div class="row"><div class="col-md-6" align="right">Password: </div><div>
<input class="form-control" type="password" name="password" placeholder="ex: ****" required oninvalid="this.setCustomValidity('Please Enter Password')" oninput="setCustomValidity('')"></div>
<div><input class="form-control" type="submit" value="SIGNUP"></div></div></p>
</form>
<div class="row"><div class="col-md-6" align="right"></div><div align="center"><a href="login.php">Already Have an Account?</a></div></div>
</div>
</body></html>