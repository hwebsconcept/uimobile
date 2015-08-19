<?php
require_once('connect.php');
/*session_start();
if (!isset ($_SESSION['matric']))
{
    $go="index.html";
    header("Location:".$go);
}*/

if (!empty ($_GET['id'])) {

    $course = $dbh->prepare("SELECT * FROM coursenotification WHERE courseID=:id ORDER BY id DESC");
    $course->bindParam(':id', $_GET['id']);
    $course->execute();


    $allcourse= $dbh->prepare("SELECT * FROM courses WHERE id=:id");
    $allcourse->bindParam(':id', $_GET['id']);
    $allcourse->execute();
    $mycourse=$allcourse->fetch(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="row" style="border-bottom:1px solid #ccc; background:#fff; padding:3px;">
        <div class="col-md-12">
            <img src="img/nuclogo.jpg" class="img-responsive pull-left" />&nbsp; &nbsp; <b><?php echo $mycourse['courseCode'] ?></b>
            <a href="profile.html"><button class="btn btn-default btn-sm pull-right"> Go Back</button></a>
        </div>
    </div>
</div>
<div class="container">

<?php

    while ($coursesNotification = $course->fetch(PDO::FETCH_ASSOC)) {
        $clock = strtotime($coursesNotification['time']);
        include('timer.php');
            ?>
            <div class="row" style="border-bottom:1px solid #ccc; background:#fff; padding:3px;">
                <div class="col-md-12">
                    <div>
                        <small>POSTED <?php echo $timer ?></small>
                        <br>
                        <i class="fa fa-book" style="color:red;"></i> <span
                            style="font-size:18px;"><b><?php echo $coursesNotification['subject'] ?></b></span> <span
                            class="pull-right"></span>
                        <br>
                        <?php echo $coursesNotification['message'] ?> <br><br>
                    </div>
                </div>
            </div>

            <?php
    }
    ?>
    <div class="row" style="border-bottom:1px solid #ccc; background:#fff; padding:3px;">
        <div class="col-md-12">
            <div>
                No Further Notifications.
            </div>
        </div>
    </div>
    <?php
}
?>
</div>
