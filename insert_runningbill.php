<?php
	session_start();
	include('connection.php');
if(isset($_POST['add'])){
$eid=$_GET['editid'];
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
$query = "INSERT INTO running_bill(running_bill,date,amount,tds,retention_money,mobilization_advance,material_advance,liquidity_damage,	Net_payable,user_id,contract_details_id) VALUES 
('$running_bill','$date','$amount','$tds','$retention_money','$mobilization_advance','$material_advance','$ld','$net_payable','$id','$eid')";


if (mysqli_query($db,$query))

	{
		echo "<script>alert('successfully added.')
				location.href = 'running_bill.php?attempt=success';
				</script>";
	}
	else
	{
		echo "Error adding data in database<br />";
	}
}