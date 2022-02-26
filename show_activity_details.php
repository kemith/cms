
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
	<a href="show_activity.php"><i class="fas fa-th"></i><span>Show Activity Details</span></a>
	</div>
<!-- Side bar end -->

	<div class="content">
	<table align="center" border="2" cellspacing="0" cellpadding="0" style="width:40%;line-height:30px;margin-left:130px;margin-top:60px;border-collapse:collapse;position:fixed;">">
		<tr>
			<th colspan="2">Activity Details</th>
			</tr>
			<tr>
			<?php 
			include('connection.php');
			$eid=$_GET['editid'];
			$user=$_SESSION['username'];
			$query1=mysqli_query($db,"SELECT * FROM users where username='$user' ");
			$row=mysqli_fetch_array($query1);
			$id=$row['id'];
			$cnt=1;
			/*$query = mysqli_query($db,"SELECT activity.*,contract_details.*,material.*,masteroll.* FROM activity,contract_details,material,masteroll where activity.id=contract_details.activity_id and activity.id=masteroll.activity_id and activity.id=material.activity_id and activity.user_id='$id' and activity.id='$eid'");*/
			$query = mysqli_query($db,"SELECT * FROM activity INNER JOIN contract_details ON activity.id=contract_details.activity_id where activity.user_id='$id' and activity.id='$eid'");
			if($query-> num_rows > 0){
				while ($row = $query->fetch_assoc()){
					?>
					<td>&nbsp;&nbsp;Activity Name</td><td>&nbsp;&nbsp;<?php  echo htmlentities($row["activity_name"]);?></td></tr>
					<tr><td>&nbsp;&nbsp;Financial Year</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo htmlentities($row["FY"]);?></td></tr>
					<tr><td>&nbsp;&nbsp;Approved Budget</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo htmlentities($row["approved_budget"]);?></td></tr>
					<tr><td>&nbsp;&nbsp;Technical Sanction</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo htmlentities($row["technical_sanction"]);?></td></tr>
					<tr><td>&nbsp;&nbsp;Created Date</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo htmlentities($row["created_date"]);?></td></tr>
					<tr><td>&nbsp;&nbsp;Firm Name</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo htmlentities($row["firm_name"]);?></td></tr>
					<tr><td>&nbsp;&nbsp;Contact No</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo htmlentities($row["contact_no"]);?></td></tr>
					<tr><td>&nbsp;&nbsp;Email Id</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo htmlentities($row["email_id"]);?></td></tr>
					<tr><td>&nbsp;&nbsp;Contract Amount</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo htmlentities($row["contract_amount"]);?></td></tr>
					<tr><td>&nbsp;&nbsp;Work Order</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo htmlentities($row["work_order"]);?></td></tr>
					<tr><td>&nbsp;&nbsp;Start Date</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo htmlentities($row["start_date"]);?></td></tr>
					<tr><td>&nbsp;&nbsp;End Date</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo htmlentities($row["end_date"]);?></td></tr>
					<tr><td>&nbsp;&nbsp;Contract Duration</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo htmlentities($row["contract_duration"]);?></td></tr>
					<?php
				
				$cnt=$cnt+1;
				}
					
			}
			
		?>
	
		
		</table>
	</div>
</body>
</html>