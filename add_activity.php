<?php
	session_start();
	include('connection.php');
	if(isset($_POST['add'])){
		$activity_name = $_POST['activity_name'];
		$fy = $_POST['FY'];
		$fund = $_POST['fund'];
		$mode = $_POST['mode'];
		$approved_budget = $_POST['approved_budget'];
		$ts_amount = $_POST['ts_amount'];
		$ts_date = $_POST['ts_date'];
	/*FILE UPLOADING*/
		$file=$_FILES['file']['name'];
		$tmp_name=$_FILES['file']['tmp_name'];
		$path='upload/'.$file;
		$ext1=explode(".",$file);
		$cn=count($ext1);
		if($ext1[$cn-1]=="jpg" || "png" || "jpeg" || "pdf" || "wmv" || "pdf" || "zip" || "docx" || "xlsx")
		{
		$tmp_name=$_FILES['file']['tmp_name'];
		move_uploaded_file($tmp_name,$path);
		}
		$adms_date = $_POST['adms_date'];
	/*FILE UPLOADING*/
		$adms = $_FILES['adms']['name'];
		$tmp_name=$_FILES['adms']['tmp_name'];
		$path='upload/'.$adms;
		$ext2=explode(".",$adms);
		$cn=count($ext2);
		if($ext2[$cn-1]=="jpg" || "png" || "jpeg" || "pdf" || "wmv" || "pdf" || "zip" || "docx" || "xlsx")
		{
		$tmp_name=$_FILES['adms']['tmp_name'];
		move_uploaded_file($tmp_name,$path);
		}
		$nit_date = $_POST['nit_date'];
	/*FILE UPLOADING*/
		$nit=$_FILES['nit']['name'];
		$tmp_name=$_FILES['nit']['tmp_name'];
		$path='upload/'.$nit;
		$ext3=explode(".",$nit);
		$cn=count($ext3);
		if($ext3[$cn-1]=="jpg" || "png" || "jpeg" || "pdf" || "wmv" || "pdf" || "zip" || "docx" || "xlsx")
		{
		$tmp_name=$_FILES['nit']['tmp_name'];
		move_uploaded_file($tmp_name,$path);
		}
		
	/*END OF FILE UPLOADING*/
	/*To fetch user_id*/
		$user=$_SESSION['username'];
		$query1=mysqli_query($db,"SELECT * FROM users where username='$user' ");
		$row=mysqli_fetch_array($query1);
		$id=$row['id'];
	/*end fetch user_id*/
		$query = "INSERT INTO activity(activity_name,fy,mode_of_execution,fund,approved_budget,ts_amount,ts_date,technical_sanction,adms_date,adms_fs,nit_date,nit,created_date,user_id) VALUES 
		('$activity_name','$fy','$mode','$fund','$approved_budget','$ts_amount','$ts_date','$file','$adms_date','$adms','$nit_date','$nit',NOW(),'$id')";
		
		$run_insert = mysqli_query($db,$query);
		if($run_insert){
		echo "<script>alert('successfully inserted.')
				location.href = 'manage_activity.php?attempt=success';
				</script>";
		}
		else{
			echo "<script>alert('sorry.Error occurred!!!');</script>";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Dashboard</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
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
.display5 h1{
	font-family:Sans-serif;
	color:  #03c4ff;
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
	<a href="login.php" class="logout_btn">Logout</a></div>
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
	<div class="display5" style="border:2px none;
	background-color:#fff;
	background-repeat:no-repeat;
	border-radius:20px;
    width:50%;
	height:80%;
	margin-left:15%;
	margin-top:8%;
	position:fixed;">
	<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Add Activity</h1>
	
		<form method="post" action="" style="position:fixed;margin-top:-2%;margin-left:4px;border-radius:5px;position:fixed;"  enctype="multipart/form-data">
			
			
			<ul>
			<li><input type="text"  name="activity_name" class="form-control1" placeholder="Name of Work" required></li>
			<li><select name="FY">
			<option value="Year">Select Financial Year</option>
			<option value="2019">2020-2021</option>
			<option value="2020">2021-2022</option>
			<option value="2021">2022-2023</option>
			</select></li>
			<li><input type="text" name="fund" class="form-control1" placeholder="Source of Fund" required></li>
			</br></br>
			<li><select name="mode">
			<option value="">Select mode of execution</option>
			<option value="Contract">Contract</option>
			<option value="Departmental">Departmental</option>
			</select></li>
			<li><input type="text" name="approved_budget" class="form-control1" placeholder="Approved Budget " required></li>
			</br></br>
			<fieldset style="width:70%;">
			<legend><b>Technical Sanction</b></legend>
			<input type="text" name="ts_amount" class="form-control1"  placeholder="Technical Sanction Amount"  required>
			<b>Date:</b><input type="date" name="ts_date" class="form-control1"  placeholder="Technical Sanction date"  required>
			<b>File:</b>
			<input type="file" name="file" class="form-control1" multiple required>
			</fieldset>
			
			<fieldset style="width:70%;">
			<legend><b>ADMS & FS</b></legend>
			<b>Date:&nbsp;</b><input type="date" name="adms_date" class="form-control1">
			<b>File:</b>
			<input type="file" name="adms" class="form-control1">
			</fieldset>
			
			<fieldset style="width:70%;">
			<legend><b>NIT</b></legend>
			<b>Date</b>
			<input type="date" name="nit_date" class="form-control1" >
			<b>File:</b>
			<input type="file" name="nit" class="form-control1">
			</fieldset>
			<input type="submit" name="add"  value="Add" class="form-control" style="background-color:#80aaff;border-radius:5px;width:70px;height:28px;margin-left:30%;margin-top:8px;cursor:pointer;">
		
			</ul>

		</form>	
	</div>
	<?php include "footer.php"?>
	</div>
	
</body>
</html>