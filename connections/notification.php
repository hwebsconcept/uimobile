<?php
require_once('connect.php');


$notification= $dbh->prepare("SELECT * FROM notification ORDER BY id DESC");
$notification->execute();
//$user_course=$course->fetch(PDO::FETCH_ASSOC);
//echo $user_course['matric'];
while ($allNotification = $notification->fetch(PDO::FETCH_ASSOC)) {

    $matric = $_POST['matric'];
    $pass= $dbh->prepare("SELECT * FROM users WHERE matric=:matric");
    $pass->bindParam(':matric', $matric);
    $pass->execute();
    $profile=$pass->fetch(PDO::FETCH_ASSOC);

    $dept= $dbh->prepare("SELECT * FROM department WHERE id=:id");
    $dept->bindParam(':id', $profile['deptID']);
    $dept->execute();
    $department=$dept->fetch(PDO::FETCH_ASSOC);

    if ($allNotification['deptID']=="0" || $allNotification['facultyID']=="0"
        || $allNotification['deptID']==$department['id']  || $allNotification['facultyID']==$department['facultyID'])
    {
    ?>
        <div class="row" style="border-bottom:1px solid #ccc; background:#fff; padding:3px;">
            <div class="col-md-12">
                <div>
                    <i class="glyphicon glyphicon-calendar" style="color:blue;"></i> <span style="font-size:18px;">
                        <b> <?php echo $allNotification['subject'] ?> </b></span> <span class="pull-right"></span>
                    <br>  <?php echo $allNotification['message'] ?>  <br>
                </div>
            </div>
        </div>
<?php
    }
}
?>
