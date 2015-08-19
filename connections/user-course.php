<?php
require_once('connect.php');
/*session_start();
if (!isset ($_SESSION['matric']))
{
    $go="index.html";
    header("Location:".$go);
}
$matric = $_SESSION['matric'];*/

$matric = $_POST['matric'];

$course= $dbh->prepare("SELECT * FROM user_courses WHERE matric=:matric");
$course->bindParam(':matric', $matric);
$course->execute();
//$user_course=$course->fetch(PDO::FETCH_ASSOC);
//echo $user_course['matric'];
while ($user_courses=$course->fetch(PDO::FETCH_ASSOC))
{
    $allcourse= $dbh->prepare("SELECT * FROM courses WHERE id=:id");
    $allcourse->bindParam(':id', $user_courses['courseID']);
    $allcourse->execute();
    $mycourse=$allcourse->fetch(PDO::FETCH_ASSOC);
?>
    <div class="col-md-12" style="padding:10px; border-bottom:1px solid #ccc; color:#434343;">
        <a href="course-notification.html?id=<?php echo $mycourse['id'] ?>"><i class="fa fa-2x fa-globe pull-right" style="color: #5A2854;"></i></a>
        <a href="course-forum.html?id=<?php echo $mycourse['id'] ?>"><i class="fa fa-2x fa-users pull-right"  style="color: #5A2854;  padding-right:5px;"></i></a>
        <b><?php echo $mycourse['courseCode'] ?></b><br>
        <small><b><?php echo $mycourse['courseName'] ?></b></small>
    </div>
<?php
}
?>

