<?php 
include 'connection.php';
session_start();
if ($_SESSION['pass']) {
	echo "Hello ".$_SESSION['pass'];
}
else
{
	header('location: login_form.php');
}
 ?>
