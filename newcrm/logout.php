<?php 
session_start();
unset($_SESSION['admin_id']);
unset($_SESSION['admin_access']);
session_destroy();
header('location:./');
exit;
?>