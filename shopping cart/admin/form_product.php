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

	$query="INSERT INTO product VALUES ('$id','$category','$name','$price','$final_price','$description','$status','$field_order','$filename')";
	$check=mysqli_query($connection,$query)or die(mysqli_error($connection));
	if ($check) {
		echo "Saved";
	}
	else{
		echo "Something Went Wrong";
	}
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Product Form</title>
</head>
<body>
	<form action="form_product.php" method="post" enctype="multipart/form-data">
		Category : <?php $query_cat="SELECT * FROM category";
				$data_cat=mysqli_query($connection,$query_cat)or die(mysqli_error($connection));
				while ($row_cat=mysqli_fetch_array($data_cat)) {
					?>  <select name="category">
			<option value="<?php echo $row_cat['cat_id']; ?>"><?php echo $row_cat['cat_name']; ?></option>
		</select>
		<?php
				}
			 ?><br>
		Name : <input type="text" name="name"><br>
		price: <input type="text" name="price"><br>
		Final Price : <input type="text" name="final_price"><br>
		Description : <input type="text" name="description"><br>
		Status : <input type="text" name="status"><br>
		Field Order : <input type="text" name="field_order"><br>
		Image : <input type="file" name="image"><br>
		<input type="submit" name="submit">
	</form>
</body>
</html>