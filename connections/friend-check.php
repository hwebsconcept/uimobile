<?php
require_once('connect.php');

if (!empty($_GET['id']) && !empty($_GET['matric']))
{
    $status = 0;
    $request= $dbh->prepare("INSERT INTO friends (matric, receiverMatric, status) VALUES (:matric, :receiver, :status)");
    $request->bindParam(':matric',$_GET['matric']);
    $request->bindParam(':receiver',$_GET['id']);
    $request->bindParam(':status',$status);
    if($request->execute())
    {
        echo "yes";
    }
    else{
        echo "no";
    }

    echo json_encode($_GET);
}

$matric=$_GET['matric'];
$recieverMatric=$_GET['recieverMatric'];

$checker= $dbh->prepare("SELECT * FROM friends WHERE matric=:matric AND receiverMatric=:reciever");
$checker->bindParam(':matric', $matric);
$checker->bindParam('reciever', $recieverMatric);
$checker->execute();
if($checker->fetch(PDO::FETCH_NUM) > 0)
{
    $friendcheck=$checker->fetch(PDO::FETCH_ASSOC);
    if ($friendcheck['status'] == 1) {
        ?>
        <button id="<?php echo $_GET['recieverMatric'] ?>" class="btn btn-group-justified btn-success delete"><i class="fa fa-check"></i> FOLLOWING</button>
    <?php
    }
    if ($friendcheck['status'] == 0) {
        ?>
        <button id="<?php echo $_GET['recieverMatric'] ?>" class="btn btn-group-justified btn-warning stop"><i class="fa fa-clock-o"></i> REQUESTED</button>
    <?php
    }
}
else
{
?>
    <button id="<?php echo $_GET['recieverMatric'] ?>" class="btn btn-group-justified btn-primary add"><i class="fa fa-user"></i> ADD TO FRIEND </button>
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
                    window.location.href = "result.html";

                }
            });
        }
        return false;
    });


    $(".stop").on('click', function(){
        var id= $(this).attr('id');
        var info = 'id=' + id + '&matric=' +localStorage.matric;
        if(confirm("Are you sure you want to stop this request?"))
        {
            $.ajax({
                type:'GET',
                url: 'http://truparsecreative.com/uimobile/connections/call.php',
                data : info,
                success: function(data){
                    console.log(data);
                    window.location.href = "result.html";

                }
            });
        }
        return false;
    });


    $(".add").on('click', function(){
        var id= $(this).attr('id');
        var info = 'id=' + id + '&matric=' +localStorage.matric;
        $.ajax({
            type:'GET',
            url: 'http://truparsecreative.com/uimobile/connections/friend-check.php',
            data : info,
            success: function(data){
                console.log(data);
                window.location.reload();

            }
        });
    });
</script>






