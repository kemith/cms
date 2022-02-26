<?php
	include('connection.php');
	    $eid=$_GET['deleteid'];
		$query = "DELETE FROM activity WHERE id='$eid'";
		
		if(mysqli_query($db,$query)){
		
			   echo "<script>alert('Do you want to delete?')
				location.href = 'index.php?attempt=success';
				</script>";
		}
?>