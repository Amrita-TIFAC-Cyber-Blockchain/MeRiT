<?php 

/* 
 * Authors      : Swapneel Khandagale
 * Updated Date : 10-MAY-2022
 */
 
include('sec_headers.php');

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register</title>
	<link rel="icon" type="image/png" href="images/logo.png">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="jquery.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
	<div class="row">
		<div class="container-fluid">
			<center>
				<img src="images/logo.png" width="350">
				<h2>Register</h2>
				<form method="post" action="signup.php">
					<input type="text" name="email" placeholder="Email" required><br/><br/>
					<input type="password" name="password" placeholder="Password" required><br/><br/>
					<input type="password2" name="password2" placeholder="Confirm Password" required><br/><br/>
					<input type="submit" name="register_btn" value="Register">
				</form>
			</center>
		</div>
	</div>
</body>
</html>