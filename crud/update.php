<?php include 'connection.php';
if (isset($_POST['submit'])) {
	echo $_POST['id'];
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Update Table</title>
 </head>
 <body>
 <form action="" method="post">
 	<input type="hidden" name="id" value="<?php echo student $read['id']; ?>">
 	<input type="text" name="username"><br>
 	<input type="text" name="password"><br>
 	<input type="submit" name="submit">
 </form>
 </body>
 </html>