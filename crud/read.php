<?php 
include 'connection.php';

$query=mysqli_query($con,"SELECT * FROM login_system")or die("QUERY ERROR");
 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<title>Read Table</title>
 	<style type="text/css">
 		table{
 			margin: 0 auto;
 			border: 1px solid #c1c1c1; text-align: center;
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
		</tr>
		<?php
		}
			 ?>
	
 </table>
 </body>
 </html>
