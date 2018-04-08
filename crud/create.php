<?php 
include 'connection.php';
include 'my_function.php';

if (isset($_POST['submit'])) {
	$id=0;
	$username=$_POST['username'];
	$password=$_POST['password'];
	if ($username && $password) 
	{
		$query="INSERT INTO login_system VALUES('$id','$username','$password')";
		my_query($query);
	}
	else
	{
		echo "Input Username and Password";
	}
}
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Create Database</title>
</head>
<body>
<form action="create.php" method="post">
	<input type="text" name="username" placeholder="Username"><br>
	<input type="text" name="password" placeholder="Password"><br>
	<input type="submit" name="submit" value="submit"><br>
</form>
</body>
</html>