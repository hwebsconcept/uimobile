<?php 
require_once('../connections/connect.php'); 
session_start();
if (!isset ($_SESSION['staffId']))
{
	$goto= "index.php";
	header("Location:".$goto);
}

if (isset ($_GET['id']))
{
    $checking= $dbh->prepare("SELECT * FROM notification WHERE id=:id");
    $checking->bindParam(':id',$_GET['id']);
    $checking->execute();
    $x = $checking->fetch(PDO::FETCH_ASSOC);
}

$msg="";
if(isset($_POST['create']))
{
	$faculty = $_POST['faculty'];
    $department = $_POST['department'];
	$sub = $_POST['subject'];
	$article = $_POST['article'];

    $x= $dbh->prepare("UPDATE notification SET facultyID=:faculty, deptID=:department, subject=:subject, message=:message WHERE id=:id");
    $x->bindParam(':faculty', $faculty);
    $x->bindParam(':department', $department);
    $x->bindParam(':subject', $sub);
    $x->bindParam(':message', $article);
    $x->bindParam(':id', $_GET['id']);
    if ($x->execute())
    {
        $msg= "File Updated Successfully";
    }
    else
    {
        $msg= "File was not Updated. Please try again.";

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
	<script src="//cdn.ckeditor.com/4.4.7/full/ckeditor.js"></script>
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
		<div class="col-md-12" >
			<a href="view-notification.php"><button class="btn btn-default">GO BACK</button></a>
			</div>
			<div class="col-md-12">
			<h3>EDIT NOTIFICATIONS</h3>
			<span style="color:red;"><b><?php echo $msg ?></span>
			</div>
		
		<form action="" method="post" enctype="multipart/form-data" name="form2" id="form2">
			<div class="col-md-12">
				<select name="faculty" class="form-control faculty" required>
                    <option selected="selected">Choose Faculty</option>
                    <?php
                    $fac= $dbh->prepare("SELECT * FROM faculty ORDER BY id DESC");
                    $fac->execute();
                    while($faculty=$fac->fetch(PDO::FETCH_ASSOC))
                    {
                        ?>
                        <option value="<?php echo $faculty['id']; ?>"><?php echo $faculty['facultyName']; ?></option>
                    <?php
                    }
                    ?>
				</select><br>
				<select name="department" class="form-control deptfetch" required>
					<option selected="selected">Choose Department</option>
				</select><br>
				<input name="subject" type="text" required placeholder="Subject" value="<?php  echo $x['subject'] ?>" class="form-control"><br>
				<textarea name="article" type="text" required placeholder="Message" class="form-control"><?php  echo $x['message'] ?></textarea>
				<script>
					CKEDITOR.replace( 'article' );
				</script>
				<br>
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

	
<script type="text/javascript">
$(document).ready(function()
{
$(".faculty").change(function()
{
var id=$(this).val();
var dataString = 'id='+ id;

$.ajax
({
type: "GET",
url: "function/deptfetch.php",
data: dataString,
cache: false,
success: function(data)
{
    $('.deptfetch').html(data);
} 
});

});

});
</script>

  </body>
</html>
