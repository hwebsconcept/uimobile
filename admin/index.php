
<?php
session_start();
$msg="";
if ( isset ($_POST['login']))
{
	$username = $_POST['username'];
	$pwd=$_POST['password'];
	if(($username=='admin')&&($pwd=='pass101'))
	{
		header("Location:view-users.php");
		$_SESSION['id']=$username;
	}
	else
	{
		$msg= "Username and password did not match";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard - UI Mobile Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
  </head>
<body>


  
  <div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4" style="padding-top:80px;">
			<div class="panel panel-default">
				<div class="panel-heading">
				<Span style="font-size:24px;">LOGIN</span>
				</div>
				<div class="panel-body">
				<form id="form2" name="form2" method="post" action="">
				<div class="catch_word">ADMINISTRATOR LOGIN</div>
				<div style="color:#F00;"><b><?php echo $msg ?></b></div>
				<div style="margin-bottom:30px;">
				<input name="username" type="text" required id="username" placeholder="Username" size="40"/>
				</div>
				<div style="margin-bottom:30px;">
				<input name="password" type="password" required id="password" placeholder="Password" size="40"/>
				</div>
				<input type="submit" name="login" id="login" value="Login" class="button"/>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>


</body>
</html>
