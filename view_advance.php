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
	</div></div>
	
	
	
  
<!-- Side bar end -->

	<div class="content">
	<button type="button" class="btn btn-primary" style="width:90px;height:5%;margin-top:7%;margin-left:2%;"><a href="view_contract.php" style="color:black;text-decoration: none;">Go back</a></button>
	
					
			<?php 
			include('connection.php');
			$eid=$_GET['editid'];
			$user=$_SESSION['username'];
			$query1=mysqli_query($db,"SELECT * FROM users where username='$user'");
			$row=mysqli_fetch_array($query1);
			$id=$row['id'];
			$cnt=1;
			$query = mysqli_query($db,"SELECT advance.*,activity.activity_name,contract_details.firm_name FROM activity,contract_details,advance where advance.contract_details_id=contract_details.id and activity.id=contract_details.activity_id and activity.id='$eid' and advance.user_id='$id'");
			if($query-> num_rows > 0){
			?>
			<table align="center" border="2" style="width:80%;line-height:30px;margin-left:80px;margin-top:3%;border-collapse:collapse;">
			<tr>
			<th>Activity Name</th>
			<th>Firm Name</th>
			<th>Mobilization Advance</th>
			<th>Mobilization Advance Date</th>
			<th>Materials Advance</th>
			<th>Materials Advance Date</th>
			<th>Edit</th>
			
			</tr>
			<?php
				while ($row = $query->fetch_assoc()){
					?>
					<td>&nbsp;&nbsp;<?php  echo htmlentities($row["activity_name"]);?></td>
					<td>&nbsp;&nbsp;<?php  echo htmlentities($row["firm_name"]);?></td>
					<td>&nbsp;&nbsp;<?php  echo htmlentities($row["mobilization_advance"]);?></td>
					<td>&nbsp;&nbsp;<?php  echo htmlentities($row["mobilisation_advance_date"]);?></td>
					<td>&nbsp;&nbsp;<?php  echo htmlentities($row["material_advance"]);?></td>
					<td>&nbsp;&nbsp;<?php  echo htmlentities($row["material_advance_date"]);?></td>
					<td><a href="edit_advance.php?editid=<?php echo htmlentities ($eid);?>"><img src="images/edit.png" width="25px" style="padding-left:8px" title="Edit"></a>
					<!--<td><a href="delete_advance.php?deleteid=<?php echo htmlentities ($row['id']);?>"><img src="images/delete.png" width="30px" style="padding-left:10px" title="Delete"></a></td>
					-->
				
					</tr>
					<?php
				
				$cnt=$cnt+1;
				}
					
			}
			
		else{?>
			<button type="button" class="btn btn-primary" style="width:90px;height:5%;margin-top:7%;margin-left:2%;">
			<a href="advances.php?editid=<?php echo htmlentities($eid); ?>" style="color:black;text-decoration: none;">Add</a></button>
		<?php }?>
	
		
		</table>
		<?php include "footer.php"?>
	</div>
</body>
</html>