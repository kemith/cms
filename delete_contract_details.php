<?php
include('connection.php');
$eid=$_GET['editid'];
$query = "DELETE FROM contract_details WHERE activity_id='$eid'";

if(mysqli_query($db,$query)){

echo "<script>alert('Do you want to delete?')
location.href = 'view_contract_details.php?editid=$eid';
</script>";
}
?>