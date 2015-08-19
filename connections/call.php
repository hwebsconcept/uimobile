<?php
require_once('connect.php');


$matric = $_POST['matric'];
if (!empty($_GET['id']) && !empty($_GET['matric']))
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

$friend= $dbh->prepare("SELECT * FROM friends WHERE matric=:matric AND status = 1 ORDER BY id DESC");
$friend->bindParam(':matric', $matric);
$friend->execute();
while ($friends=$friend->fetch(PDO::FETCH_ASSOC))
{
    $friend_detail= $dbh->prepare("SELECT * FROM users WHERE matric=:matric");
    $friend_detail->bindParam(':matric', $friends['receiverMatric']);
    $friend_detail->execute();
    $friend_details=$friend_detail->fetch(PDO::FETCH_ASSOC);
?>
<div class="loop">
        <div class="col-md-12 col-sm-12 col-xs-12" style="padding:10px; border-bottom:1px solid #ccc; color:#434343;">
            <img src="admin/<?php echo $friend_details['img'] ?>" class="img-responsive img-circle pull-left" style="max-width:45px;"/>
            <b><?php echo $friend_details['name'] ?></b><br>
            <?php echo $friend_details['phone'] ?>
            <div class="pull-right">
                <a href="tel:<?php echo $friend_details['phone'] ?>"><button class="btn btn-success btn-sm"><small><i class="fa fa-2x fa-phone"></i></small></button></a>
                <a href="chat.html?id=<?php echo $friends['receiverMatric'] ?>"><button class="btn btn-primary btn-sm msg"><small><i class="fa fa-2x fa-envelope"></i></small></button></a>
                <button class="btn btn-danger btn-sm delete" id="<?php echo $friends['receiverMatric'] ?>"><small><i class="fa fa-2x fa-times"></i></small></button>
            </div>
        </div>
</div>
<?php
}
?>


<script>
    $(".delete").on('click', function(){
        var id= $(this).attr('id');
        var info = 'id=' + id + '&matric=' +localStorage.matric;
        if(confirm("You will not be able to call or chat with this user once you unfollow. Do you want to continue?"))
        {
            $.ajax({
                type:'GET',
                url: 'http://truparsecreative.com/uimobile/connections/call.php',
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
</script>
