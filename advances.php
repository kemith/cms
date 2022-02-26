<?php
	session_start();
	include('connection.php');
	if(isset($_POST['add'])){
		$eid=$_GET['editid'];
		$mobilisation_advance = $_POST['mobilisation_advance'];
		$mobilisation_advance_date = $_POST['mobilisation_advance_date'];
		$material_advance = $_POST['material_advance'];
		$material_advance_date = $_POST['material_advance_date'];

		/*To fetch user_id*/
		$user=$_SESSION['username'];
		$query1=mysqli_query($db,"SELECT * FROM users where username='$user' ");
		$row=mysqli_fetch_array($query1);
		$id=$row['id'];
		/*To fetch contract details id*/
		$query2=mysqli_query($db,"SELECT * FROM contract_details where user_id='$id' and activity_id='$eid' ");
		$row=mysqli_fetch_array($query2);
		$id1=$row['id'];
		$query = "INSERT INTO advance(mobilization_advance,mobilisation_advance_date,material_advance,material_advance_date,contract_details_id,user_id) VALUES 
		('$mobilisation_advance','$mobilisation_advance_date','$material_advance','$material_advance_date','$id1','$id')";
		$run_insert = mysqli_query($db,$query);
		/*echo "Advance details added successfully!";*/
		echo "<script>alert('successfully inserted.')
				location.href = 'view_advance.php?editid=$eid';
				</script>";
	}
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
	<a href="login.php" class="logout_btn">Logout</a>
</header>
<!-- Header area end -->
<!-- Side bar start -->
	<div class="sidebar">
	<center>
	<img src="images/profile.jpg" class="profile_image" alt="">
	<h4><?php 	
	echo $_SESSION['username'];
	?></h4>
	</center>
	<a href="dashboard.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
	<a href="add_activity.php"><i class="fa fa-plus-circle"></i><span>Add activity</span></a>
	<a href="manage_activity.php"><i class="fas fa-table"></i><span>Manage Activity</span></a>
	<a href="show_activity.php"><i class="fas fa-th"></i><span>Show Activity Details</span></a>
	</div>
<!-- Side bar end -->

	<div class="content">
	<div class="display2">
	<h1>&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; Financial Details</h1>
	<div class="input-group" style="padding:0px 100px;">
	<?php 
			include('connection.php');
			$cd_id=$_GET['editid'];
			$cnt=1;
			$query=mysqli_query($db,"select activity.activity_name,contract_details.firm_name from activity,contract_details where activity.id=contract_details.activity_id and contract_details.activity_id='$cd_id'");
			/*$query = mysqli_query($db,"SELECT * FROM contract_details where id='$cd_id' ");*/
			if($query-> num_rows > 0){
				while ($row = $query->fetch_assoc()){
					?>
	<form method="post" action ="" enctype="multipart/form-data">
	<label>Activity Name</label>
	<input type="text" name="activity_name" value="<?php echo ($row["activity_name"]);?>" class="form-control1" required disabled>
	<br/>
    
	<label>Firm Name</label>
	<input type="text" name="activity_name" value="<?php echo ($row["firm_name"]);?>" class="form-control1" required disabled>
	<br/>
 
	<label>Mobilization Advance</label>
	<input type="text" name="mobilisation_advance" class="form-control1" >
	<br/>

	<label>Mobilization Advance Date</label>
	<input type="date" name="mobilisation_advance_date" class="form-control1" >
	<br/>
   
	<label>Materials Advance </label>
	<input type="text" name="material_advance" class="form-control1" >
	<br/>
  
	<label>Materials Advance date </label>
	<input type="date" name="material_advance_date" class="form-control1" >
	<br/>
    <br/>
	<?php }}?>
	<input type="submit" name="add"  value="Add" class="form-control" style="background-color:#80aaff;border-radius:5px;width:50px;height:30px;margin-left:80px;cursor:pointer;">
	</form>
	</div>
	</div>
	<?php include "footer.php"?>
	</div>
</body>
</html>