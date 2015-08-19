<?php
require_once('connect.php');

session_start();

header('Content-Type: application/json');
//if (!empty($_POST['matric']) )
if(isset($_POST['login']))
{
	$matric=$_POST['matric'];
	$password=$_POST['password'];


	
	$pass= $dbh->prepare("SELECT * FROM users WHERE matric=:matric AND password=:password");
	$pass->bindParam(':matric', $matric);
	$pass->bindParam(':password', $password);
	$pass->execute();
	if($pass->fetch(PDO::FETCH_NUM) > 0)
	{
		//$_SESSION['matric']=$matric;
        $response = array(
		'success' => true,
		'matric' => $matric,
        'password' => $password,
        'message' => 'Login successful'
        );
	}
	else
	{
        $response = array(
		'success' => false,
        'matric' => $matric,
        'password' => $password,
		'message' => 'Login fail. Check your login details correctly');
    }

}
else
{
    $response = array(
        'success' => false,
        'matric' => $matric,
        'password' => $password,
        'message' => 'Login fail. Check your login details correctly');
}

echo json_encode($response);

?>