<?php 
include 'my_function.php';

if (isset($_POST['submit'])) {
	$id=0;
	$name=$_POST['name'];
	$father_name=$_POST['father_name'];
	$mother_name=$_POST['mother_name'];
	$course=$_POST['course'];
	$photo=$_FILES['photo']['name'];

	if ($photo) {
		$filename=date('dmyhis').'_'.basename($photo);
		$target='./photo/'.$filename;
	}

	if ($name && $father_name && $mother_name && $course) {
		$query="INSERT INTO student VALUES ('$id','$name','$father_name','$mother_name','$course','$filename')";
		$check=my_query($query);
		if ($check) {
			move_uploaded_file($_FILES['photo']['tmp_name'],$target);
			echo "Form Uploaded";
		}
	}
	else
	{
		echo "Input all fields";
	}
}
 ?>

<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Lato:100i,400,400i" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Form</title>
</head>
<body>
	<h1>FORM</h1>
<form action="form.php" method="post" enctype="multipart/form-data">
	 Name: <input type="text" name="name"><br>
	 Father Name : <input type="text" name="father_name"><br>
	 Mother Name : <input type="text" name="mother_name"><br>
	 course : <input type="text" name="course"><br>
	 Photo : <input type="file" name="photo"><br>
	 <input type="submit" name="submit">
</form>
</body>
</html>