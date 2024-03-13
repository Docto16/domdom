<?php
	session_start();

	//redirect to home if session has been set
	if(isset($_SESSION['user'])){
		header('location:home.php');
		exit();
	}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>How to Change Password using PHP</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container">
	<h1 class="page-header text-center">Change Password using PHP</h1>
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4 panel panel-default" style="padding:20px;">
			<form method="POST" action="login.php">
				<p class="text-center" style="font-size:30px;"><b>Login</b></p>
				<hr>
				<div class="form-group">
					<label for="username">Username:</label>
					<input type="text" name="username" id="username" class="form-control">
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" name="password" id="password" class="form-control">
				</div>
				<button type="submit" name="login" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Login</button>
			</form>
			<?php
				if(isset($_SESSION['error'])){
					?>
					<div class="alert alert-danger text-center" style="margin-top:20px;">
						<?php echo $_SESSION['error']; ?>
					</div>
					<?php

					unset($_SESSION['error']);
				}
			?>
		</div>
	</div>
</div>
</body>
</html>