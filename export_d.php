<?php
include('connection.php');
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=departmental_activity_report.xls');
	?>
	<table align="center" border="2" cellspacing="0" cellpadding="3" style="padding:50px;width:100%;border-collapse:collapse;position:absolute;margin-top:6%;">
	<div class="scrollable">
    <thead>
      <tr>
	    <th> Sl. No</th>
        <th>Name of Activity</th>
		<th>Financial Year</th>
		<th>Approved_budget</th>
		<th>Source of Fund</th>
        <th>Expenditure</th>
        <th>Budget Balance</th>
        <th>Financial Progress Achieved</th>
		<th>Site Engineer</th>
		
      </tr>
    </thead>
	<?php
	    $count = 1;
		$sql = "SELECT SUM(M.amount) as M_sum,SUM(MA.amount) as MA_sum,A.id as AID, A.activity_name,A.FY,A.fund,A.approved_budget,U.username 
		FROM activity A,users U,material M,masteroll MA
	    WHERE A.id = M.activity_id AND A.id=MA.activity_id AND U.id = MA.user_id GROUP BY MA.activity_id ORDER BY A.id";
		$result = mysqli_query($db,$sql);
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
		</tr>
		<?php
		 }		 
		}
	  ?>	
	  
		
	  
    </div>	  
   </table>
