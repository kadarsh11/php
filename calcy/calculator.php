
<!DOCTYPE html>
<html>
<head>
	 <link rel="stylesheet" href="css/pushy-buttons.css">
	<title>My best Calci</title>
	<style type="text/css">
		body{
			background:  linear-gradient(to right, #eb3349, #f45c43);;
		}
		button{
			margin-left: 10px;
			background-color: #4CAF50; /* Green */
		    border: none;
		    color: white;
		    padding: 5px 20px;
		    text-align: center;
		    text-decoration: none;
		    display: inline-block;
		    font-size: 16px;
		    font-size: 40px;
		}
		input{
			width: 200px;
			height: 100px;
			border-radius: 10px;
		}
		input[type=text]{
		    border: 5px solid #2ecc71;
		    border-radius: 4px;
		    background-color: #27ae60;
		    color: #fff;
		    font-family: 'Dancing Script', cursive;
		    font-size: 30px;
		    text-align: center;
		    margin-left: 50px;
		}
		h1{
			font-family: 'Dancing Script', cursive;
			font-size: 60px;
			margin-bottom: 30px;
			color: #fff;
			text-align: center;
		}
		.user{
			float: left;
		}
		.result{
			float: right;
			margin-right: 120px;
		}
		div{
			margin-top: 50px;
		}
	</style>
</head>
<body>
<h1>My first best calcy</h1>
<div class="result">
	<h1>
	<?php 
		$num1='';
		$num2='';
		if (isset($_POST['add'])) {
			$num1=$_POST['num1'];
			$num2=$_POST['num2'];
			echo $num1+$num2;
		}
		if (isset($_POST['sub'])) {
			$num1=$_POST['num1'];
			$num2=$_POST['num2'];
			echo $num1-$num2;
		}
		if (isset($_POST['mul'])) {
			$num1=$_POST['num1'];
			$num2=$_POST['num2'];
			echo $num1*$num2;
		}
		if (isset($_POST['div'])) {
			$num1=$_POST['num1'];
			$num2=$_POST['num2'];
			echo $num1/$num2;
		}
	 ?>
	 </h1>
</div>
<div class="user">
	<form action="calculator.php" method="post">
	<input type="text" name="num1" placeholder="<?php echo $num1; ?>">
<input type="text" name="num2" placeholder="<?php echo $num2; ?>"><br><br>
<button class="btn btn--lg btn--blue" name="add">Add</button>
<button class="btn btn--lg btn--green" name="sub">SUB</button>
<button class="btn btn--lg btn--red" name="mul">MUL</button>
<button class="btn btn--lg btn--purple" name="div">DIV</button>
</form>
</div>
</body>
</html>