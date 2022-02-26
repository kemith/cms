
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
	<a href="chiefpage.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
	<a href="cshow_activity.php"><i class="fas fa-table"></i><span>Show Activity</span></a>
	<a href="#"><i class="fas fa-th"></i><span>Forms</span></a>
	</div>
<!-- Side bar end -->

	<div class="content">
	
			<?php 
			include('connection.php');
			$result_per_page=5;
			$cnt=1;
			$query = mysqli_query($db,"SELECT * FROM activity");
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
			$sql="SELECT * FROM activity LIMIT " .$this_page_first_result . ',' .$result_per_page;
			$result = mysqli_query($db,$sql);
			if($query-> num_rows > 0){?>
			<table align="center" border="2" style="width:75%;line-height:30px;margin-left:40px;margin-top:70px;border-collapse:collapse;position:fixed;">
			<tr>
			<th>Activity Name</th>
			<th>Financial Year</th>
			<th>Aporoved Budget</th>
			<th>technical Sanction</th>
			<th>ADMS & FS</th>
			<th>NIT</th>
			</tr>
			<tr><?php
				while($row=mysqli_fetch_array($result)){
					?>
					<td><?php  echo htmlentities($row["activity_name"]);?></td>
					<td><?php  echo htmlentities($row["FY"]);?></td>
					<td><?php  echo htmlentities($row["approved_budget"]);?></td>
					<td><?php  echo htmlentities($row["technical_sanction"]);?></td>
					<td><?php  echo htmlentities($row["adms_fs"]);?></td>
					<td><?php  echo htmlentities($row["nit"]);?></td>
					
						</tr>
					<?php
				
				$cnt=$cnt+1;
				}
			
		?>
	
		
		</table>
		<div class="pagination" style="margin-left:5%;margin-top:43%;position:fixed;">
	<?php
		for($page=1;$page<=$number_of_pages;$page++){
			echo '<a href="cshow_activity.php?page=' .$page . '" style="background-color:#f44336;display:inline-block;padding:10px 10px;">'.$page. '</a>';
		}
				}
	?>
	</div>
	</div>
</body>
</html>