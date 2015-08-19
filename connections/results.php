<?php
require_once('connect.php');
session_start();
/*if (!isset ($_SESSION['matric']))
{
    $go="../index.html";
    header("Location:".$go);
}
$matric = $_SESSION['matric'];*/


$matric = $_POST['recieverMatric'];
$pass= $dbh->prepare("SELECT * FROM users WHERE matric=:matric");
$pass->bindParam(':matric', $matric);
$pass->execute();
$profile=$pass->fetch(PDO::FETCH_ASSOC);

$dept= $dbh->prepare("SELECT * FROM department WHERE id=:id");
$dept->bindParam(':id', $profile['deptID']);
$dept->execute();
$department=$dept->fetch(PDO::FETCH_ASSOC);


$fac= $dbh->prepare("SELECT * FROM faculty WHERE id=:id");
$fac->bindParam(':id', $department['facultyID']);
$fac->execute();
$faculty=$fac->fetch(PDO::FETCH_ASSOC);


$img= "<img src='admin/".$profile['img']."' class='img-responsive pull-right' style='max-width:120px;'/>";

$response = array(
    'name' => $profile['name'],
    'matric' => $matric,
    'dept' => $department['departmentName'],
    'faculty' => $faculty['facultyName'],
    'cumgpa' => $profile['cumgpa'],
    'currentgpa' => $profile['currentgpa'],
    'school' => $profile['school'],
    'semester'=> $profile['semester'],
    'level'=> $profile['level'],
    'img'=> $img
);
echo json_encode($response);
?>
