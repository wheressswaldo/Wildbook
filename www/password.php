<?php 
	require_once 'functions.php';
	require 'template.php';
	$have_error=false;
	$ErrorArray=array();
	
	if (!checkLogin()){
		$have_error=true;
		$ErrorArray[] = "Username is empty";
	}

	else if($_SERVER['REQUEST_METHOD']=='POST') {
		$oldpassword=isset($_POST['oldpassword']) ? $_POST['oldpassword'] : '';
		$password=isset($_POST['password']) ? $_POST['password'] : '';
		$verify=isset($_POST['verify']) ? $_POST['verify'] : '';
	
		$username = $_SESSION['username'];
		
		if (empty($oldpassword)){
			$have_error=true;
			$ErrorArray[] = "Type in your old password";
		}
		if (empty($password)){
			$have_error=true;
			$ErrorArray[] = "Type in your new password";
		}
		if (empty($verify)){
			$have_error=true;
			$ErrorArray[] = "Confirm your new password";
		}
		if (!($verify == $password))
		{
			$have_error=true;
			$ErrorArray[] = "Your new password and confirmation don't match";
		}else
		{
			$stmt = "select 1 from user where username = '$username' and password = unhex(md5('$oldpassword'));";
			$result=mysqli_query($con, $stmt);
			$row = $result->fetch_array();
			if(!$row[0])
			{
				$have_error=true;
				$ErrorArray[] = "You typed in the wrong password";
			}
		}
		
		if(!$have_error)
		{
				$username = $_SESSION['username'];
				$result=mysqli_query($con, "update user set password = unhex(md5('$verify')) where username = '$username';");
				
				header( 'Location: index.php' );
		}
		
		if($have_error){
			foreach ($ErrorArray AS $Errors){
				echo "<font color='red'><b>".$Errors."</font></b><br>";
			}
		}
		
	}

	
?>
<div class="container">
<div class="row clearfix">
    <div class="col-md-12 column">
    <div class="col-md-6 col-md-offset-3 column">
		<form id="password" method="post" action="password.php" role="form">
			<legend> Change Password </legend>
				
			<label>Old Password</label>
			<input type="password" name="oldpassword" class="form-control" value="" /><br>
				
			<label>Password</label>
			<input type="password" name="password" class="form-control" value="" /><br>

			<label>Verify Password</label>
			<input type="password" name="verify" class="form-control" value="" /><br>
			
			<button type="submit" value="changepassword" name="changepassword" class="btn btn-primary">Submit</button><br>
			
		</form>
	</div>
    </div>
</div>
</div>

</body>
</html>
