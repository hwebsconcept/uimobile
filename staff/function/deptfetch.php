<?php
require_once('../../connections/connect.php');
if(!empty($_GET['id']))
{
    $dep= $dbh->prepare("SELECT * FROM department WHERE facultyID = :fID");
    $dep->bindParam(':fID', $_GET['id']);
    $dep->execute();
    while($department=$dep->fetch(PDO::FETCH_ASSOC))
    {
        ?>
        <option value="<?php echo $department['id']; ?>"><?php echo $department['departmentName']; ?></option>
    <?php
    }
    echo json_encode($_GET);
}
?>