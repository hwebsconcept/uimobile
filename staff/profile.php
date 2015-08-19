<?php require_once('../connections/connect.php');  ?>
<?php
session_start();
if (!isset($_SESSION['staffId']))
{
	header("Location:index.php");
}
$x= $dbh->prepare("SELECT * FROM staff WHERE id=1");
//$x->bindParam(':id', $_SESSION['staffId']);
$x->execute();
$b=$x->fetch(PDO::FETCH_ASSOC);

$dept= $dbh->prepare("SELECT * FROM department WHERE id=:id");
$dept->bindParam(':id', $b['deptID']);
$dept->execute();
$department=$dept->fetch(PDO::FETCH_ASSOC);


if(!empty ($_POST['old_pwd']))
{
    $pwd=$_POST['old_pwd'];
    $new_pwd=$_POST['new_pwd'];
    $r_new_pwd=$_POST['r_new_pwd'];
    $pass= $dbh->prepare("SELECT * FROM staff WHERE staffId=:staffId AND password=:password");
    $pass->bindParam(':staffId', $_SESSION['staffId']);
    $pass->bindParam(':password', $pwd);
    $pass->execute();
    if($pass->fetch(PDO::FETCH_NUM) > 0)
    {
        if($new_pwd == $r_new_pwd)
        {
            $sendpwd=$dbh->prepare("UPDATE staff SET password=:pwd WHERE staffId=:staffId");
            $sendpwd->bindParam(':pwd', $new_pwd);
            $sendpwd->bindParam(':staffId', $_SESSION['staffId']);
            $sendpwd->execute();
            if($sendpwd)
            {
                echo "<script>alert('Password Changed Successfully. Please Login Next Time With New Password')</script>";
            }
            else
            {
                echo "<script>alert('Sorry. There was an error. Please try again later.')</script>";
            }
        }
        else
        {
            echo "<script>alert('Ooops... Password did not match')</script>";
        }
    }
    else
    {
        echo "<script>alert('Oops... Your Current Password Was Wrong Try Again')</script>";
    }
}

?>

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard - MIA Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index2.php">UI MOBILE Admin</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
              <li><a href="profile.php"><i class="fa fa-dashboard"></i> Profile</a></li>
              <li><a href="view-notification.php"><i class="fa fa-user"></i> Notification</a></li>
              <li><a href="course-notification.php"><i class="fa fa-user"></i> Course Notification</a></li>
			  <li><a href="course-forum.php"><i class="fa fa-user"></i> Course Forum</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Admin <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">

		<div class="col-md-12">
			<h3>STAFF PROFILE</h3>

            <div class = "col-md-3">
                <img src="../admin/<?php echo $b['img'] ?>" class="img-responsive" style="max-height:195px;" />
            </div>
            <div class = "col-md-9" style="background: #efefef; border-radius:20px; padding:20px;">
                NAME: <b><?php echo ucfirst($b['name']) ?></b><br><br>
                SCHOOL: <b><?php echo ucfirst($b['school']) ?></b> <br><br>
                DEPARTMENT: <b><?php echo ucfirst($department['departmentName']) ?></b><br><br>
                <button class="btn btn-default"><i class="fa fa-user"></i> EDIT PROFILE</button>
                <button class="btn btn-warning"  data-toggle="modal" data-target="#myModal"><i class="fa fa-key"></i> CHANGE PASSWORD</button>
            </div>
        </div>
      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->


    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Change Password</h4>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" action="" name="change_pwd" id="change_pwd" role="form">
                        <h5 class="black-font">Old Password<span style="color: #F00;">*</span></h5>
                        <input type="password" required name="old_pwd" class="form-control">

                        <h5 class="black-font">New Password<span style="color: #F00;">*</span></h5>
                        <input type="password" required name="new_pwd" class="form-control">

                        <h5 class="black-font">Re-type New Password<span style="color: #F00;">*</span></h5>
                        <input type="password" required name="r_new_pwd" class="form-control"> <br>

                        <button type="submit" name="submit" id="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Save Changes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

    <!-- Page Specific Plugins -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script src="js/morris/chart-data-morris.js"></script>
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>

  </body>
</html>
