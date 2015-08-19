<?php
require_once('connect.php');
session_start();



if (!empty ($_GET['id'])) {

    $course = $dbh->prepare("SELECT * FROM courseforum WHERE courseID=:id ORDER BY id ASC");
    $course->bindParam(':id', $_GET['id']);
    $course->execute();
    while ($coursesForum = $course->fetch(PDO::FETCH_ASSOC)) {
        $clock = strtotime($coursesForum['time']);
        include('timer.php');

        $forum_detail= $dbh->prepare("SELECT * FROM users WHERE matric=:matric");
        $forum_detail->bindParam(':matric', $coursesForum['matric']);
        $forum_detail->execute();
        $forum_details=$forum_detail->fetch(PDO::FETCH_ASSOC);

        ?>


        <div class="col-md-11 col-sm-10 col-xs-10
        <?php
        if ($coursesForum['matric'] == $_GET['matric']) {
            echo "pull-right";
        } else {
            echo "pull-left";
        }

        ?>" style="background: #fff; border-radius: 8px; margin:8px;">
            <img src="admin/<?php echo $forum_details['img'] ?>" class="img-responsive img-circle
            <?php
            if ($coursesForum['matric'] == $_GET['matric']) {echo "pull-right";} else {echo "pull-left";}
            ?>
            " style="max-width:40px;"/>
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

