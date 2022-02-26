<?php
session_start();
include('connection.php');

/*$sql = "SELECT A.id as AID,A.activity_name,A.approved_budget,A.created_date,C.firm_name,C.contract_amount,C.contract_duration,C.Loi,C.Loa,C.work_order,C.start_date,C.end_date,U.username,R.remarks FROM activity A,contract_details C,users U,remarks R
	    WHERE A.id = C.activity_id AND U.id = A.user_id AND R.activity_id = A.id";*/
$sql = "SELECT A.id as AID,A.activity_name,A.mode_of_execution,A.approved_budget,U.username,R.remarks FROM activity A,users U,remarks R
	    WHERE U.id = A.user_id AND R.activity_id = A.id";
$result = mysqli_query($db,$sql);

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
	</div>
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
	<a href="#"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
	<a href="headpage.php"><i class="fas fa-table"></i><span>Show Activity</span></a>
	<a href="#"><i class="fas fa-th"></i><span>Forms</span></a>
	</div>
<!-- Side bar end -->

    
	<div class="content">
	<div class="backpage">
	<a href="chiefpage.php"><img src="images/back.png" width="50px" height="30px" style="float:right;"></a>
	</div>
    <table class="table table-success" border="1px" style="padding:50px;width:80%;margin-top:10%;position:absolute;border-collapse:collapse;">
	<div class="scrollable">
    <thead>
      <tr>
	    <th> Sl. No</th>
        <th>Name of Activity</th>
        <th>Mode of Execution</th>
		<th>Approved_budget</th>
		<!--<th>NIT Date</th>
		<th>Letter Intent Date</th>
        <th>Firm name</th>
        <th>Contract Amount</th>
        <th>Contract Duration</th>
		<th>Letter of Intent</th>
		<th>Letter of Acceptance</th>
		<th>Work Order</th>
		<th>Date of Commencement</th>
		<th>Expected date of Completion</th>-->
		<th>Site Engineer</th>
		<th>Remarks</th>
		
      </tr>
    </thead>
	<?php
	    $count = 1;
	    if(mysqli_num_rows($result)>0){
		 while($rows = mysqli_fetch_array($result)){	 
	    ?>
		<tr>
		<td><?php echo $count++;?></td>
        <td><?php echo $rows['activity_name'];?></td>
        <td><?php echo $rows['mode_of_execution'];?></td>
		<td><?php echo $rows['approved_budget'];?></td>
       <!-- <td><?php echo $rows['created_date'];?></td>
		<td><?php echo $rows['created_date'];?></td>
        <td><?php echo $rows['firm_name'];?></td>
        <td><?php echo $rows['contract_amount'];?></td>
        <td><?php echo $rows['contract_duration'];?></td> 
		<td><a href="upload/<?php  echo htmlentities($rows["Loi"]);?>"><?php echo ($rows["Loi"]);?></a></td>
		<td><a href="upload/<?php  echo htmlentities($rows["Loa"]);?>"><?php echo ($rows["Loa"]);?></a></td>
		<td><a href="upload/<?php  echo htmlentities($rows["work_order"]);?>"><?php echo ($rows["work_order"]);?></a></td>
		<td><?php echo $rows['start_date'];?></td> 
		<td><?php echo $rows['end_date'];?></td> -->
		<td><?php echo $rows['username'];?></td>
		<td><?php echo $rows['remarks'];?></td>
		</tr>
		<?php
		 }	 
		}
	  ?>	
	   
    </div>	  
   </table>
   </div>
</body>
</html>