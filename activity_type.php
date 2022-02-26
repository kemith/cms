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
	<img src="images/profile.jpg" class="profile_image" alt="">
	<h4><?php 	
	include('connection.php');
    session_start();
	echo $_SESSION['username'];
	?></h4>
	</center>
	
	<a href="index.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
	<a href="add_activity.php"><i class="fa fa-plus-circle"></i><span>Add activity</span></a>
	<a href="manage_activity.php"><i class="fas fa-table"></i><span>Manage Activity</span></a>
  <a href="show_activity_details.php"><i class="fas fa-th"></i><span>Show Activity Details</span></a>
</div>
	
	
	
  
<!-- Side bar end -->

	<div class="content">
	<table align="center" border="2" style="width:80%;line-height:30px;margin-left:130px;margin-top:60px;border-collapse:collapse;">">
			<tr>
			<th rowspan="2">Activity Name</th>
			<th colspan="2">Activity</th>
			</tr>
			<tr>
			<th>Contract</th>
			<th>Departmental</th>
			</tr>
			
					
			<?php 
			include('connection.php');
			$activity_id=$_GET['editid'];
			$user=$_SESSION['username'];
			$query1=mysqli_query($db,"SELECT * FROM users where username='$user'");
			$row=mysqli_fetch_array($query1);
			$id=$row['id'];
			$cnt=1;
			$query = mysqli_query($db,"SELECT * FROM activity where user_id='$id' and id='$activity_id'");
			if($query-> num_rows > 0){
				while ($row = $query->fetch_assoc()){
					?>
					<td>&nbsp;&nbsp;<?php  echo htmlentities($row["activity_name"]);?></td>
					<td><a href="add_contract_details.php?editid=<?php echo htmlentities ($row['id']);?>">Click here to proceed</a></td>
          			<td><a href="edit-activity.php?editid=<?php echo htmlentities ($row['id']);?>">Click here to proceed</a></td>
					
				
					</tr>
					<?php
				
				$cnt=$cnt+1;
				}
					
			}
			
		?>
	
		
		</table>
	</div>
</body>
</html>