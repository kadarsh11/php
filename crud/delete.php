<?php 
include 'connection.php';


if (isset($_GET['del'])) {
	$id=$_GET['del'];
$delete=mysqli_query($con,"DELETE FROM login_system WHERE id=$id")or die("DELETE QUERY ERROR");
}
$query=mysqli_query($con,"SELECT * FROM login_system")or die("QUERY ERROR");
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>DELETE php</title>
</head>
<body>
<form action="delete.php" method="get">
	<input type="text" name="username">
	<input type="tex" name="">
</form>
</body>
</html>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Delete Table</title>
 	<style type="text/css">
 		table{
 			margin: 0 auto;
 			border: 1px solid #c1c1c1; text-align: center;
 			margin
 		}
 		td{
 			padding: 5px 10px;
 		}
		
 	</style>
 </head>
 <body>
 <table>
 	<tr>
 		<td>ID</td>
 		<td>Username</td>
 		<td>Password</td>
 	</tr>
	
			<?php 
	while ($read=mysqli_fetch_array($query)) {
		?>
		<tr>
		<td><?php echo $read['id']; ?></td>
		<td><?php echo $read['username']; ?></td>
		<td><?php echo $read['password']; ?></td>
		<td><a href="update.php?edit=<?php echo $read['id']; ?>">Edit</a></td>
		<td><a href="delete.php?del=<?php echo $read['id']; ?>">Delete</a></td>
		</tr>
		<?php
		}
			 ?>
	
 </table>
 </body>
 </html>
