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
	</div></div>
<!-- Side bar end -->

	<div class="content">
	<button type="button" class="btn btn-primary" style="width:90px;height:5%;margin-top:7%;margin-left:2%;"><a href="view_departmental.php" style="color:black;text-decoration: none;">Go back</a></button>

		<?php 
			$user=$_SESSION['username'];
			$a_id=$_GET['editid'];
			$query1=mysqli_query($db,"SELECT * FROM users where username='$user'");
			$row=mysqli_fetch_array($query1);
			$id=$row['id'];
			$cnt=1;
			$query = mysqli_query($db,"SELECT material.*,activity.activity_name FROM material,activity where activity.id=material.activity_id and material.user_id='$id' and material.activity_id='$a_id' ORDER BY id DESC ");
			/*$query = mysqli_query($db,"SELECT cd.firm_name,cd.contact_no,cd.email_id,cd.contract_amount,cd.work_order,cd.start_date,cd.end_date,cd.contract_duration,cd.time_extension,a.activity_name FROM contract_details cd INNER JOIN activity a ON a.id=cd.activity_id where cd.user_id='$id'");*/
			/*if ($ad_id ='material.activity_id'){*/
			if($query){
			if($query-> num_rows > 0){?>
			<table align="center" cellspacing="0" cellpadding="0" border="2" style="width:80%;line-height:35px;margin-left:10px;margin-top:80px;border-collapse:collapse;position:fixed;">
			<tr>
					<th>Sl.No</th>
					<th>Activity Name</th>
					<th>Date</th>
					<th>Item</th>
					<th>Rate</th>
					<th>Quantity</th>
					<th>Amount</th>
					<th>Remarks</th>
					<th>Edit</th>
			</tr>
			<tr>
			<?php
				while ($row = $query->fetch_assoc()){
					?>
					<td><?php  echo htmlentities($row["id"]);?></td>
					<td><?php  echo htmlentities($row["activity_name"]);?></td>
					<td><?php  echo htmlentities($row["date"]);?></td>
					<td><?php  echo htmlentities($row["item"]);?></td>
					<td><?php  echo htmlentities($row["rate"]);?></td>
					<td><?php  echo htmlentities($row["quantity"]);?></td>
					<td><?php  echo htmlentities($row["amount"]);?></td>
					<td><?php  echo htmlentities($row["remarks"]);?></td>
					<td><a href="edit_material.php?editid=<?php echo htmlentities ($a_id);?>"><img src="images/edit.png" width="25px" style="padding-left:8px" title="Edit"></a>
          			</tr>
					<?php
				
				$cnt=$cnt+1;
				}
					
			}
			else
			{
				$sql = "SELECT masteroll.*,activity.activity_name FROM masteroll,activity WHERE activity.id=masteroll.activity_id AND masteroll.activity_id='$a_id'";
				$results = mysqli_query($db,$sql) or die("database error:".mysqli_error($db));
				?>
		<!--table display-->
		<table align="center" border="2" cellspacing="0" cellpadding="0" style="width:70%;line-height:30px;margin-left:10px;margin-top:80px;border-collapse:collapse;position:fixed;">
		<tr>
			<th>Activity Name </th>
			<th>Date</th>
			<th>No of Labours</th>
			<th>Rate</th>
			<th>Amount</th>
			<th>Remarks</th>
			<th>Edit</th>
			</tr>
			
		<?php while($row = mysqli_fetch_assoc($results)){?>
		<tr><td><?php echo $row['activity_name']?></td>
		<td><?php echo $row['date'];?></td>
		<td><?php echo $row['no_of_labours'];?></td>
		<td><?php echo $row['rate'];?></td>
		<td><?php echo $row['amount'];?></td>
		<td><?php echo $row['remarks'];?></td>
		<td><a href="edit_masteroll.php?editid=<?php echo htmlentities ($a_id);?>"><img src="images/edit.png" width="25px" style="padding-left:8px" title="Edit"></a>
						
		</tr>	
		<?php }
			}
			}
		?>
	
		
		</table>
	</div>
</body>
</html>