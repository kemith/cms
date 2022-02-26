<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
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
	<a href="login.php" class="logout_btn">Logout</a>

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
	<div class="display2">
	<h1>&nbsp;&nbsp; &nbsp; &nbsp; Add Activity Details</h1>
	<div class="input-group" style="padding:50px 100px;">

	<form method="post" action ="insert_activity.php" enctype="multipart/form-data">
	
	<input type="text" name="activity_name" class="form-control1" placeholder="Name of Work" required>

	Financial Year
	<select name="FY">
		<option value="Year">Select Year</option>
		<option value="2018">2018</option>
		<option value="2019">2019</option>
		<option value="2020">2020</option>
		<option value="2021">2021</option>
		<option value="2022">2022</option>
	</select>
	
	Approved Budget 
	<input type="text" name="approved_budget" class="form-control1" required>
	
	Technical  Sanction
	<input type="file" name="file" class="form-control1" multiple required>
	  </br></br>
	ADMS & FS
	<input type="file" name="file1" class="form-control1" multiple required>

	</br></br>
	NIT
	<input type="file" name="file2" class="form-control1" multiple required>
	<input type="submit" name="add"  value="Add" class="form-control" style="background-color:#80aaff;border-radius:5px;width:50px;height:30px;margin-left:80px;">
	</form>
	</div>
	</div>
	<table>
	<!-- Fetching data from db and displaying -->
	<?php 
			$user=$_SESSION['username'];
			$query1=mysqli_query($db,"SELECT * FROM users where username='$user' ");
			$row=mysqli_fetch_array($query1);
			$id=$row['id'];
			$cnt=1;
			$query2=mysqli_query($db,"SELECT * FROM activity where user_id='$id' ");
			while($res=mysqli_fetch_array($query2)){?>
				<tr><td><?php echo $res['activity_name']?></td>
		<td><?php echo $res['FY'];?></td>
		<td><?php echo $res['approved_budget'];?></td>
		</tr>
			<?php } ?>
	
	
	</table>
	</div>
</body>
</html>