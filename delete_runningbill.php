<?php
	include('connection.php');
	    $eid=$_GET['deleteid'];
		/*To fetch user_id*/
		$user=$_SESSION['username'];
		$query1=mysqli_query($db,"SELECT * FROM users where username='$user'");
		$row=mysqli_fetch_array($query1);
		$id=$row['id'];
		/*To fetch contract details id*/
		$query2=mysqli_query($db,"SELECT * FROM contract_details where user_id='$id' and activity_id='$eid'");
		$row=mysqli_fetch_array($query2);
		$id1=$row['id'];
		$query = "DELETE FROM running_bill WHERE contract_details_id='$id1'";
		
		if(mysqli_query($db,$query)){
		
			   echo "<script>alert('Do you want to delete?')
				location.href = '';
				</script>";
		}
?>