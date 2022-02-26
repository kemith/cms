<?php
	include('connection.php');
	    $eid=$_GET['deleteid'];
		$query = "DELETE FROM advance WHERE id='$eid'";
		
		if(mysqli_query($db,$query)){
		
			   echo "<script>alert('Do you want to delete?')
				location.href = 'view_advance.php?attempt=success';
				</script>";
		}
?>