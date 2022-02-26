
<?php
session_start();
include("connection.php");


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
	<label for="check">
	<i class="fas fa-bars" id="sidebar_btn"></i>
	</label>
	<div class="left_area">
		<h3>&nbsp;&nbsp;Wel<span>come</span></h3>
	</div>
	<div class="right_area">
	<a href="login.php" class="logout_btn">Logout</a>
	
</header>

<!-- Side bar start -->
 
	<div class="sidebar">
	<center>
	<img src="images/profile.jpg" class="profile_image" alt="">
	<h4><?php 
	          echo $_SESSION['username'];
		?>	  
	</h4>
	</center>
	<a href="index.php"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
	<a href="remarks.php"><i class="fas fa-th"></i><span>Add Remarks</span></a>
	</div>
<!-- Side bar end -->
    
	<div class="content" >
	<div class="display5">
	<?php
	 if(isset($_POST['submit'])) {
		//Get values from form in remarks.php file
		$activity_id =$_GET['activityid'];
	    $remarks = $_POST['remarks'];
		$remarks= mysqli_real_escape_string($db,$remarks);
		$query 	= mysqli_query($db,"INSERT INTO remarks(remarks,activity_id) VALUES('$remarks','$activity_id')");
		if($query){
		header("Location:displayremarks.php");}
	 }
	  
	?>
	 <form action="" method="post">
	   <div class="form-group">
		<label>&nbsp; Remarks</label><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <textarea type="text" id="remarks" name="remarks" class="form-control" rows="10" cols="100" style="margin:10px; padding:5px;"></textarea><br>
	    <input type="submit" name="submit" id="submit" value="add" class="input-group" style="margin:1px; padding:5px;color:blue;width:100px;margin-left:50px;">
		</div>
	 </form> 
	 </div>
	 <?php include "footer.php"?>
   </div>
</body>
</html>