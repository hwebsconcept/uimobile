<?php
include ('../connections/connect.php');
session_start();
if (isset ($_POST['login']))
{
	$staff_id=$_POST['staffId'];
	$password=$_POST['password'];
	
	
	$pass= $dbh->prepare("SELECT * FROM staff WHERE staffId=:staff_id AND password=:password");
	$pass->bindParam(':staff_id', $staff_id);
	$pass->bindParam(':password', $password);
	$pass->execute();
	if($pass->fetch(PDO::FETCH_NUM) > 0)
	{	
		$_SESSION['staffId']=$staff_id;
		header("Location: view-notification.php");
	}
	else
	{
		echo "Matric Number and password didn't match "; 
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>Nuconn</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="icon" type="image/png" href="img/fav.jpg"/>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
</head>

<body id="background">

<div id="divLoading">
</div>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4" style="margin-top:150px; margin-bottom:20px;">
		<img src="img/logo.fw.png" style="width:180px;" class="img-responsive center-block" />
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default ">
				<div class="panel-heading">
				<h3> STAFF LOGIN</h3>
				</div>
				<div class="panel-body">
					<form enctype="multipart/form-data" name="login" id="loginForm" method="post" action="" role="form">
					<input type="text" name="staffId" id="staffId" placeholder="Staff Id" class="form-control">
					<br>
					<input type="password" name="password" id="password" placeholder="Password" class="form-control">
					<br>
					<!--<input type="submit" name="submit" id="submit" class="btn btn-success submit" value="LOGIN">-->
                    <button type="submit" class="btn btn-success" name="login" id="login">Login</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
</body>

</html>