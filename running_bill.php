
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
	$net_payable = $amount-($tds+$retention_money+$mobilization_advance+$material_advance+$ld);
/*To fetch user_id*/
		$user=$_SESSION['username'];
		$query1=mysqli_query($db,"SELECT * FROM users where username='$user'");
		$row=mysqli_fetch_array($query1);
		$id=$row['id'];
/*To fetch contract_details_id*/
		$query2=mysqli_query($db,"SELECT * FROM contract_details where user_id='$id' and activity_id='$eid'");
		$row=mysqli_fetch_array($query2);
		$id1=$row['id'];
$query = "INSERT INTO running_bill(running_bill,date,amount,tds,retention_money,mobilization_advance,material_advance,liquidity_damage,	Net_payable,user_id,contract_details_id) VALUES 
('$running_bill','$date','$amount','$tds','$retention_money','$mobilization_advance','$material_advance','$ld','$net_payable','$id','$id1')";


if (mysqli_query($db,$query))

	{
		echo "<script>
				location.href =''show_running_bill.php?id=$eid';
			</script>";
	}
	else
	{
		echo "Error adding data in database<br/>";
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
	<a href="dashboard.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
	<a href="add_activity.php"><i class="fa fa-plus-circle"></i><span>Add activity</span></a>
	<a href="manage_activity.php"><i class="fas fa-table"></i><span>Manage Activity</span></a>
	<a href="#"><i class="fas fa-th"></i><span>Show Activity Details</span></a>
	</div>
<!-- Side bar end -->

	<div class="content">
	<button type="button" class="btn btn-primary" style="width:90px;height:5%;margin-top:7%;margin-left:2%;"><a href="view_contract.php" style="color:black;text-decoration: none;">Go back</a></button>
	<div class="input-field">
	<div class="display5" style="border:2px none;
	background-color:#ccc;
	border-radius:20px;
    width:70%;
	height:22%;
	margin-left:5%;
	margin-top:2%;
	position:fixed;">

		<form method="post" action="" style="position:fixed;margin-top:5px;margin-left:10px;border-radius:5px;">
			<?php 
			include('connection.php');
			$cd_id=$_GET['id'];
			$cnt=1;
			$query=mysqli_query($db,"select activity.activity_name from activity,contract_details where activity.id=contract_details.activity_id and contract_details.activity_id='$cd_id'");
			/*$query = mysqli_query($db,"SELECT * FROM contract_details where id='$cd_id' ");*/
			if($query-> num_rows > 0){
				while ($row = $query->fetch_assoc()){
			?>
			<ul>
			<li><input type="text" name="activity_name"  class="form-control1" value="<?php echo ($row["activity_name"]);?>" required disabled></li>
			<li><input type="text" name="running_bill"  class="form-control1" placeholder="running_bill" required></li>
			<li><input type="date" name="date"  class="form-control1" required></li>
			<li><input type="text" name="amount"  class="form-control1" placeholder="amount"  required></li>
			<li><input type="text" name="tds"   class="form-control1" placeholder="tds" required></li>
			<li><input type="text" name="retention_money" class="form-control1"  placeholder="retention money"  required></li>
			<li><input type="text" name="mobilization_advance"  class="form-control1"  placeholder="mobilization advance deduction" required></li>
			<li><input type="text" name="material_advance"  class="form-control1" placeholder="material advance deduction"  required></li>
			<li><input type="text" name="ld"  class="form-control1"  placeholder="liquidity damage" required></li>
			<li><input type="text" name="net_payable" class="form-control1"  placeholder="net payable" required readonly></li>
			&nbsp;&nbsp;&nbsp;
			<?php }}?>
			<li><input type="submit" name="add"  value="Add" class="form-control" style="background-color:#80aaff;border-radius:5px;width:70px;height:28px;margin-left:80px;margin-top:8px;cursor:pointer;"></li>

			</ul>

		</form>	
	</div></div>
	<!--Display from database-->
		<?php
			include('connection.php');
			$eid=$_GET['id'];
			$query="SELECT SUM(amount) as sum from running_bill,contract_details where running_bill.contract_details_id=contract_details.id and contract_details.activity_id='$eid'";
			$query_result = mysqli_query($db,$query) or die("database error:".mysqli_error($db));
			while($row = mysqli_fetch_assoc($query_result)){
				$output=$row['sum'];
			
			}
			$query1="SELECT SUM(tds) as sum from running_bill,contract_details where running_bill.contract_details_id=contract_details.id and contract_details.activity_id='$eid'";
			$query_result1 = mysqli_query($db,$query1) or die("database error:".mysqli_error($db));
			while($row = mysqli_fetch_assoc($query_result1)){
				$output1=$row['sum'];
			
			}
			$query2="SELECT SUM(retention_money) as sum from running_bill,contract_details where running_bill.contract_details_id=contract_details.id and contract_details.activity_id='$eid'";
			$query_result2 = mysqli_query($db,$query2) or die("database error:".mysqli_error($db));
			while($row = mysqli_fetch_assoc($query_result2)){
				$output2=$row['sum'];
			
			}
			$query3="SELECT SUM(mobilization_advance) as sum from running_bill,contract_details where running_bill.contract_details_id=contract_details.id and contract_details.activity_id='$eid'";
			$query_result3 = mysqli_query($db,$query3) or die("database error:".mysqli_error($db));
			while($row = mysqli_fetch_assoc($query_result3)){
				$output3=$row['sum'];
			
			}
			$query4="SELECT SUM(material_advance) as sum from running_bill,contract_details where running_bill.contract_details_id=contract_details.id and contract_details.activity_id='$eid'";
			$query_result4 = mysqli_query($db,$query4) or die("database error:".mysqli_error($db));
			while($row = mysqli_fetch_assoc($query_result4)){
				$output4=$row['sum'];
			
			}
			$query5="SELECT SUM(liquidity_damage) as sum from running_bill,contract_details where running_bill.contract_details_id=contract_details.id and contract_details.activity_id='$eid'";
			$query_result5 = mysqli_query($db,$query5) or die("database error:".mysqli_error($db));
			while($row = mysqli_fetch_assoc($query_result5)){
				$output5=$row['sum'];
			
			}
			$query6="SELECT SUM(Net_payable) as sum from running_bill,contract_details where running_bill.contract_details_id=contract_details.id and contract_details.activity_id='$eid'";
			$query_result6 = mysqli_query($db,$query6) or die("database error:".mysqli_error($db));
			while($row = mysqli_fetch_assoc($query_result6)){
				$output6=$row['sum'];
			
			}
			$sql ="SELECT running_bill.*,contract_details.* FROM running_bill,contract_details where running_bill.contract_details_id=contract_details.id and contract_details.activity_id='$eid'";
			$results = mysqli_query($db,$sql) or die("database error:".mysqli_error($db));

?>
<!--table display-->

		<?php
		if($results-> num_rows > 0){
		?>
	
		<table align="center" border="2" cellspacing="0" cellpadding="0" style="width:80%;line-height:30px;margin-left:15px;margin-top:15%;border-collapse:collapse;position:absolute;">
		<tr>
			<th rowspan="2">Running Account Bill </th>
			<th rowspan="2">&nbsp;&nbsp;&nbsp;Date&nbsp;&nbsp;&nbsp;</th>
			<th rowspan="2">Amount</th>
			<th colspan="5">Deduction</th>
			<th rowspan="2">Net Payable</th>
			</tr>
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
		<!--<td><a href="edit_runningbill.php?id=<?php echo htmlentities ($row['id']);?>"><img src="images/edit.png" width="25px" style="padding-left:8px" title="Edit"></a>-->
			</tr>	
		<?php 
		}
		?>
		<tr><td><b>Total</b></td>
		<td></td>
		<td><b><?php echo $output;?></b></td>
		<td><b><?php echo $output1;?></b></td>
		<td><b><?php echo $output2;?></b></td>
		<td><b><?php echo $output3;?></b></td>
		<td><b><?php echo $output4;?></b></td>
		<td><b><?php echo $output5;?></b></td>
		<td><b><?php echo $output6;?></b></td>
		</tr>
		</tbody>
		</table>
		
		<div class="pagination" style="margin-left:5%;margin-top:37%;position:fixed;">
		<?php
		for($page=1;$page<=$number_of_pages;$page++){
			echo '<a href="running_bill.php?page=' .$page . '" style="background-color:#f44336;display:inline-block;padding:10px 10px;">'.$page. '</a>';
		}
	 }
	?>
	</div>
	<?php include "footer.php"?>
	</div>
</body>
</html>