
<?php
	include('connection.php');
	if(isset($_POST['update'])){
		$eid=$_GET['editid'];
		$activity_name = $_POST['activity_name'];
		$fy = $_POST['FY'];
		$mode = $_POST['mode'];
		$fund = $_POST['fund'];
		$approved_budget = $_POST['approved_budget'];
		$ts_amount = $_POST['ts_amount'];
		$ts_date = $_POST['ts_date'];
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
		$adms_date = $_POST['adms_date'];
		/*FILE UPLOADING*/
		$adms=$_FILES['adms']['name'];
		$tmp_name=$_FILES['adms']['tmp_name'];
		$path='upload/'.$adms;
		$ext1=explode(".",$adms);
		$cn=count($ext1);
		if($ext1[$cn-1]=="jpg" || "png" || "jpeg" || "pdf" || "wmv" || "pdf" || "zip" || "docx" || "xlsx")
		{
		$tmp_name=$_FILES['adms']['tmp_name'];
		move_uploaded_file($tmp_name,$path);
		}
	/*END OF FILE UPLOADING*/
		$nit_date = $_POST['nit_date'];
		/*FILE UPLOADING*/
		$nit=$_FILES['nit']['name'];
		$tmp_name=$_FILES['nit']['tmp_name'];
		$path='upload/'.$nit;
		$ext2=explode(".",$nit);
		$cn=count($ext2);
		if($ext2[$cn-1]=="jpg" || "png" || "jpeg" || "pdf" || "wmv" || "pdf" || "zip" || "docx" || "xlsx")
		{
		$tmp_name=$_FILES['nit']['tmp_name'];
		move_uploaded_file($tmp_name,$path);
		}
	/*END OF FILE UPLOADING*/
		$query = "UPDATE `activity` SET activity_name='$activity_name ',fy='$fy',mode_of_execution='$mode',fund='$fund',approved_budget='$approved_budget',ts_amount='$ts_amount',ts_date='$ts_date',technical_sanction='$file',adms_date='$adms_date',adms_fs='$adms',nit_date='$nit_date',nit='$nit',created_date='NOW()' WHERE id='$eid'";
		
		$run_update = mysqli_query($db,$query);
		echo "<script>alert('Data updated successfully!')
				location.href = 'manage_activity.php?attempt=success';
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
form ul { list-style-type: none; }

form ul li { display: inline-block;}
.display3 h1{
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
	include('connection.php');
    session_start();
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
	
	<?php 
			include('connection.php');
			$eid=$_GET['editid'];
			$cnt=1;
			$query = mysqli_query($db,"SELECT * FROM activity where id='$eid'");
			if($query-> num_rows > 0){
				while ($row = $query->fetch_assoc()){
	?>
		<form method="post" action="" style="position:fixed;margin-top:-2%;margin-left:4px;border-radius:5px;position:fixed;"  enctype="multipart/form-data">
			
			
			<ul>
			<li><input type="text"  name="activity_name" class="form-control1" value="<?php echo ($row["activity_name"]);?>" required></li>
			<li><select name="FY">
			<option value="Year">Select Financial Year</option>
			<option value="2020">2020-2021</option>
			<option value="2021">2021-2022</option>
			<option value="2022">2022-2023</option>
			</select></li>
			<li><input type="text" name="fund" class="form-control1" value="<?php echo ($row["fund"]);?>" required></li>
			</br></br>
			<li><select name="mode">
			<option value="">Select mode of execution</option>
			<option value="Contract">Contract</option>
			<option value="Departmental">Departmental</option>
			</select></li>
			<li><input type="text" name="approved_budget" class="form-control1" value="<?php echo ($row["approved_budget"]);?>" required></li>
			</br></br>
			<fieldset style="width:70%;">
			<legend><b>Technical Sanction</b></legend>
			<input type="text" name="ts_amount" class="form-control1"  value="<?php echo ($row["ts_amount"]);?>"  required>
			<b>Date:</b><input type="date" name="ts_date" class="form-control1"  value="<?php echo ($row["ts_date"]);?>"  required>
			<b>File:</b>
			<input type="file" name="file" class="form-control1" multiple required>
			</fieldset>
			
			<fieldset style="width:70%;">
			<legend><b>ADMS & FS</b></legend>
			<b>Date:&nbsp;</b><input type="date" name="adms_date" class="form-control1"  value="<?php echo ($row["adms_date"]);?>"  required>
			<b>File:</b>
			<input type="file" name="adms" class="form-control1">
			</fieldset>
			
			<fieldset style="width:70%;">
			<legend><b>NIT</b></legend>
			<b>Date</b>
			<input type="date" name="nit_date" class="form-control1" value="<?php echo ($row["nit_date"]);?>">
			<b>File:</b>
			<input type="file" name="nit" class="form-control1">
			</fieldset>
			<?php }}?>
			<input type="submit" name="update"  value="Update" class="form-control" style="background-color:#80aaff;border-radius:5px;width:70px;height:28px;margin-left:30%;margin-top:8px;cursor:pointer;">
		
			</ul>

		</form>	
	</div>
	<?php include "footer.php"?>
	</div>
</body>
</html>