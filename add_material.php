<?php
	session_start();
	include('connection.php');
	if(isset($_POST['add'])){
		$activity_id=$_GET['id'];
		$date = $_POST['date'];
		$item = $_POST['item'];
		$rate = $_POST['rate'];
		$qty = $_POST['qty'];
		$amount = $rate*$qty;
		$remarks = $_POST['remarks'];

		/*To fetch user_id*/
		$user=$_SESSION['username'];
		$query1=mysqli_query($db,"SELECT * FROM users where username='$user' ");
		$row=mysqli_fetch_array($query1);
		$id=$row['id'];
		$query = "INSERT INTO material(date,item,rate,quantity,amount,remarks,user_id,activity_id) VALUES 
		('$date','$item','$rate','$qty','$amount','$remarks','$id','$activity_id')";
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
	<a href="index.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
	<a href="add_activity.php"><i class="fa fa-plus-circle"></i><span>Add activity</span></a>
	<a href="manage_activity.php"><i class="fas fa-table"></i><span>Manage Activity</span></a>
	<a href="show_activity.php"><i class="fas fa-th"></i><span>Show Activity Details</span></a>
	<a href="view_contract_details.php"><i class="fa fa-eye"></i><span>View Contract Details</span></a>
	</div>
<!-- Side bar end -->

	<div class="content">
	<button type="button" class="btn btn-primary" style="width:90px;height:5%;margin-top:7%;margin-left:2%;"><a href="view_departmental.php" style="color:black;text-decoration: none;">Go back</a></button>
	<div class="display4">
	<h1>&nbsp;&nbsp;&nbsp; Add Material Details</h1>
	<div class="input-group" style="padding:0px 30px;">
	<form method="post" action ="" style="position:absolute;margin-top:5px;margin-left:5px;border-radius:5px;">
	
	<ul>
	<li><input type="date" name="date" class="form-control1" placeholder="Date" required></li>
	<li><input type="text" name="item" class="form-control1" placeholder="Item" required></li>
	<li><input type="text" name="rate" class="form-control1"placeholder="Rate"  ></li>
	<li><input type="text" name="qty" class="form-control1"placeholder="Quantity"  ></li></br></br>
	<li><input type="text" name="amount"class="form-control1" placeholder="Amount"  readonly></li>
	&nbsp;&nbsp;&nbsp;
	<li><b>Remarks:</b>&nbsp;&nbsp;&nbsp;<textarea name="remarks"  ></textarea></li></br>
	<input type="submit" name="add"  value="Add" class="form-control" style="cursor:pointer;background-color:#80aaff;border-radius:5px;width:50px;height:35px;margin-left:250px;">
	</form>
	<!--Display from database-->
	<?php
			include('connection.php');
			$a_id=$_GET['id'];
			$query="SELECT SUM(amount) as sum from material,activity where material.activity_id=activity.id and activity_id='$a_id'";
			$query_result = mysqli_query($db,$query) or die("database error:".mysqli_error($db));
			while($row = mysqli_fetch_assoc($query_result)){
				$output=$row['sum'];
				}
			$sql = "SELECT material.*,activity.activity_name FROM material,activity WHERE activity.id=material.activity_id AND material.activity_id='$a_id'";
			$results = mysqli_query($db,$sql) or die("database error:".mysqli_error($db));
			?>
<!--table display-->
	<table align="center" border="2" cellspacing="0" cellpadding="0" style="width:110%;line-height:30px;margin-left:-70px;margin-top:5%;border-collapse:collapse;position:absolute;">
		<tr>
			<th>Activity Name </th>
			<th>Date</th>
			<th>Item</th>
			<th>Rate</th>
			<th>Quantity</th>
			<th>Amount</th>
			<th>Remarks</th>
			<!--<th>Edit</th>
			<th>Delete</th>-->
			</tr>
			<tbody>
		<?php while($row = mysqli_fetch_assoc($results)){?>
		<tr><td><?php echo $row['activity_name']?></td>
		<td><?php echo $row['date'];?></td>
		<td><?php echo $row['item'];?></td>
		<td><?php echo $row['rate'];?></td>
		<td><?php echo $row['quantity'];?></td>
		<td><?php echo $row['amount'];?></td>
		<td><?php echo $row['remarks'];?></td>
		<!--<td><a href="edit_material.php?editid=<?php echo htmlentities ($a_id)?>"><img src="images/edit.png" width="25px" style="padding-left:8px" title="Edit"></a>
		<td><a href="delete_material.php?deleteid=<?php echo htmlentities ($row['id']);?>"><img src="images/delete.png" width="30px" style="padding-left:10px" title="Delete"></a></td>
		--></tr>
		<?php }?>
		<tr>
		<td><b>Total</b></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td><b><?php echo $output;?></b></td>
		</tr>		
	</tbody>
	</table>
	<?php include "footer.php"?>
</body>
</html>