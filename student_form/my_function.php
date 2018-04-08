<?php 
$connection=mysqli_connect('localhost','root','','adarsh');
 if ($connection==false) {
 	echo "Connection not established";
 }

 function my_query($query){
 	$connection=mysqli_connect('localhost','root','','adarsh');
 	return mysqli_query($connection,$query)or die("QUERRY DIE".mysqli_error($connection));
 }
 ?>
