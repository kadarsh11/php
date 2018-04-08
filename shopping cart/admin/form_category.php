<?php 
include 'connection.php';
if (isset($_POST['submit'])) {
	extract($_POST);
	$id=0;
	$image=$_FILES['image']['name'];
	if ($image) {
		$filename=date('dmyhis').'_'.basename($_FILES['image']['name']);
		$target='./upload/'.$filename;
		move_uploaded_file($_FILES['image']['tmp_name'],$target);
	}

	$query="INSERT INTO category VALUES ('$id','$name','$description','$status','$field_order','$filename')";
	$check=mysqli_query($connection,$query);
	if ($check) {
		echo "Saved";
	}
	else{
		echo "SOmething went wrong";
	}
}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Category Form</title>
</head>
<body>
	<form action="form_category.php" method="post" enctype="multipart/form-data">
		Name : <input type="text" name="name"><br>
		Description : <input type="text" name="description"><br>
		status : <input type="text" name="status"><br>
		Field Order : <input type="text" name="field_order"><br>
		Image : <input type="file" name="image"><br>
		<input type="submit" name="submit">
	</form>
</body>
</html>