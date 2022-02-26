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
 .popup .overlay {
  position:fixed;
  top:0px;
  left:0px;
  width:100vw;
  height:100vh;
  background:rgba(0,0,0,0.7);
  z-index:1;
  display:none;
}
 
.popup .content {
  background-image:url('../images/logo1.png');
  position:absolute;
  top:50%;
  left:30%;
  transform:translate(-50%,-50%) scale(0);
  background:#fff;
  width:95%;
  max-width:500px;
  height:270px;
  z-index:2;
  text-align:center;
 
  box-sizing:border-box;
  font-family:"Open Sans",sans-serif;
}
 
.popup .close-btn {
  cursor:pointer;
  position:absolute;
  right:20px;
  top:20px;
  width:30px;
  height:30px;
  background:#222;
  color:#fff;
  font-size:25px;
  font-weight:600;
  line-height:30px;
  text-align:center;
  border-radius:50%;
}
 
.popup.active .overlay {
  display:block;
}
 
.popup.active .content {
  transition:all 300ms ease-in-out;
  transform:translate(-50%,-50%) scale(1);
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
	<div class="popup" id="popup-1">
  <div class="overlay"></div>
  <div class="content">
    <div class="close-btn" onclick="togglePopup()">×</div>
    <h2>Add Details</h2>
    <form method="post" action ="" enctype="multipart/form-data">
	
	<input type="date" name="date"  placeholder="Date" required>
	</br>
	<input type="text" name="item" placeholder="Item" required>
	
	 </br>
	<input type="text" name="rate" placeholder="Rate"  >

	</br>
	<input type="text" name="qty" placeholder="Quantity"  >
	</br>
	<input type="text" name="amount" placeholder="Amount"  >
	</br>
	<input type="text" name="remarks" placeholder="Remarks"  >
	</br></br>
	<input type="submit" name="add"  value="Add" class="form-control" style="cursor:pointer;background-color:#80aaff;border-radius:5px;width:50px;height:30px;margin-left:30px;">
	</form>
  </div>
</div>

<div class="popup" id="popup-2">
  <div class="overlay"></div>
  <div class="content">
    <div class="close-btn" onclick="togglePopup1()">×</div>
    <h2>Add Details</h2>
     <form method="post" action ="add_masteroll.php" enctype="multipart/form-data">
	
	<input type="date" name="date"  placeholder="Date" required>
	</br>
	<input type="text" name="no_of_labours" placeholder="No of Labours" required>
	 </br>
	<input type="text" name="rate" placeholder="Rate"  >
	</br>
	<input type="text" name="amount" placeholder="Amount"  >
	</br>
	<input type="text" name="remarks" placeholder="Remarks"  >
	</br></br>
	<input type="submit" name="add"  value="Add" class="form-control" style="cursor:pointer;background-color:#80aaff;border-radius:5px;width:50px;height:30px;margin-left:30px;">
	</form>
  </div>
</div>
 

	<table align="center" border="2" style="width:40%;line-height:30px;margin-left:40px;margin-top:80px;border-collapse:collapse;position:fixed;">
		<tr>
			<th>Activity Name</th>
			<th colspan="2">Select Type</th>
			
			</tr>
			<tr>
			<?php 
			include('connection.php');
			$activity_id=$_GET['id'];
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
					<!--<select>
					<option value="">Select</option>
					<option value="a">Material</option>
					<option value="b">Masterall</option></select>-->
					<button onclick="togglePopup()" style="cursor:pointer;">Material</button></td>
					<td><button onclick="togglePopup1()" style="cursor:pointer;">Masterall</button></td>
						</tr>
					<?php
				
				$cnt=$cnt+1;
				}
					
			}
			
		?>
</table>
<script>
function togglePopup(){
  document.getElementById("popup-1").classList.toggle("active");
}
function togglePopup1(){
	document.getElementById("popup-2").classList.toggle("active");
}
</script>
</div>
</body>
</html>
