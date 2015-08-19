<?php require_once('../connections/connect.php');  ?>
<?php
session_start();
if (!isset($_SESSION['staffId']))
{
	header("Location:index.php");
}

$msg=" ";
if (isset($_GET['id']))
{
    $del= $dbh->prepare("DELETE FROM notification WHERE id=:id");
    $del->bindParam(':id',$_GET['id']);
	if ($del->execute())
	{
	$msg="Deleted";
	}
	else
	{
	$msg="Try Again..";
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
			<a href="add-notification.php"><button class="btn btn-success">ADD NOTIFICATION</button></a>
		</div>
		<div class="col-md-12">
			<h3>VIEW NOTIFICATIONS</h3>
			<span style="color:red;"><b><?php echo $msg ?></span>
			</div>
		<table class="table table-bordered">
			<tr class="success">
				<td>ID</td>
				<td>FACULTY</td>
				<td>DEPARTMENT</td>
				<td>SUBJECT</td>
				<td>MESSAGE</td>
		
				<td>EDIT</td>
				<td>DELETE</td>
				
			</tr>
			<?php
			
			
			$a= $dbh->prepare("SELECT * FROM notification WHERE posted=:posted ORDER BY id DESC");
			$a->bindParam(':posted', $_SESSION['staffId']);
			$a->execute();
			while ($b=$a->fetch(PDO::FETCH_ASSOC))
			{
				$dept= $dbh->prepare("SELECT * FROM department WHERE id=:id");
				$dept->bindParam(':id', $b['deptID']);
				$dept->execute();
				$department=$dept->fetch(PDO::FETCH_ASSOC);


				$fac= $dbh->prepare("SELECT * FROM faculty WHERE id=:id");
				$fac->bindParam(':id', $b['facultyID']);
				$fac->execute();
				$faculty=$fac->fetch(PDO::FETCH_ASSOC);
			?>
			<tr>
				<td><?php echo $b['id'] ?></td>
				<td><?php echo ucfirst($faculty['facultyName']) ?></td>
				<td><?php echo ucfirst($department['departmentName']) ?></td>
				<td><?php echo $b['subject'] ?></td>
				<td><?php echo $b['message'] ?></td>
				<td><a href="edit-notification.php?id=<?php echo $b['id'] ?> "><button class="btn btn-sm btn-default">Edit</button> </a></td>
				<td><a href="view-notification.php?id=<?php echo $b['id'] ?> "><button class="btn btn-sm btn-warning">Delete</button> </a></td>
				
			</tr>
			<?php
			}
			?>
		</table>
		
        

      </div><!-- /#page-wrapper -->

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

  </body>
</html>
