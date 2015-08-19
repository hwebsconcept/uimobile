<?php
header('Access-Control-Allow-Origin: *');

$user="root";
$pass="";
$dbh = new PDO('mysql:host=localhost;dbname=uimobile', $user, $pass);
?>