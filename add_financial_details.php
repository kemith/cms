<?php
	session_start();
	include('connection.php');
	if(isset($_POST['add'])){
		$activity_name = $_POST['activity_name'];
		$fy = $_POST['FY'];

	/*To fetch user_id*/
		$user=$_SESSION['username'];
		$query1=mysqli_query($db,"SELECT * FROM users where username='$user' ");
		$row=mysqli_fetch_array($query1);
		$id=$row['id'];
	/*To fetch user_id*/
		$query = "INSERT INTO activity(activity_name,fy,approved_budget,technical_sanction,created_date,user_id) VALUES ('$activity_name','$fy','$approved_budget','$file',NOW(),'$id')";
		
		$run_insert = mysqli_query($db,$query);
		echo "Acivity deatails added successfully!";
		
	

}
?>

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
	<a href="login.php" class="logout_btn">Logout</a>
</header>
<!-- Header area end -->
<!-- Side bar start -->
	<div class="sidebar">
	<center>
	<img src="images/profile.jpg" class="profile_image" alt="">
	<h4><?php 	
	echo $_SESSION['username'];
	?></h4>
	</center>
	<a href="index.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
	<a href="add_activity.php"><i class="fa fa-plus-circle"></i><span>Add activity</span></a>
	<a href="show_activity.php"><i class="fas fa-table"></i><span>Manage Activity</span></a>
	<a href="#"><i class="fas fa-th"></i><span>Show Activity Details</span></a>
	</div>
<!-- Side bar end -->

	<div class="content">
	<div class="display2">
	<h1>&nbsp;&nbsp; &nbsp; &nbsp; Add Activity Details</h1>
	<div class="input-group" style="padding:50px 100px;">
	
	<form method="post" action ="" enctype="multipart/form-data">
	<label>Activity Name</label>
	<input type="text" name="activity_name" class="form-control1" required>
	<br/>
    <br/>
	<label>Mobilization Advance</label>
	<input type="text" name="mobilization_advance" class="form-control1" required>
	<br/>
    <br/>
	<label>Materials Advance </label>
	<input type="text" name="materials_advance" class="form-control1" required>
	<br/>
    <br/>
	<input type="submit" name="add"  value="Add" class="form-control" style="background-color:#80aaff;border-radius:5px;width:50px;height:30px;margin-left:80px;">
	</form>
	</div>
	</div>
	</div>
</body>
</html>