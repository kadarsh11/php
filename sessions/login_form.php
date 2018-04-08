<?php 
session_start();
include 'connection.php';

if (isset($_POST['submit'])) {
	$username=$_POST['username'];
	$password=$_POST['password'];

	$query="SELECT * FROM login_system";
	$data=mysqli_query($con,$query);
	while ($row=mysqli_fetch_assoc($data)) {
		if ($username==$row['username'] && $password==$row['password']) {
			$_SESSION['pass']=$username;
			header('location: dashboard.php');
		}
	}
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Login system</title>
 </head>
 <body>
 <form action="login_form.php" method="post">
 	<input type="text" name="username" placeholder="Username"><br>
 	<input type="text" name="password" placeholder="Password"><br>
 	<input type="submit" name="submit">
 </form>
 </body>
 </html>