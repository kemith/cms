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
	</div>  
	</div> 
  
</div>
	
	
	
  
<!-- Side bar end -->

	<div class="content">
		
			<?php 
			include('connection.php');
			$user=$_SESSION['username'];
			$query1=mysqli_query($db,"SELECT * FROM users where username='$user' ");
			$row=mysqli_fetch_array($query1);
			$id=$row['id'];
			$result_per_page=5;
			$cnt=1;
			$query = mysqli_query($db,"SELECT * FROM activity where user_id='$id' ORDER BY id DESC");
			$number_of_results = mysqli_num_rows($query);
			//determine  no of total page available
			$number_of_pages = ceil($number_of_results/$result_per_page);
			//determine which page the visitor is currently on
			if(!isset($_GET['page'])){
				$page=1;
			}
			else{
				$page=$_GET['page'];
			}
			//determine the sql LIMIT starting numbers for the results on the displaying page
			$this_page_first_result=($page-1)*$result_per_page;
			//retrieve selected results from database and display them on the page
			$sql="SELECT * FROM activity where user_id='$id'  ORDER BY id DESC LIMIT " .$this_page_first_result . ',' .$result_per_page;
			$result = mysqli_query($db,$sql);
				if($query-> num_rows > 0){?>
				<table align="center" border="2" cellspacing="0" cellpadding="0" style="width:100%;line-height:30px;margin-left:40px;margin-top:60px;border-collapse:collapse;position:absolute;">
		<tr>
			<th rowspan="2">Sl.No</th>
			<th rowspan="2">Activity Name</th>
			<th rowspan="2">Financial Year</th>
			<th rowspan="2">Source of Fund</th>
			<th rowspan="2">Aporoved Budget</th>
			<th colspan="3">Technical Sanction Amount</th>
			<th colspan="2">ADMS & FS</th>
			<th colspan="2">NIT</th>
			<th rowspan="2">Edit</th>	
			<th rowspan="2">Delete</th>
			<th rowspan="2" colspan="2">Mode of execution</th>
			</tr>
			<th>Amount</th>
			<th>Date</th>
			<th>File</th>
		    <th>Date</th>
			<th>File</th>
			<th>Date</th>
			<th>File</th>
			
			</tr>
			<tr><?php
				$count = 1;
				while($row=mysqli_fetch_array($result)){
					?>
					<td><?php echo $count++;?></td>
					<td><?php  echo htmlentities($row["activity_name"]);?></td>
					<td><?php  echo htmlentities($row["FY"]);?></td>
					<td><?php  echo htmlentities($row["fund"]);?></td>
					<td><?php  echo htmlentities($row["approved_budget"]);?></td>
					<td><?php  echo htmlentities($row["ts_amount"]);?></td>
					<td><?php  echo htmlentities($row["ts_date"]);?></td>
					<td><a href="upload/<?php  echo htmlentities($row["technical_sanction"]);?>"><?php  echo htmlentities($row["technical_sanction"]);?></a></td>
					<td><?php  echo htmlentities($row["adms_date"]);?></td>
					<td><a href="upload/<?php  echo htmlentities($row["adms_fs"]);?>"><?php  echo htmlentities($row["adms_fs"]);?></a></td>
					<td><?php  echo htmlentities($row["nit_date"]);?></td>
					<td><a href="upload/<?php  echo htmlentities($row["nit"]);?>"><?php  echo htmlentities($row["nit"]);?></a></td>
					<td><a href="edit-activity.php?editid=<?php echo htmlentities ($row['id']);?>"><img src="images/edit.png" width="25px" style="padding-left:8px" title="Edit"></a>
					<td><a href="delete-activity.php?deleteid=<?php echo htmlentities ($row['id']);?>"><img src="images/delete.png" width="30px" style="padding-left:10px" title="Delete"></a></td>
					<td><?php  echo htmlentities($row["mode_of_execution"]);?>
						
					</td>
					<td>
					<select name= "mode" onchange="la(this.value)">
					<option disabled selected>Select Mode of Execution</option>
					<option value="add_contract_details.php?editid=<?php echo htmlentities ($row['id']);?>">Contract</option>
					<option value="departmental.php?editid=<?php echo htmlentities ($row['id']);?>">Departmental</option></select></td>
	<script>
	function la(src)
	{
		window.location=src;
	}
	</script>-->
				</tr>
					<?php
				
				$cnt=$cnt+1;
				}
					
		
			
		?>
		
		</table>
	<div class="pagination" style="margin-left:5%;margin-top:43%;position:fixed;">
	<?php
		for($page=1;$page<=$number_of_pages;$page++){
			echo '<a href="manage_activity.php?page=' .$page . '" style="background-color:#f44336;display:inline-block;padding:10px 10px;">'.$page. '</a>';
		}
				}
	?>
	</div>
	<?php include "footer.php"?>
	</div>
</body>
</html>