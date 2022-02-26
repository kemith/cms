<?php
	include('connection.php');
	if(isset($_POST['register'])){
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$employee_id = $_POST['employee_id'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		$role = $_POST['role'];
		$sql_u = "SELECT * FROM users WHERE username='$username'";
		$res_u = mysqli_query($db, $sql_u);
		if (mysqli_num_rows($res_u) > 0) {
			$name_error = "Sorry... username already taken"; 
			}
			
		else{
			$query = "INSERT INTO users(fname,lname,emp_id,username,email_id,password,created_date,role) VALUES ('$first_name','$last_name','$employee_id','$username','$email','$password',NOW(),'$role')";
		
		$run_insert = mysqli_query($db,$query);
		echo "<script>alert('Successfully registered.')
				location.href = 'login.php?attempt=success';
				</script>";
		}
		
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color: #efefef;	background-image:url('images/logo1.png');">
	<div class="display1">
	<h1>&nbsp;&nbsp; &nbsp; &nbsp; Registration Form</h1>
	<div class="input-group" style="padding:30px 100px;">
	<form method="post" action ="" enctype="">
	
	<label>First Name</label>
	<input type="text" name="first_name" class="form-control" required>
	
	<label>Last Name</label>
	<input type="text" name="last_name" class="form-control" required>
	
	<label>Employee Id</label>
	<input type="text" name="employee_id" class="form-control" required>
	
	<label>Username</label>
	<input type="text" name="username" class="form-control" required>
	
	<label>Email</label>
	<input type="email" name="email" class="form-control" required>
	
	<label>Password</label>
	<input type="password" name="password" class="form-control" required>
	<label>Select role</label>
	<select name="role" id="role">
	 <option>Admin</option>
	 <option>Engineer</option>
	</select> 
    <br/>
	<input type="submit" name="register" class="form-control" style="background-color:#80aaff;">
	<a href="login.php">Already have an account?</a>
	</form>
	<?php if (isset($name_error)): ?>
	<span><?php echo $name_error; ?></span>
	<?php endif ?>
	</div>
	</div>
</body>
</html>