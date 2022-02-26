<?php
		session_start();
	include('connection.php');
	if(isset($_POST['add'])){
		$activity_name = $_POST['activity_name'];
		$fy = $_POST['FY'];
		$approved_budget = $_POST['approved_budget'];
	/*FILE UPLOADING*/
		$file=$_FILES['file']['name'];
		$tmp_name=$_FILES['file']['tmp_name'];
		$path='upload/'.$file;
		$ext=explode(".",$file);
		$cn=count($ext);
		if($ext[$cn-1]=="jpg" || "png" || "jpeg" || "pdf" || "wmv" || "pdf" || "zip" || "docx" || "xlsx")
		{
		$tmp_name=$_FILES['file']['tmp_name'];
		move_uploaded_file($tmp_name,$path);
		}
		/*FILE UPLOADING*/
		$file1=$_FILES['file1']['name'];
		$tmp_name=$_FILES['file1']['tmp_name'];
		$path='upload/'.$file1;
		$ext1=explode(".",$file1);
		$cn=count($ext1);
		if($ext1[$cn-1]=="jpg" || "png" || "jpeg" || "pdf" || "wmv" || "pdf" || "zip" || "docx" || "xlsx")
		{
		$tmp_name=$_FILES['file1']['tmp_name'];
		move_uploaded_file($tmp_name,$path);
		}
		/*FILE UPLOADING*/
		$file2=$_FILES['file2']['name'];
		$tmp_name=$_FILES['file2']['tmp_name'];
		$path='upload/'.$file2;
		$ext2=explode(".",$file2);
		$cn=count($ext2);
		if($ext2[$cn-1]=="jpg" || "png" || "jpeg" || "pdf" || "wmv" || "pdf" || "zip" || "docx" || "xlsx")
		{
		$tmp_name=$_FILES['file2']['tmp_name'];
		move_uploaded_file($tmp_name,$path);
		}
	/*END OF FILE UPLOADING*/
	/*To fetch user_id*/
		$user=$_SESSION['username'];
		$query1=mysqli_query($db,"SELECT * FROM users where username='$user' ");
		$row=mysqli_fetch_array($query1);
		$id=$row['id'];
	/*end fetch user_id*/
		$query = "INSERT INTO activity(activity_name,fy,approved_budget,technical_sanction,adms_&_fs,nit,created_date,user_id) VALUES ('$activity_name','$fy','$approved_budget','$file','$file1','$file2',NOW(),'$id')";
		
		$run_insert = mysqli_query($db,$query);
		echo "Acivity deatails added successfully!";
}
?>