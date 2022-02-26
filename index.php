
<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<style>
body{
	margin:0;
	padding:0;
	font-family:"Roboto", sans-serif;
}
</style>
</head>
<body>
<input type="checkbox" id="check">

<!-- Header area start -->
<header>
	<label for="check">
	<i class="fas fa-bars" id="sidebar_btn"></i>
	</label>
	<div class="left_area">
	<h3>&nbsp;&nbsp;Wel<span>come</span></h3>
	</div>
	<div class="right_area">
	<a href="logout.php" class="logout_btn">Logout</a>
	
</header>
<!-- Header area end -->
<!-- Side bar start -->
	<div class="sidebar">
	<center>
	<img src="images/gelephu.png" class="profile_image" alt="">
	<h4><?php 	
	include('connection.php');
    session_start();
	echo $_SESSION['username'];
	?></h4>
	</center>
	<a href="index.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
	<div class="navbar">
	<div class="dropdown">
	<button class="dropbtn"><i class="fas fa-table"></i><span>Show Activity Details</span>
	<i class="fa fa-caret-down"></i>
	</button>
	<div class="dropdown-content">
	<a href="view_contract_activities.php">View Contract Details</a>
	<a href="view_departmental_activities.php">View Departmental Details</a>
	</div>
	</div>
	</div>
	</div>
<!-- Side bar end -->

	<div class="content">
	<div id="box1">
	<?php
	include('connection.php');
    $result = mysqli_query($db,"SELECT * FROM activity");
	$num_rows = mysqli_num_rows($result);
	?>
	<p><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $num_rows; ?></b><br>
	&nbsp;&nbsp;&nbsp;&nbsp;No of activities</p>
	</div>
	
	<div id="box2">
	<?php
	include('connection.php');
    $result = mysqli_query($db,"SELECT * FROM activity where mode_of_execution='Contract'");
	$num_rows = mysqli_num_rows($result);
	?>
	<p><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $num_rows; ?></b><br>
	&nbsp;&nbsp;&nbsp;&nbsp;No of Contractual  &nbsp;&nbsp;&nbsp;&nbsp;Activities</p>
	</div>
	
	<div id="box3">
	<?php
	include('connection.php');
    $result = mysqli_query($db,"SELECT * FROM activity where mode_of_execution='Departmental'");
	$num_rows = mysqli_num_rows($result);
	?>
	<p><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $num_rows; ?></b><br>
	&nbsp;&nbsp;&nbsp;&nbsp;No of Departmental Activites</p>
	</div>
	<?php include "footer.php"?>
	</div>
</body>
</html>