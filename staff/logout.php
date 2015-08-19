<?php
$_SESSION=array();
 if(!empty($_COOKIE[session_name()]))
 {
  setcookie(session_name(),'',time()- 54000,'/');
 }
 session_destroy();
 header("Location: index.php")
 ?>