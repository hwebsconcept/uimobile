<?php
require_once('../connections/connect.php');



if (!empty ($_GET['courseID'])) {
    $course = $dbh->prepare("SELECT * FROM courseforum WHERE courseID=:id ORDER BY id DESC");
    $course->bindParam(':id', $_GET['courseID']);
    $course->execute();
    while ($coursesForum = $course->fetch(PDO::FETCH_ASSOC)) {
        $clock = strtotime($coursesForum['time']);
        include('../connections/timer.php');

        $forum_detail= $dbh->prepare("SELECT * FROM users WHERE matric=:matric");
        $forum_detail->bindParam(':matric', $coursesForum['matric']);
        $forum_detail->execute();
        $forum_details=$forum_detail->fetch(PDO::FETCH_ASSOC);

        ?>


        <div class="col-md-11" style="background: #efefef; border-radius: 8px; margin:8px; padding: 5px ">
            <img src="../admin/<?php echo $forum_details['img'] ?>" class="img-responsive img-circle pull-left" style="max-width:40px;"/>
            &nbsp;&nbsp;<small class="<?php if ($coursesForum['matric'] == $matric) {echo "pull-right";} else {echo "pull-left";}?>"><?php echo $timer ?></small><br>
            &nbsp;&nbsp;<small style="color:#5A2854;" class="<?php if ($coursesForum['matric'] == $matric) {echo "pull-right";} else {echo "pull-left";}?>"><b class="text-uppercase"><?php echo $forum_details['name'] ?></b></small>
            <br>
            <span class="<?php if ($coursesForum['matric'] == $matric) {echo "pull-right";} else {echo "pull-left";}?>"><?php echo $coursesForum['post'] ?></span>
            <br>
        </div>

        <!--to delete later-->
        <div style="clear:both;"></div>
    <?php
    }
}
?>

