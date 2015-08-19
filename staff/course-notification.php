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
			<h3>COURSE NOTIFICATION</h3>

            <div class = "col-md-12" style="background: #efefef; border-radius:20px; padding:20px; margin-top:30px;" align="center">
                <h2>CHOOSE AN OPTION</h2>
                <button class="btn btn-default" data-toggle="modal" data-target="#myModal"><i class="fa fa-plane"></i> VIEW NOTIFICATION</button>
                <a href="add-coursenotification.php"><button class="btn btn-warning" ><i class="fa fa-plane"></i> SEND NOTIFICATION</button></a>
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
                    <h4 class="modal-title">Choose Course</h4>
                </div>
                <div class="modal-body">
                    <form method="get" enctype="multipart/form-data" action="view-coursenotification.php" name="change_pwd" id="change_pwd" role="form">
                        <select name="courseID" class="form-control" required>
                            <option selected="selected">Choose Course</option>
                            <?php
                            $a= $dbh->prepare("SELECT * FROM staff_courses WHERE staffId=:posted ORDER BY id DESC");
                            $a->bindParam(':posted', $_SESSION['staffId']);
                            $a->execute();
                            while($b=$a->fetch(PDO::FETCH_ASSOC))
                            {
                                $c= $dbh->prepare("SELECT * FROM courses WHERE id=:id");
                                $c->bindParam(':id', $b['courseID']);
                                $c->execute();
                                $d=$c->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <option value="<?php echo $d['id']; ?>"><?php echo $d['courseCode']; ?> <?php echo $d['courseName']; ?></option>
                            <?php
                            }
                            ?>
                        </select><br>
                        <button type="submit" name="submit" id="submit" class="btn btn-primary"><i class="fa fa-edit"></i> OK</button>
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
