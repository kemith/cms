
<?php
	session_start();
	include('connection.php');
	if(isset($_POST['add'])){
		$activity_id=$_GET['editid'];
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
		
	
		$query = "INSERT INTO contract_details (firm_name,contact_no,email_id,contract_amount,loi_date,loi,loa_date,loa,work_order_date,work_order,start_date,end_date,contract_duration,	time_extension,user_id,activity_id,created_date) VALUES 
		('$firm_name','$contact_no','$email','$contract_amount','$loi_date','$loi','$loa_date','$loa','$work_order_date','$file','$s_date','$e_date','$duration','$t_extension','$id','$activity_id',NOW())";
		
		$run_query = mysqli_query($db,$query);
				echo "<script>alert('successfully inserted.')
				location.href = 'view_contract_details.php?editid=$activity_id';
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
	<a href="show_activity.php"><i class="fas fa-th"></i><span>Show Activity Details</span></a>
	</div>
<!-- Side bar end -->

	<div class="content">
	<div class="display3">
	<h1>&nbsp;&nbsp; &nbsp; &nbsp; Add Contract Details</h1>
	<div class="input-group" style="padding:0px 30px;">
	<form method="post" action ="" enctype="multipart/form-data">
	<label>Name of Firm</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="text" name="firm_name" class="form-control1" required>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <label>Contact Number</label>
	<input type="text" name="contact_no" class="form-control1" required>
	<br/><br/>
	<label>Email ID</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="email" name="email" class="form-control1" required>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Contract Amount</label>
	<input type="text" name="contract_amount" class="form-control1" required>
	<br/><br/>
	<label>LoI Date</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="date" name="loi_date"  required>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Letter of Intent</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="file" name="loi"  required>
	</br></br>
	<label>LoA Date</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="date" name="loa_date"  required>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Letter of Acceptance</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="file" name="loa"  required>
	<br/></br>
	<label>Work Order Date</label>&nbsp;&nbsp;
	<input type="date" name="work_order_date"  required>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Work Order</label>
	<input type="file" name="file" class="form-control1" required>
	<br/>
	<label>Start Date </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="date" name="s_date" class="form-control1" required>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>End Date </label>
	<input type="date" name="e_date" class="form-control1" required>
    <br/><br/>
	<label>Contract Duration</label>
	<input type="text" name="duration" class="form-control1" required>
    <label> Time Extension</label>
	<input type="file" name="t_extension" class="form-control1" multiple >
	 <br/></br>
	<input type="submit" name="add"  value="Add" class="form-control" style="background-color:#80aaff;border-radius:5px;width:80px;height:30px;margin-left:250px;cursor:pointer;">
	</form>
	</div>
	</div>
	<?php include "footer.php"?>
	</div>
</body>
</html>