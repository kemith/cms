<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
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
	</div>	</div>
<!-- Side bar end -->

	<div class="content">
	<button type="button" class="btn btn-primary" style="width:90px;height:5%;margin-top:7%;margin-left:2%;"><a href="view_contract.php" style="color:black;text-decoration: none;">Go back</a></button>
	
			<?php 
			$user=$_SESSION['username'];
			$a_id=$_GET['editid'];
			$query1=mysqli_query($db,"SELECT * FROM users where username='$user'");
			$row=mysqli_fetch_array($query1);
			$id=$row['id'];
			$cnt=1;
			$query = mysqli_query($db,"SELECT activity.activity_name,contract_details.* from contract_details,activity where contract_details.activity_id=activity.id and contract_details.user_id='$id' and contract_details.activity_id='$a_id' ORDER BY contract_details.id DESC");
			/*$query = mysqli_query($db,"SELECT cd.firm_name,cd.contact_no,cd.email_id,cd.contract_amount,cd.work_order,cd.start_date,cd.end_date,cd.contract_duration,cd.time_extension,a.activity_name FROM contract_details cd INNER JOIN activity a ON a.id=cd.activity_id where cd.user_id='$id'");*/
			if($query-> num_rows > 0){?>
			<table align="center" cellspacing="0" cellpadding="0" border="2" style="width:80%;line-height:35px;margin-left:10px;margin-top:60px;border-collapse:collapse;position:absolute;">
			<tr>
			<th>Activity Name</th>
			<th>Firm Name</th>
			<th>Contact No</th>
			<th>Email Id</th>
			<th>Contract Amount</th>
			<th>LoI Datet</th>
			<th>Letter of Intent</th>
			<th>LoA Date</th>
			<th>Letter of Acceptance</th>
			<th>Work Order Date</th>
			<th>Work Order</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Contract Duration</th>
			<th>Time Extension</th>
			<th>Edit</th>
			<th>Add Financial Details</th>
			</tr>
			<tr>
			<?php
				while ($row = $query->fetch_assoc()){
					?>
					<td><?php echo htmlentities ($row['activity_name']);?></td>
					<td><?php echo htmlentities ($row['firm_name']);?></td>
					<td><?php echo htmlentities ($row['contact_no']);?></td>
					<td><?php echo htmlentities ($row['email_id']);?></td>
					<td><?php echo htmlentities ($row['contract_amount']);?></td>
					<td><?php echo htmlentities ($row['loi_date']);?></td>
					<td><?php echo htmlentities ($row['loi']);?></td>
					<td><?php echo htmlentities ($row['loa_date']);?></td>
					<td><?php echo htmlentities ($row['loa']);?></td>
					<td><?php echo htmlentities ($row['work_order_date']);?></td>
					<td><?php echo htmlentities ($row['work_order']);?></td>
					<td><?php echo htmlentities ($row['start_date']);?></td>
					<td><?php echo htmlentities ($row['end_date']);?></td>
					<td><?php echo htmlentities ($row['contract_duration']);?></td>
					<td><?php echo htmlentities ($row['time_extension']);?></td>
					<td><a href="edit_contract_details.php?editid=<?php echo htmlentities ($a_id);?>"><img src="images/edit.png" width="25px" style="padding-left:8px" title="Edit"></a>
          			<td>
					<select onchange="la(this.value)">
					<option disabled selected>Select</option>
					<option value="advances.php?editid=<?php echo htmlentities ($a_id);?>">Advance</option>
					<option value="running_bill.php?id=<?php echo htmlentities  ($a_id);?>">Running Bill</option>
					</select></td>
	<script>
	function la(src)
	{
		window.location=src;
	}
	</script>
					</tr>
					<?php
				
				$cnt=$cnt+1;
				}
					
			}
			
		else{?>
			<button type="button" class="btn btn-primary" style="width:90px;height:5%;margin-top:7%;margin-left:2%;">
			<a href="add_contract_details.php?editid=<?php echo htmlentities($a_id); ?>" style="color:black;text-decoration: none;">Add</a></button>
		<?php }?>
	
		
		</table>
		<?php include "footer.php"?>
	</div>
</body>
</html>