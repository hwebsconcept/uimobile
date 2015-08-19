<?php
require_once('connect.php');
// Insert into course forum comment into database.
$posted = $_POST['comment'];
$id = $_POST['id'];
$matric = $_POST['matric'];
if (!empty($_POST['comment'])) {
    $forum = $dbh->prepare("INSERT INTO courseforum (matric, courseID, post) VALUES (:matric, :id, :posted)");
    $forum->bindParam(':matric', $matric);
    $forum->bindParam(':id', $id);
    $forum->bindParam(':posted', $posted);
    $forum->execute();
}



    $course = $dbh->prepare("SELECT * FROM courseforum WHERE courseID=:id ORDER BY id DESC");
    $course->bindParam(':id', $id);
    $course->execute();
    $coursesForum = $course->fetch(PDO::FETCH_ASSOC);
        $clock = strtotime($coursesForum['time']);
        include('timer.php');

        $forum_detail= $dbh->prepare("SELECT * FROM users WHERE matric=:matric");
        $forum_detail->bindParam(':matric', $coursesForum['matric']);
        $forum_detail->execute();
        $forum_details=$forum_detail->fetch(PDO::FETCH_ASSOC);

        ?>


        <div class="col-md-11 col-sm-10 col-xs-10
        <?php
        if ($coursesForum['matric'] == $matric) {
            echo "pull-right";
        } else {
            echo "pull-left";
        }

        ?>" style="background: #fff; border-radius: 8px; margin:8px;">
            <img src="admin/<?php echo $forum_details['img'] ?>" class="img-responsive img-circle pull-left" style="max-width:40px;"/>
            &nbsp;&nbsp;<small><?php echo $timer ?></small><br>
            &nbsp;&nbsp;<small><b class="text-uppercase"><?php echo $forum_details['name'] ?></b></small>
            <br>
            <span><?php echo $coursesForum['post'] ?></span>
            <br>
        </div>

        <!--to delete later-->
        <div style="clear:both;"></div>

