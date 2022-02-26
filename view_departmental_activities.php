<?php
session_start();
include('connection.php');
$result_per_page=5;
$query = mysqli_query($db,"SELECT SUM(M.amount) as M_sum,SUM(MA.amount) as MA_sum,A.id as AID, A.activity_name,A.FY,A.fund,A.approved_budget,U.username 
		FROM activity A,users U,material M,masteroll MA
	    WHERE A.id = M.activity_id AND A.id=MA.activity_id AND U.id = A.user_id GROUP BY M.activity_id ORDER BY A.id ");
$number_of_results = mysqli_num_rows($query);
//determine  no of total page available
$number_of_pages = ceil($number_of_results/$result_per_page);
//determine which page the visitor is currently on
if(!isset($_GET['page'])){
	$page=1;
			}
else{
$page=$_GET['page'];
			}
//determine the sql LIMIT starting numbers for the results on the displaying page
$this_page_first_result=($page-1)*$result_per_page;

//retrieve selected results from database and display them on the page
$sql = "SELECT SUM(M.amount) as M_sum,SUM(MA.amount) as MA_sum,A.id as AID, A.activity_name,A.FY,A.fund,A.approved_budget,U.username 
		FROM activity A,users U,material M,masteroll MA
	    WHERE A.id = M.activity_id AND A.id=MA.activity_id AND U.id = MA.user_id GROUP BY MA.activity_id ORDER BY A.id LIMIT " .$this_page_first_result . ',' .$result_per_page;

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
	<div class="export"><a href="export_d.php">&nbsp;&nbsp;Export</a></div>
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
	
	</div>
<!-- Side bar end -->
    
	<div class="content">
	<table align="center" border="2" cellspacing="0" cellpadding="3" style="padding:50px;width:100%;border-collapse:collapse;position:absolute;margin-top:6%;">
	<div class="scrollable">
    <thead>
      <tr>
	    <th> Sl. No</th>
        <th>Name of Activity</th>
        <th>Financial Year</th>
		<th>Approved_budget</th>
		<th>Source of Fund</th>
		<th>Expenditure </th>
        <th>Budget Balance</th>
        <th>Finacial Progress Achieved (%)</th>
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
        <td><?php echo $rows['FY'];?></td>
		<td><?php echo $rows['approved_budget'];?></td>
		<td><?php echo $rows['fund'];?></td>
		<td><?php echo $rows['M_sum']+$rows['MA_sum']?></td>
		<td><?php  echo number_format($rows['approved_budget']-($rows['M_sum']+$rows['MA_sum']),2);?></td>
		<td><?php  echo number_format(((($rows['M_sum']+$rows['MA_sum'])/$rows['approved_budget'])*100),2);?></td>
		<td><?php echo $rows['username'];?></td>
		<td><button><a href="remarks.php?activityid=<?php echo $rows['AID'];?>">Add</a></button></td>
		</tr>
		<?php
		 }		 
		 
	  ?>	
	  
		
	  
    </div>	  
   </table>
   <div class="pagination" style="margin-left:5%;margin-top:43%;position:fixed;">
	<?php
		for($page=1;$page<=$number_of_pages;$page++){
			echo '<a href="view_contract_activities.php?page=' .$page . '" style="background-color:#f44336;display:inline-block;padding:10px 10px;">'.$page. '</a>';
		}
				}
	?>
	</div>
	<?php include "footer.php"?>
   </div>
</body>
</html>