<?php
require_once('connect.php');


if (!empty($_GET['id']) && !empty($_GET['delmatric']))
{
    $e= $dbh->prepare("DELETE FROM friends WHERE matric=:matric AND receiverMatric=:id");
    $e->bindParam(':matric',$_GET['matric']);
    $e->bindParam(':id',$_GET['id']);
    if($e->execute())
    {
        $del= $dbh->prepare("DELETE FROM friends WHERE matric=:matric AND receiverMatric=:id");
        $del->bindParam(':id',$_GET['matric']);
        $del->bindParam(':matric',$_GET['id']);
        $del->execute();
    }
    echo json_encode($_GET);
}

if (!empty($_GET['accept_id']) && !empty($_GET['accept_matric']))
{
    $e= $dbh->prepare("UPDATE friends SET status=1 WHERE matric=:matric AND receiverMatric=:id");
    $e->bindParam(':matric',$_GET['accept_id']);
    $e->bindParam(':id',$_GET['accept_matric']);
    if($e->execute()){
        $request= $dbh->prepare("INSERT INTO friends (matric, receiverMatric, status) VALUES (:matric, :receiver, 1)");
        $request->bindParam(':matric',$_GET['accept_matric']);
        $request->bindParam(':receiver',$_GET['accept_id']);
        $request->execute();
    }
    echo json_encode($_GET);
}

$matric=$_GET['matric'];

$friend= $dbh->prepare("SELECT * FROM friends WHERE receiverMatric=:matric AND status = 0 ORDER BY id DESC");
$friend->bindParam(':matric', $matric);
$friend->execute();
/*if($friend->fetch(PDO::FETCH_NUM) > 0)
{*/
?>
    <div class="container">
        <div class="row" style="border-bottom:1px solid #ccc; background:#fff; padding:3px;">
            <div class="col-md-12">
                <img src="img/nuclogo.jpg" class="img-responsive pull-left" />&nbsp; &nbsp; <b>FRIEND REQUEST</b>
            </div>
        </div>
    </div>
<?php
    while ($friendnot=$friend->fetch(PDO::FETCH_ASSOC))
    {
        $friend_detail= $dbh->prepare("SELECT * FROM users WHERE matric=:matric");
        $friend_detail->bindParam(':matric', $friendnot['Matric']);
        $friend_detail->execute();
        $friend_details=$friend_detail->fetch(PDO::FETCH_ASSOC);
?>
<div class="container loop">
    <div class="row" style="border-bottom:1px solid #ccc; background:#fff; padding:3px;">
        <div class="col-md-12 col-sm-12 col-xs-12" style="padding:10px; color:#434343;">
            <img src="admin/<?php echo $friend_details['img'] ?>" class="img-responsive img-circle pull-left" style="max-width:45px;"/>
            <b><?php echo $friend_details['name'] ?></b><br>
            <?php echo $friend_details['phone'] ?>
            <div class="clearfix"></div>
            <div style="margin-top:3px;">
                <button class="btn btn-success btn-sm add"id="<?php echo $friendnot['Matric'] ?>"><small><i class="fa fa-check"></i> ACCEPT</small></button></a>
                <button class="btn btn-danger btn-sm delete" id="<?php echo $friendnot['Matric'] ?>"><small><i class="fa fa-times"></i> IGNORE</small></button>
            </div>
        </div>
    </div>
</div>
<?php
    }
    echo '<div style="margin-bottom:15px;"></div>';
//}
?>


<script>
    $(".delete").on('click', function(){
        var id= $(this).attr('id');
        var info = 'id=' + id + '&delmatric=' +localStorage.matric;
        if(confirm("You will not be able to call or chat with this user once you unfollow. Do you want to continue?"))
        {
            $.ajax({
                type:'GET',
                url: 'http://truparsecreative.com/uimobile/connections/friends-notification.php',
                data : info,
                success: function(data){
                    console.log(data);
                }
            });
            $(this).parents(".loop").animate({ background: "#fbc7c7" }, "fast")
                .animate({ opacity: "hide" }, "slow");
        }
        return false;
    });

    $(".add").on('click', function(){
        var id= $(this).attr('id');
        var info = 'accept_id=' + id + '&accept_matric=' +localStorage.matric;
            $.ajax({
                type:'GET',
                url: 'http://truparsecreative.com/uimobile/connections/friends-notification.php',
                data : info,
                success: function(data){
                    console.log(data);
                    alert("Accepted")
                }
            });
            $(this).parents(".loop").animate({ background: "#fbc7c7" }, "fast")
                .animate({ opacity: "hide" }, "slow");
        return false;
    });
</script>
