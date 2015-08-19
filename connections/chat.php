<?php
require_once('connect.php');
session_start();



if (!empty ($_GET['id'])) {

    $message = $dbh->prepare("SELECT * FROM message WHERE (tostudent=:tostudent AND fromstudent=:fromstudent)
    OR (tostudent=:fromstudent AND fromstudent=:tostudent) ORDER BY id ASC");
    $message->bindParam(':tostudent', $_GET['id']);
    $message->bindParam(':fromstudent', $_GET['matric']);
    $message->execute();
    while ($msg = $message->fetch(PDO::FETCH_ASSOC)) {
        $clock = strtotime($msg['date']);
        
        include('timer.php');
        $student_detail= $dbh->prepare("SELECT * FROM users WHERE matric=:fromstudent");
        $student_detail->bindParam(':fromstudent', $msg['fromstudent']);
        $student_detail->execute();
        $student_details=$student_detail->fetch(PDO::FETCH_ASSOC);
        ?>


        <div class="col-md-11 col-sm-10 col-xs-10
        <?php
        if ($msg['fromstudent'] == $_GET['matric']) {
            echo "pull-right";
        } else {
            echo "pull-left";
        }

        ?>" style="background: #fff; border-radius: 8px; margin:8px; padding:8px;">
            <img src="admin/<?php echo $student_details['img'] ?>" class="img-responsive img-circle
            <?php
            if ($msg['fromstudent'] == $_GET['matric']) {echo "pull-right";} else {echo "pull-left";}
            ?>
            " style="max-width:40px;"/>
                &nbsp;&nbsp;<small class="<?php if ($msg['fromstudent'] == $matric) {echo "pull-right";} else {echo "pull-left";}?>"><?php echo $timer ?></small><br>
                &nbsp;&nbsp;<small style="color:#5A2854;" class="<?php if ($msg['fromstudent'] == $matric) {echo "pull-right";} else {echo "pull-left";}?>"><b class="text-uppercase"><?php echo $student_details['name'] ?></b></small>
                <br>
                <span class="<?php if ($msg['fromstudent'] == $matric) {echo "pull-right";} else {echo "pull-left";}?>"><?php echo $msg['message'] ?></span>
            <br>
        </div>

        <!--to delete later-->
        <div style="clear:both;"></div>
    <?php
    }
}
?>

