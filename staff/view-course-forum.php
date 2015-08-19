<?php require_once('../connections/connect.php');  ?>
<?php
session_start();
if (!isset($_SESSION['staffId']))
{
	header("Location:index.php");
}

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

          <div class="container">
              <div class="row" style="padding-bottom: 60px;">
                  <div class="col-md-11">
                      <form method="post" action="" role="form" enctype="multipart/form-data" id="pcom" name="pcom">
                          <textarea type="text" name="comment" id="comment" class="form-control" ></textarea>
                          <button type="submit" name="pcomment" id="submit" hidden="hidden" class="btn btn-default"><i class="fa fa-comment"></i> Comment</button>
                      </form>
                  </div>


                  <?php include ('course-forum-fetch.php'); ?>
              </div>
          </div>

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->


        <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>







  </body>
</html>
