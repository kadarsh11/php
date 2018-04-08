<?php 
include 'my_function.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Data Take care</title>
</head>
<body>
<table>
	<th>
		<td>Id</td>
		<td>Name</td>
		<td>Father Name</td>
		<td>Mother Name</td>
		<td>Course</td>
		<td>Photo</td>
	</th>
	<?php
	$data=mysqli_query($connection,"SELECT * FROM student");
	print_r($data); 
	// $query="SELECT * FROM student";
	// $data=my_query($query);
	// echo print_r($data);
	while ($row=mysqli_fetch_assoc($data)){
		?>
		<tr>
			<td><?php echo $row['id']; ?></td>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['father_name']; ?></td>
			<td><?php echo $row['mother_name']; ?></td>
			<td><?php echo $row['course']; ?></td>
			<td><img src="./photo/<?php echo $row['photo']?>"/></td>
		</tr>

		<?php
	}
	 ?>
</table>
</body>
</html>