<?php
include('connection.php');
session_start();
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
  <a href="logout.php" class="logout_btn">Logout</a>
  <?php
    $user=$_SESSION['username'];
	$query3=mysqli_query($db,"SELECT * FROM users where username='$user'");
	$row=mysqli_fetch_array($query3);
	$id=$row['id'];
	$query2 = mysqli_query($db,"SELECT A.activity_name,A.id as activity_id,R.remarks as remarks,R.id as id ,R.status FROM activity A,remarks R WHERE A.id=R.activity_id AND R.status=0 AND A.user_id='$id'");
	$count = mysqli_num_rows($query2);
	?>  
  <div class="navbar1">
  <div class="dropdown1">
  <button class="dropbtn1"><span>
      <img src="images/bell.png" height="45px" width="50px"><?php if($count>0){
	  echo $count;}
	  else{
	  echo "No remarks";}
		  ?></span>
   <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-content1">
  <?php 
	 foreach($query2 as $row){
    ?>
     <a href="notification.php?a_id=<?php echo htmlentities ($row['activity_id']);?>"><?php echo htmlentities ($row['activity_name']);?></a>
	<?php
	 }
    ?>	 
  
  </div>
  </div>
  </div>
  </div>
</header>
<!-- Header area end -->
<!-- Side bar start -->
	<div class="sidebar">
	<center>
	<img src="images/profile.jpg" class="profile_image" alt="">
	<h4><?php 	
	include('connection.php');
	echo $_SESSION['username'];
	?></h4>
	</center>
	<a href="dashboard.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
	<a href="add_activity.php"><i class="fa fa-plus-circle"></i><span>Add activity</span></a>
	<a href="manage_activity.php"><i class="fas fa-table"></i><span>Manage Activity</span></a>
	<div class="navbar">
	<div class="dropdown">
	<button class="dropbtn"><i class="fas fa-table"></i><span>Show Activity Details</span>
	<i class="fa fa-caret-down"></i>
	</button>
	<div class="dropdown-content">
	<a href="view_contract.php">View Contract Details</a>
	<a href="view_departmental.php">View Departmental Details</a>
	</div>
	</div>
	</div>
	</div>
	<!-- Side bar end -->

	<div class="content">
	<div id="box2">
	<?php
	include('connection.php');
	$user=$_SESSION['username'];
			$query1=mysqli_query($db,"SELECT * FROM users where username='$user' ");
			$row=mysqli_fetch_array($query1);
			$id=$row['id'];
    $result = mysqli_query($db,"SELECT * FROM activity where mode_of_execution='Contract' and user_id='$id'");
	$num_rows = mysqli_num_rows($result);
	
	?>
	<p><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $num_rows; ?></b><br>
	&nbsp;&nbsp;&nbsp;&nbsp;No of Contractual &nbsp;&nbsp;&nbsp;&nbsp;Activities</p>
	</div>
	
	<div id="box3">
	<?php
	include('connection.php');
    $result = mysqli_query($db,"SELECT * FROM activity where mode_of_execution='Departmental' and user_id='$id'");
	$num_rows = mysqli_num_rows($result);
	?>
	<p><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $num_rows; ?></b><br>
	&nbsp;&nbsp;&nbsp;No of Departmental&nbsp;&nbsp;Activities</p>
	</div>
	<?php include "footer.php"?>
	</div>
</body>
</html>