<?php 
require_once('connections/connect.php'); 
session_start();
if (!isset ($_SESSION['id']))
{
	$goto= "index.php";
	header("Location:".$goto);
}
$msg="";
if(isset($_POST['create']))
{
	$mat = $_POST['matric'];
	$level = $_POST['level'];
	$ccode = $_POST['ccode'];
	$ctitle = $_POST['ctitle'];
	$semester = $_POST['semester'];
	$check = mysql_query ("SELECT * FROM course WHERE matric ='$mat' AND courseCode='$ccode'");
	if (mysql_num_rows($check) > 0 )
	{
		$msg= "Courses Already exist";
	}
	else
	{
		$query=mysql_query("INSERT INTO course (matric, level, courseCode, courseTitle, semester) 
		VALUES ('$mat','$level','$ccode','$ctitle','$semester')");
		if ($query)
		{
			$msg= "File Send Successfully";
		}
		else
		{
			$msg= "File was not sent. Please try agian.".mysql_error();
		}
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

        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li><a href="index2.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><a href="view-users.php"><i class="fa fa-user"></i> Students</a></li>
			<li><a href="view-courses.php"><i class="fa fa-user"></i> Courses</a></li>
			<li><a href="view-institute.php"><i class="fa fa-user"></i> Institute</a></li>
			<li><a href="view-notification.php"><i class="fa fa-user"></i> Notification</a></li>
			<li><a href="view-coursenotification.php"><i class="fa fa-user"></i> Course Notification</a></li>
			<!--<li  class="active dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Project <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="view-project.php">View All Project</a></li>
              </ul>
            </li><li  class=" dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Pages <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="edit-home.php">Home</a></li>
				<li><a href="edit-about.php">About Us</a></li>
				<li><a href="edit-team.php">Our Team</a></li>
              </ul>
            </li>
            <li><a href="blog.php"><i class="fa fa-bar-chart-o"></i> Blog</a></li>-->
            
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
		<div class="col-md-12" >
			<a href="view-courses.php"><button class="btn btn-default">GO BACK</button></a>
			<a href="add-courses.php"><button class="btn btn-primary">ADD NEW</button></a>
			</div>
			<div class="col-md-12">
			<h3>ADD NEW PROFILE</h3>
			<span style="color:red;"><b><?php echo $msg ?></span>
			</div>
		
		<form action="" method="post" enctype="multipart/form-data" name="form2" id="form2">
			<div class="col-md-12">
				<input name="matric" type="text" required placeholder="Matric" class="form-control"><br>
				<input name="level" type="text" required placeholder="Level" class="form-control"><br>
				<input name="ccode" type="text" required placeholder="Course Code" class="form-control"><br>
				<input name="ctitle" type="text" required placeholder="Course Title" class="form-control"><br>
				<input name="semester" type="text" required placeholder="semester" class="form-control"><br>
			</div>
			<div class="col-md-6">
				<input type="submit" name="create" id="create" value="Publish" class="btn btn-success btn-block"/>
			</div>

      </div><!-- /#page-wrapper -->
	</div>

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

    <!-- Page Specific Plugins -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script src="js/morris/chart-data-morris.js"></script>
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>
	
	
	<link rel="stylesheet" href="../jwysiwyg/jwysiwyg/jquery.wysiwyg.css" type="text/css" />
  <link rel="stylesheet" href="../jwysiwyg/examples/examples.css" type="text/css" />
  <script type="text/javascript" src="../jwysiwyg/jquery/jquery-1.3.2.js"></script>
  <script type="text/javascript" src="../jwysiwyg/jwysiwyg/jquery.wysiwyg.js"></script>
  <script type="text/javascript">
  $(function()
  {
      $('#wysiwyg').wysiwyg();
  });
  </script>  

  </body>
</html>
