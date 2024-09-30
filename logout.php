<?php
session_start();
$name=$_POST['name'];
if($_SESSION['username']==$name)
session_unset();
session_destroy();
header('Location: loginform.php');
alert('you are loged out');
exit();
?>
