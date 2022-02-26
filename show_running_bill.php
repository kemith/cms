<?php
session_start();
include('connection.php');
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
	</div>	</div>
<!-- Side bar end -->

	<div class="content">

	<!--Display from database-->
	<?php
include('connection.php');
$eid=$_GET['id'];
$sql = "SELECT running_bill.*,contract_details.* FROM running_bill,contract_details where running_bill.contract_details_id=contract_details.id and contract_details.activity_id='$eid'";
$results = mysqli_query($db,$sql) or die("database error:".mysqli_error($db));
?>
<!--table display-->
<button type="button" class="btn btn-primary" style="width:90px;height:5%;margin-top:7%;margin-left:2%;"><a href="view_contract.php" style="color:black;text-decoration: none;">Go back</a></button>

		<?php
		if($results-> num_rows > 0){
		?>
			
		<table align="center" border="2" cellspacing="0" cellpadding="0" style="width:80%;line-height:30px;margin-left:15px;margin-top:2%;border-collapse:collapse;position:fixed;">
		<tr>
			<th rowspan="2">Running Account Bill </th>
			<th rowspan="2">&nbsp;&nbsp;&nbsp;Date&nbsp;&nbsp;&nbsp;</th>
			<th rowspan="2">Amount</th>
			<th colspan="5">Deduction</th>
			<th rowspan="2">Net Payable</th>
			<th rowspan="2">Edit</th>
			<th rowspan="2">Delete</th></tr>
			<tr>
			<th>2% TDS</th>
			<th>10% Retention Money</th>
			<th>Mobilization Advance</th>
			<th>Material Advance</th>
			<th>Liquidity Damages</th>
			</tr>
			<tbody>
			<?php
		while($row = mysqli_fetch_assoc($results)){?>
		<tr><td><?php echo $row['running_bill']?></td>
		<td><?php echo $row['date'];?></td>
		<td><?php echo $row['amount'];?></td>
		<td><?php echo $row['tds'];?></td>
		<td><?php echo $row['retention_money'];?></td>
		<td><?php echo $row['mobilization_advance'];?></td>
		<td><?php echo $row['material_advance'];?></td>
		<td><?php echo $row['liquidity_damage'];?></td>
		<td><?php echo $row['Net_payable'];?></td>
		<td><a href="edit_runningbill.php?id=<?php echo htmlentities ($eid);?>"><img src="images/edit.png" width="25px" style="padding-left:8px" title="Edit"></a>
		<td><a href="delete_runningbill.php?deleteid=<?php echo htmlentities ($row['id']);?>"><img src="images/delete.png" width="30px" style="padding-left:10px" title="Delete"></a></td>
					
		</tr>	
		<?php 
		}
		}
				
		else{?>
			<button type="button" class="btn btn-primary" style="width:90px;height:5%;margin-top:7%;margin-left:2%;">
			<a href="running_bill.php?id=<?php echo htmlentities ($eid)?>" style="color:black;text-decoration: none;">Add</a></button>
		<?php }?>
	</tbody>
			</table>
</body>
</html>