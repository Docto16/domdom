<?php
	session_start();

	//redirect ot login page if not logged in
	if(!isset($_SESSION['user'])){
		header('location:index.php');
		exit();
	}

	//connection
	$conn = new mysqli('localhost', 'root', '', 'dbase');

	//get user details
	$sql = "SELECT * FROM users WHERE id = '".$_SESSION['user']."'";
	$query = $conn->query($sql);
	$row = $query->fetch_assoc();

	date_default_timezone_set('America/New_York');
	$current_time = date("h:i:s A");

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>How to Change Password using PHP</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <style>
        /* Additional styles for date and time display */
        .date-time-container {
            position: fixed;
            top: 10px;
            left: 20px;
            font-size: 14px;
            color: #000;
			font-weight: bold;
        }

        .date {
            float: left;
            margin-left: 00px;
        }

        #currentTime {
            position: fixed;
            top: 10px;
            right: 20px;
            font-size: 14px;
            color: #000;
			font-weight: bold;
        }

        /* Style for left sidebar */
        .sidebar {
            width: 225px;
            background-color: #f2f2f2;
            padding: 15px;
            position: fixed;
            top: 0;
            bottom: 0;
            overflow-y: auto;
            transition: left 0.3s ease; /* Add smooth transition */
        }

        .sidebar.closed {
            left: -200px; /* Move sidebar off-screen when closed */
        }

        /* Style for burger menu icon */
        .burger-menu {
            position: fixed;
            top: 10px;
            left: 200px; /* Adjust based on the width of sidebar */
            cursor: pointer;
            z-index: 999; /* Ensure it appears above other elements */
            transition: left 0.3s ease; /* Add smooth transition */
        }

        /* Style for logo image */
        .logo-img {
            width: 20px;
            height: 20px;
            position: fixed;
            top: 10px;
            left: 10px;
            cursor: pointer;
        }

        /* Style for sidebar navigation links */
        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin-top: 20px;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            color: #333;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .sidebar ul li a:hover {
            color: #333;
            background-color: #007bff;
        }

		.sidebar ul li a.active {
			color: #333; /* Dark blue color for active link */
			font-weight: bold; /* Make the active link bold */
			background-color: #1962b0;
		}
    </style>
</head>
<body>
    <!-- Burger menu icon -->
    

    <!-- Left sidebar -->
    <div class="sidebar">
	<img onclick="toggleSidebar()" src="bars.png" style="width:15px; height:15px; margin-top:-12px;margin-left:187px; z-index: 9999;">
        <ul>
			<li><a href="#" class="active">Link 1</a></li>
            <li><a href="#">Link 2</a></li>
            <li><a href="#">Link 3</a></li>
        </ul>
    </div>

    <!-- Date and Time display -->
    <div class="date-time-container">
        <div class="date" sty onclick="toggleSidebar()"><?php echo date("F j, Y | l");  ?></div> 
    </div>
    <span id="currentTime"></span>

    <!-- Main content -->
    <div class="container" style="margin-left: 200px; padding-top: 20px;">
        <h3 class="page-header text-center">utos ni boss dom</h3>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 panel panel-default" style="padding:20px;">
                <h3>Welcome, <?php echo $row['username']; ?>
                    <span class="pull-right">
                        <a href="logout.php" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                    </span>
                </h3>
                <hr>
                <form method="POST" action="change_password.php">
                    <div class="form-group">
                        <label for="old">Old Password:</label>
                        <input type="password" name="old" id="old" class="form-control" value="<?php echo (isset($_SESSION['old'])) ? $_SESSION['old'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="new">New Password:</label>
                        <input type="password" name="new" id="new" class="form-control" value="<?php echo (isset($_SESSION['new'])) ? $_SESSION['new'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="retype">Retype New Password:</label>
                        <input type="password" name="retype" id="retype" class="form-control" value="<?php echo (isset($_SESSION['retype'])) ? $_SESSION['retype'] : ''; ?>">
                    </div>
                    <button type="submit" name="update" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Update</button>
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
                    if(isset($_SESSION['success'])){
                        ?>
                        <div class="alert alert-success text-center" style="margin-top:20px;">
                            <?php echo $_SESSION['success']; ?>
                        </div>
                        <?php

                        unset($_SESSION['success']);
                    }
                ?>
            </div>
        </div>
    </div>

    <script>
        // Function to toggle sidebar
        function toggleSidebar() {
            var sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('closed');
        }
    </script>
</body>
</html>

<script>
// Function to update time every second
function updateTime() {
	var now = new Date();
	var hours = now.getHours();
	var minutes = now.getMinutes();
	var seconds = now.getSeconds();
	var ampm = hours >= 12 ? 'PM' : 'AM';
	hours = hours % 12;
	hours = hours ? hours : 12; // Handle midnight
	minutes = minutes < 10 ? '0' + minutes : minutes;
	seconds = seconds < 10 ? '0' + seconds : seconds;
	var timeString = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
	document.getElementById('currentTime').textContent = timeString;
}

// Call updateTime function every second
setInterval(updateTime, 1000);

// Call updateTime initially to avoid one second delay
updateTime();
</script>