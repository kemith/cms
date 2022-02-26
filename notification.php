

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

<!-- Header area start--> 
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
	</div>
<!-- Side bar end -->

	<div class="content">
	<div class="backpage">
	<a href="dashboard.php"><img src="images/back.png" width="50px" height="30px" style="float:right;"></a>
	</div>
	<table align="center" border="2" style="width:75%;line-height:30px;margin-left:5px;margin-top:120px;border-collapse:collapse;position:fixed;align:center;">
		<tr>
			<th>Activity Name</th>
			<th>Financial Year</th>
			<th>Aporoved Budget</th>
			<th>Remarks</th>
			</tr>
			<tr>
			<?php 
			include('connection.php');
		
			$id = $_GET['a_id'];
			$query1=mysqli_query($db,"Update remarks SET status=1 where status=0 AND activity_id='$id'");
			$query = mysqli_query($db,"SELECT A.activity_name as activity_name,A.FY as FY,A.approved_budget as approved_budget,R.remarks as remarks FROM activity A,remarks R where A.id=R.activity_id AND R.activity_id='$id'");
			if($query-> num_rows > 0){
				while ($row = $query->fetch_assoc()){
					?>
					<td><?php  echo htmlentities($row["activity_name"]);?></td>
					<td><?php  echo htmlentities($row["FY"]);?></td>
					<td><?php  echo htmlentities($row["approved_budget"]);?></td>
					<td><?php  echo htmlentities($row["remarks"]);?></td>
					</tr>
					<?php
				}
					
			}
			
		?>
	
		
		</table>
		<?php include "footer.php"?>
	</div>
</body>
</html>

?>