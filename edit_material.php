<?php
	session_start();
	include('connection.php');
	if(isset($_POST['update'])){
		$activity_id=$_GET['editid'];
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
		$query = "UPDATE `material` SET date='$date',item='$item',rate='$rate',quantity='$qty',amount='$amount',remarks='$remarks' where  user_id='$id' and activity_id='$activity_id'";
		if (mysqli_query($db,$query))

	{
		echo "<script>alert('successfully updated.')
				location.href ='edit_material.php?id='$activity_id';
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
	<button type="button" class="btn btn-primary" style="width:90px;height:5%;margin-top:7%;margin-left:2%;"><a href="view_departmental.php" style="color:black;text-decoration: none;">Go back</a></button>
	
	
	<div class="display4">
	<h1>&nbsp;&nbsp;&nbsp; Add Material Details</h1>
	<div class="input-group" style="padding:0px 30px;">
	
	<form method="post" action ="" style="position:fixed;margin-top:2px;margin-left:5px;border-radius:5px;">
	<!--Display from database-->
	<?php
	include('connection.php');
	$a_id=$_GET['editid'];
	$sql = "SELECT material.*,activity.* FROM material,activity WHERE activity.id=material.activity_id AND material.activity_id='$a_id'";
	$results = mysqli_query($db,$sql) or die("database error:".mysqli_error($db));
	while($row = mysqli_fetch_assoc($results)){?>
	
	<ul>
	<li><input type="date" name="date" value="<?php echo $row['date'];?>" class="form-control1"  required></li>
	<li><input type="text" name="item" value="<?php echo $row['item'];?>" class="form-control1" required></li>
	<li><input type="text" name="rate" value="<?php echo $row['rate'];?>" class="form-control1"></li>
	<li><input type="text" name="qty" value="<?php echo $row['quantity'];?>" class="form-control1"></li></br></br>
	<li><input type="text" name="amount" value="<?php echo $row['amount'];?>" class="form-control1"></li>
	&nbsp;&nbsp;&nbsp;
	<li><b>Remarks:</b>&nbsp;&nbsp;&nbsp;<input type="text"name="remarks" value="<?php echo $row['remarks'];?>" class="form-control1"></li></br>
	<input type="submit" name="update"  value="Update" class="form-control" style="cursor:pointer;background-color:#80aaff;border-radius:5px;width:60px;height:35px;margin-left:250px;">
	</form>
	
<!--table display-->
	<table align="center" border="2" cellspacing="0" cellpadding="0" style="width:70%;line-height:30px;margin-left:-70px;margin-top:5%;border-collapse:collapse;position:fixed;">
		<tr>
			<th>Activity Name </th>
			<th>Date</th>
			<th>Item</th>
			<th>Rate</th>
			<th>Quantity</th>
			<th>Amount</th>
			<th>Remarks</th>
			</tr>
			<tbody>
		
		<tr><td><?php echo $row['activity_name']?></td>
		<td><?php echo $row['date'];?></td>
		<td><?php echo $row['item'];?></td>
		<td><?php echo $row['rate'];?></td>
		<td><?php echo $row['quantity'];?></td>
		<td><?php echo $row['amount'];?></td>
		<td><?php echo $row['remarks'];?></td>
					
		</tr>	
		<?php }?>
	</tbody>
	</table>
</body>
</html>