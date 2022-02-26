<?php
	session_start();
	include('connection.php');
	if(isset($_POST['update'])){
		$ad_id=$_GET['editid'];
		$mobilisation_advance = $_POST['mobilisation_advance'];
		$mobilisation_advance_date = $_POST['mobilisation_advance_date'];
		$material_advance = $_POST['material_advance'];
		$material_advance_date = $_POST['material_advance_date'];

		/*To fetch user_id*/
		$user=$_SESSION['username'];
		$query1=mysqli_query($db,"SELECT * FROM users where username='$user' ");
		$row=mysqli_fetch_array($query1);
		$id=$row['id'];
		/*To fetch contract_details id*/
		$query2=mysqli_query($db,"SELECT * FROM contract_details where user_id='$id' and activity_id='$ad_id' ");
		$row=mysqli_fetch_array($query2);
		$id1=$row['id'];
		
		$query="UPDATE `advance` SET mobilization_advance='$mobilisation_advance',mobilisation_advance_date='$mobilisation_advance_date',material_advance='$material_advance',material_advance_date='$material_advance_date' where contract_details_id='$id1' and user_id='$id'";
		if (mysqli_query($db,$query))

	{
		//$run_insert = mysqli_query($db,$query);
		/*echo "Advance details added successfully!";*/
		echo "<script>alert('successfully updated.')
				location.href = 'view_advance.php?editid=$ad_id';
				</script>";
	}
	else
	{
		echo "Error !!!br />";
	}
	}?>

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
	<b for="check">
	<i class="fas fa-bars" id="sidebar_btn"></i>
	</b>
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
	<div class="display2">
	<h1>&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; Financial Details</h1>
	<div class="input-group" style="padding:0px 100px;">
	<?php 
			include('connection.php');
			$ad_id=$_GET['editid'];
			$cnt=1;
			$query = mysqli_query($db,"SELECT activity.activity_name,advance.*,contract_details.firm_name FROM activity,advance,contract_details where activity.id=contract_details.activity_id and advance.contract_details_id=contract_details.id and activity.id='$ad_id' ");
			if($query-> num_rows > 0){
				while ($row = $query->fetch_assoc()){
					?>
	<form method="post" action ="" enctype="multipart/form-data">
	<label>Activity Name</label>
	<input type="text" name="activity_name" value="<?php echo ($row["activity_name"]);?>" class="form-control1" required disabled>
	<br/>
 
	<label>Firm Name</label>
	<input type="text" name="firm_name" value="<?php echo ($row["firm_name"]);?>" class="form-control1" required disabled>
	<label>Mobilization Advance</label>
	
    <br/>
	<input type="text" name="mobilisation_advance" value="<?php echo ($row["mobilization_advance"]);?>"  class="form-control1" required>

    <br/>
	<label>Mobilization Advance Date</label>
	<input type="date" name="mobilisation_advance_date" value="<?php echo ($row["mobilisation_advance_date"]);?>"class="form-control1" >
	<br/>
    <br/>
	<label>Materials Advance </label>
	<input type="text" name="material_advance" value="<?php echo ($row["material_advance"]);?>" class="form-control1" >
	<br/>
    <br/>
	<label>Materials Advance date </label>
	<input type="date" name="material_advance_date" value="<?php echo ($row["material_advance_date"]);?>" class="form-control1" >
	<br/>
    <br/>
	<?php }}?>
	<input type="submit" name="update"  value="Update" class="form-control" style="background-color:#80aaff;border-radius:5px;width:50px;height:30px;margin-left:80px;cursor:pointer;">
	</form>
	</div>
	</div>
	</div>
</body>
</html>