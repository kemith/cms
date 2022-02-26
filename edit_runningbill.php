<?php
	session_start();
	include('connection.php');
	if(isset($_POST['add'])){
		$eid=$_GET['id'];
		$running_bill = $_POST['running_bill'];
		$date = $_POST['date'];
		$amount = $_POST['amount'];
		$tds = $_POST['tds'];
		$retention_money = $_POST['retention_money'];
		$mobilization_advance = $_POST['mobilization_advance'];
		$material_advance = $_POST['material_advance'];
		$ld = $_POST['ld'];
		$net_payable = $_POST['net_payable'];
		/*To fetch user_id*/
		$user=$_SESSION['username'];
		$query1=mysqli_query($db,"SELECT * FROM users where username='$user'");
		$row=mysqli_fetch_array($query1);
		$id=$row['id'];
		/*To fetch contract details id*/
		$query2=mysqli_query($db,"SELECT * FROM contract_details where user_id='$id' and activity_id='$eid'");
		$row=mysqli_fetch_array($query2);
		$id1=$row['id'];
		$query = "UPDATE `running_bill` SET running_bill='$running_bill',date='$date',amount='$amount',tds='$tds',retention_money='$retention_money',mobilization_advance='$mobilization_advance',material_advance='$material_advance',liquidity_damage='$ld',Net_payable='$net_payable' WHERE user_id='$id' AND contract_details_id='$id1'";
	
		if (mysqli_query($db,$query))

	{
		echo "<script>alert('successfully updated.')
				location.href = 'show_running_bill.php?id=$eid';
				</script>";
	}
	else
	{
		echo "Error adding data in database<br />";
	}
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
form ul { list-style-type: none; }

form ul li { display: inline-block;}
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
	<a href="index.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
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
	<div class="input-field">
	<div class="display5" style="border:2px none;
	background-color:#ccc;
	border-radius:20px;
    width:70%;
	height:22%;
	margin-left:5%;
	margin-top:6%;
	position:fixed;">

		<form method="post" action="" style="position:fixed;margin-top:6px;margin-left:10px;border-radius:5px;">
			<?php 
			include('connection.php');
			$ad_id=$_GET['id'];
			$cnt=1;
			/*$query=mysqli_query($db,"select running_bill.*,activity.activity_name from running_bill,activity,contract_details where activity.id=contract_details.activity_id and running_bill.id='$ad_id'");*/
			$query = mysqli_query($db,"SELECT running_bill.*,activity.activity_name,contract_details.id FROM running_bill,activity,contract_details where activity.id=contract_details.activity_id and running_bill.contract_details_id=contract_details.id and contract_details.activity_id='$ad_id'");
			if($query-> num_rows > 0){
				while ($row = $query->fetch_assoc()){
					?>
		<ul>
			<li><input type="text" name="activity_name"  class="form-control1" value="<?php echo ($row["activity_name"]);?>" required disabled></li>
			<li><input type="text" name="running_bill"  class="form-control1" value="<?php echo ($row["running_bill"]);?>" required></li>
			<li><input type="date" name="date"  class="form-control1" value="<?php echo ($row["date"]);?>" required></li>
			<li><input type="text" name="amount"  class="form-control1" value="<?php echo ($row["amount"]);?>"  required></li>
			<li><input type="text" name="tds"   class="form-control1" value="<?php echo ($row["tds"]);?>" required></li>
			<li><input type="text" name="retention_money" class="form-control1"  value="<?php echo ($row["retention_money"]);?>"  required></li>
			<li><input type="text" name="mobilization_advance"  class="form-control1" value="<?php echo ($row["mobilization_advance"]);?>" required></li>
			<li><input type="text" name="material_advance"  class="form-control1" value="<?php echo ($row["material_advance"]);?>" required></li>
			<li><input type="text" name="ld"  class="form-control1"  value="<?php echo ($row["liquidity_damage"]);?>" required></li>
			<li><input type="text" name="net_payable" class="form-control1"  value="<?php echo ($row["Net_payable"]);?>" required></li>
			&nbsp;&nbsp;&nbsp;
			<?php }}?>
			<li><input type="submit" name="add"  value="Update" class="form-control" style="background-color:#80aaff;border-radius:5px;width:70px;height:28px;margin-left:80px;margin-top:8px;"></li>

			</ul>

		</form>	
	</div></div>

</body>
</html>