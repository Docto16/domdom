<?php
	session_start();

	if(isset($_POST['login'])){
		//connection
		$conn = new mysqli('localhost', 'root', '', 'dbase');

		//get the user with the username
		$sql = "SELECT * FROM users WHERE username = '".$_POST['username']."'";
		$query = $conn->query($sql);
		if($query->num_rows > 0){
			$row = $query->fetch_assoc();
			//verify password
			if(password_verify($_POST['password'], $row['password'])){
				$_SESSION['user'] = $row['id'];
			}
			else{
				$_SESSION['error'] = 'Password incorrect';
			}
		}
		else{
			$_SESSION['error'] = 'No account with that username';
		}

	}
	else{
		$_SESSION['error'] = 'Fill up login form first';
	}

	header('location: index.php');

?>