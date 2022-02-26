<?php
include('connection.php');
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=contract_activity_report.xls');
	?>
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
		
      </tr>
    </thead>
	<?php
	    $count = 1;
		$sql = "SELECT SUM(R.Net_payable) as sum,A.id as AID, A.activity_name,A.fund,A.approved_budget,A.ts_amount,A.ts_date,A.adms_date,A.nit_date,C.loi_date,C.loa_date,C.work_order_date,C.start_date,C.end_date,C.firm_name,C.contract_amount,C.contract_duration,C.Loi,C.Loa,C.work_order,U.username 
		FROM activity A,contract_details C,users U,running_bill R
	    WHERE A.id = C.activity_id AND R.contract_details_id=C.id AND U.id = A.user_id GROUP BY R.contract_details_id ORDER BY C.id";
		$result = mysqli_query($db,$sql);
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
		<td><?php  echo number_format((($rows["contract_amount"]/$rows['sum'])*100),2);?></td>
		<!--<td><a href="upload/<?php  echo htmlentities($rows["work_order"]);?>"><?php echo ($rows["work_order"]);?></a></td>-->
		<td><?php echo $rows['username'];?></td>
		
		</tr>
		<?php
		 }		 
		}
	  ?>	
	  
		
	  
    </div>	  
   </table>
