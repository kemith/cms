<?php
session_start();
include('connection.php');
$result_per_page=5;
$query = mysqli_query($db,"SELECT SUM(R.Net_payable) as sum,A.id as AID, A.activity_name,A.fund,A.approved_budget,A.ts_amount,A.ts_date,A.adms_date,A.nit_date,C.loi_date,C.loa_date,C.work_order_date,C.start_date,C.end_date,C.firm_name,C.contract_amount,C.contract_duration,C.Loi,C.Loa,C.work_order,U.username 
		FROM activity A,contract_details C,users U,running_bill R
	    WHERE A.id = C.activity_id AND R.contract_details_id=C.id AND U.id = A.user_id GROUP BY R.contract_details_id ORDER BY C.id ");
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
$sql = "SELECT SUM(R.Net_payable) as sum,A.id as AID, A.activity_name,A.fund,A.approved_budget,A.ts_amount,A.ts_date,A.adms_date,A.nit_date,C.loi_date,C.loa_date,C.work_order_date,C.start_date,C.end_date,C.firm_name,C.contract_amount,C.contract_duration,C.Loi,C.Loa,C.work_order,U.username 
		FROM activity A,contract_details C,users U,running_bill R
	    WHERE A.id = C.activity_id AND R.contract_details_id=C.id AND U.id = A.user_id GROUP BY R.contract_details_id ORDER BY C.id LIMIT " .$this_page_first_result . ',' .$result_per_page;
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
	<div class="export"><a href="export.php">&nbsp;&nbsp;Export</a></div>
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
		<th>Approved_budget</th>
		<th>Source of Fund</th>
		<th>Estimated Amount/ TS Amount</th>
		<th>Date of TS</th>
		<th>Date of AS & FS</th>
		<th>NIT Date</th>
		<th>Letter Intent Date</th>
		<th>Letter Acceptance Date</th>
		<th>Work Order Date</th>
		<th>Date of Commencement</th>
		<th>Expected Date of Completion</th>
        <th>Firm name</th>
        <th>Contract Amount</th>
        <th>Expenditure during 20-21</th>
        <th>Expenditure during 21-22</th>
        <th>Budget Balance</th>
        <th>Total progress achieved</th>
		<th>Site Engineer</th>
		<th>Remarks</th>
		
      </tr>
    </thead>
	<?php
	    $count = 1;
		// $bal=$rows['approved_budget']-$output;
	    if(mysqli_num_rows($result)>0){
		 while($rows = mysqli_fetch_array($result)){
			
	    ?>
		<tr>
		<td><?php echo $count++;?></td>
        <td><?php echo $rows['activity_name'];?></td>
		<td><?php echo $rows['approved_budget'];?></td>
		<td><?php echo $rows['fund'];?></td>
		<td><?php echo $rows['ts_amount'];?></td>
        <td><?php echo $rows['ts_date'];?></td>
		<td><?php echo $rows['adms_date'];?></td>
		<td><?php echo $rows['nit_date'];?></td>
		<td><?php echo $rows['loi_date'];?></td>
		<td><?php echo $rows['loa_date'];?></td>
		<td><?php echo $rows['work_order_date'];?></td>
		<td><?php echo $rows['start_date'];?></td> 
		<td><?php echo $rows['end_date'];?></td> 
        <td><?php echo $rows['firm_name'];?></td>
        <td><?php echo $rows['contract_amount'];?></td>
        <td></td>
        <td></td>
		<td><?php echo $rows['approved_budget']-$rows['sum'];?></td>
			<?php /*$query1="SELECT contract_details_id,SUM(Net_payable) FROM running_bill,contract_details,activity WHERE running_bill.contract_details_id=contract_details.id and contract_details.activity_id=activity.id GROUP BY running_bill.contract_details_id ORDER BY running_bill.contract_details_id";
			$query_result1 = mysqli_query($db,$query1) or die("database error:".mysqli_error($db));
			while($row = mysqli_fetch_assoc($query_result1)){
				$output=$row['SUM(Net_payable)'] ;
			    ?>
					
			<?php  echo htmlentities($output); 
			}*/?>
		<td><?php  echo number_format((($rows["contract_amount"]/$rows['sum'])*100),2);?></td>
		<td><a href="upload/<?php  echo htmlentities($rows["work_order"]);?>"><?php echo ($rows["work_order"]);?></a></td>
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