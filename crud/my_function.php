<?php 
function my_query($query){
$con=mysqli_connect('localhost','root','','adarsh');
mysqli_query($con,$query)or die("QUERY ERROR") ;
}


 ?>

