<?php
require_once('connect.php');

header('Content-type:  application/json.');

if(!empty($_POST['matric']))
{
    $matric=$_POST['matric'];



    $pass= $dbh->prepare("SELECT * FROM users WHERE matric=:matric");
    $pass->bindParam(':matric', $matric);
    $pass->execute();
    if($pass->fetch(PDO::FETCH_NUM) > 0)
    {
        //$_SESSION['matric']=$matric;
        $response = array(
            'success' => true,
            'recieverMatric' => $matric,
            'message' => 'User Valid'
        );
    }
    else
    {
        $response = array(
            'success' => false,
            'recieverMatric' => $matric,
            'message' => 'User Invalid');
    }

}
else
{
    $response = array(
        'success' => false,
        'recieverMatric' => $matric,
        'message' => 'User Invalid');
}

echo json_encode($response);

?>
