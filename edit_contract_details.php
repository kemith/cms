
<?php
	session_start();
	include('connection.php');
	if(isset($_POST['update'])){
		$eid=$_GET['editid'];
		$firm_name = $_POST['firm_name'];
		$contact_no = $_POST['contact_no'];
		$email = $_POST['email'];
		$contract_amount = $_POST['contract_amount'];
		$loi_date = $_POST['loi_date'];
		/*FILE UPLOADING*/
		$loi=$_FILES['loi']['name'];
		$tmp_name=$_FILES['loi']['tmp_name'];
		$path='upload/'.$loi;
		$ext2=explode(".",$loi);
		$cn=count($ext2);
		if($ext2[$cn-1]=="jpg" || "png" || "jpeg" || "pdf" || "wmv" || "pdf" || "zip" || "docx" || "xlsx")
		{
		$tmp_name=$_FILES['loi']['tmp_name'];
		move_uploaded_file($tmp_name,$path);
		}
		/*END OF FILE UPLOADING*/
		$loa_date = $_POST['loa_date'];
		/*FILE UPLOADING*/
		$loa=$_FILES['loa']['name'];
		$tmp_name=$_FILES['loa']['tmp_name'];
		$path='upload/'.$loa;
		$ext3=explode(".",$loa);
		$cn=count($ext3);
		if($ext3[$cn-1]=="jpg" || "png" || "jpeg" || "pdf" || "wmv" || "pdf" || "zip" || "docx" || "xlsx")
		{
		$tmp_name=$_FILES['loa']['tmp_name'];
		move_uploaded_file($tmp_name,$path);
		}
		/*END OF FILE UPLOADING*/
		$work_order_date = $_POST['work_order_date'];
	/*FILE UPLOADING*/
		$file=$_FILES['file']['name'];
		$tmp_name=$_FILES['file']['tmp_name'];
		$path='upload/'.$file;
		$ext=explode(".",$file);
		$cn=count($ext);
		if($ext[$cn-1]=="jpg" || "png" || "jpeg" || "pdf" || "wmv" || "pdf" || "zip" || "docx" || "xlsx")
		{
		$tmp_name=$_FILES['file']['tmp_name'];
		move_uploaded_file($tmp_name,$path);
		}
		/*END OF FILE UPLOADING*/
		$s_date = $_POST['s_date'];
		$e_date = $_POST['e_date'];
		$duration = $_POST['duration'];
		
		/*FILE UPLOADING*/
		$t_extension = $_FILES['t_extension']['name'];
		$tmp_name=$_FILES['t_extension']['tmp_name'];
		$path='upload/'.$t_extension;
		$ext1=explode(".",$t_extension);
		$cn=count($ext1);
		if($ext1[$cn-1]=="jpg" || "png" || "jpeg" || "pdf" || "wmv" || "pdf" || "zip" || "docx" || "xlsx")
		{
		$tmp_name=$_FILES['t_extension']['tmp_name'];
		move_uploaded_file($tmp_name,$path);
		}
		/*END OF FILE UPLOADING*/
		/*To fetch user_id*/
		$user=$_SESSION['username'];
		$query1=mysqli_query($db,"SELECT * FROM users where username='$user'");
		$row=mysqli_fetch_array($query1);
		$id=$row['id'];
	/*To fetch user_id*/
		$query = "UPDATE `contract_details` SET firm_name='$firm_name',contact_no='$contact_no',email_id='$email',contract_amount='$contract_amount',loi_date='$loi_date',loi='$loi',loa_date='$loa_date',loa='$loa',work_order_date='$work_order_date',work_order='$file',start_date='$s_date',end_date='$e_date',contract_duration='$duration',time_extension='$t_extension' WHERE activity_id='$eid'";	
		$run_update = mysqli_query($db,$query);
		/*echo "Contract deatails updated successfully!";*/
		echo "<script>alert('successfully updated.')
				location.href = 'view_contract_details.php?editid=$eid';
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
	<div class="display3">
	<h1>&nbsp;&nbsp; &nbsp; &nbsp; Edit Contract Details</h1>
	<div class="input-group" style="padding:8px 30px;">
	<?php 
			include('connection.php');
			$eid=$_GET['editid'];
			$cnt=1;
			$query = mysqli_query($db,"SELECT * FROM contract_details where activity_id='$eid'");
			if($query-> num_rows > 0){
				while ($row = $query->fetch_assoc()){
					?>
	<form method="post" action ="" enctype="multipart/form-data">
	<label>Name of Firm</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="text" name="firm_name" value="<?php echo ($row["firm_name"]);?>"class="form-control1" required>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<label>Contact Number</label>
	<input type="text" name="contact_no" value="<?php echo ($row["contact_no"]);?>"class="form-control1" required>
	<br/><br/>
	<label>Email ID</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="email" name="email" value="<?php echo ($row["email_id"]);?>"class="form-control1" required>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<label>Contract Amount</label>
	<input type="text" name="contract_amount" value="<?php echo ($row["contract_amount"]);?>"class="form-control1" required>
	</br></br>
	<label>LoI Date</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="date" name="loi_date" value="<?php echo ($row["loi_date"]);?>" required>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
	<label>Letter of Intent</label>&nbsp;&nbsp;
	<input type="file" name="loi" required>
	</br></br>
	<label>LoA Date</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="date" name="loa_date" value="<?php echo ($row["loa_date"]);?>" required>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<label>Letter of Acceptance</label>&nbsp;&nbsp;&nbsp;
	<input type="file" name="loa"  required></br>
	</br>
	<label>Work Order Datet</label>&nbsp;&nbsp;&nbsp;
	<input type="date" name="work_order_date" value="<?php echo ($row["work_order_date"]);?>" required>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<label>Work Order</label>&nbsp;&nbsp;&nbsp;
	<input type="file" name="file" class="form-control1" required>
	</br>
	<label>Start Date </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="date" name="s_date" value="<?php echo ($row["start_date"]);?>"class="form-control1" required>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<label>End Date </label>&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="date" name="e_date" value="<?php echo ($row["end_date"]);?>"class="form-control1" required>
    <br/><br/>
	<label>Contract Duration</label>
	<input type="text" name="duration" class="form-control1" value="<?php echo ($row["contract_duration"]);?>"required>
	<label> Time Extension</label>
	<input type="file" name="t_extension" class="form-control1" multiple >
	 </br></br>
	 <?php }}?>
	<input type="submit" name="update"  value="Update" class="form-control" style="background-color:#80aaff;border-radius:5px;width:60px;height:30px;margin-left:250px;cursor:pointer;">
	</form>
	</div>
	</div>
	</div>
</body>
</html>