<?php
	session_start();
	include('connection.php');
	if(isset($_POST['add'])){
		$activity_id=$_GET['id'];
		$date = $_POST['date'];
		$item = $_POST['item'];
		$rate = $_POST['rate'];
		$qty = $_POST['qty'];
		$amount = $_POST['amount'];
		$remarks = $_POST['remarks'];

		/*To fetch user_id*/
		$user=$_SESSION['username'];
		$query1=mysqli_query($db,"SELECT * FROM users where username='$user' ");
		$row=mysqli_fetch_array($query1);
		$id=$row['id'];
		$query = "INSERT INTO material(date,item,rate,quantity,amount,remarks,user_id,activity_id) VALUES 
		('$date','$item','$rate','$qty','$amount','$remarks','$id','$id','$activity_id')";
		if (mysqli_query($db,$query))

	{
		echo "<script>alert('successfully updated.')
				location.href = ''departmental.php?attempt=success';';
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
	echo $_SESSION['username'];
	?></h4>
	</center>
	<a href="index.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
	<a href="add_activity.php"><i class="fa fa-plus-circle"></i><span>Add activity</span></a>
	<a href="manage_activity.php"><i class="fas fa-table"></i><span>Manage Activity</span></a>
	<a href="show_activity.php"><i class="fas fa-th"></i><span>Show Activity Details</span></a>
	<a href="view_contract_details.php"><i class="fa fa-eye"></i><span>View Contract Details</span></a>
	</div>
<!-- Side bar end -->

	<div class="content">
	<button type="button" class="btn btn-primary" style="width:90px;height:5%;margin-top:7%;margin-left:2%;">
	<a href="view_departmental.php" style="color:black;text-decoration: none;">Go Back</a></button>
	<table align="center" border="2" style="width:40%;line-height:30px;margin-left:40px;margin-top:3%;border-collapse:collapse;position:fixed;">
		<tr>
			<th>Activity Name</th>
			<th colspan="2">Select Type</th>
			
			</tr>
			<tr>
			<?php 
			include('connection.php');
			$activity_id=$_GET['editid'];
			$user=$_SESSION['username'];
			$query1=mysqli_query($db,"SELECT * FROM users where username='$user' ");
			$row=mysqli_fetch_array($query1);
			$id=$row['id'];
			$cnt=1;
			$query = mysqli_query($db,"SELECT * FROM activity where user_id='$id' and id='$activity_id'");
			if($query-> num_rows > 0){
				while ($row = $query->fetch_assoc()){
					?>
					<td><?php  echo htmlentities($row["activity_name"]);?></td>
					<td>
					<select onchange="la(this.value)">
					<option value="">Select</option>
					<option value="add_material.php?id=<?php echo htmlentities ($row['id']);?>">Material</option>
					<option value="add_masteroll.php?id=<?php echo htmlentities ($row['id']);?>">Masteroll</option>
					</select>
	<script>
	function la(src)
	{
		window.location=src;
	}
	</script>
					</td>
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
