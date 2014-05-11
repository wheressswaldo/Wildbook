<html>
<head>
<title>Sign Up - Wildbook</title>
</head>

<?php 
require_once 'functions.php';
$have_error=false;
$ErrorArray=array();


if($_SERVER['REQUEST_METHOD']=='POST') {
    $username=isset($_POST['username']) ? $_POST['username'] : '';
    $password=isset($_POST['password']) ? $_POST['password'] : '';
	$verify=isset($_POST['verify']) ? $_POST['verify'] : '';

	if (empty($username)){
		$have_error=true;
		$ErrorArray[] = "Username is empty";
	}
	else if (empty($password)){
		$have_error=true;
        $ErrorArray[] = "Password is empty";
    }
	else if (empty($verify)){
		$have_error=true;
		$ErrorArray[] = "Please verify your password!";
	}
	else if	($password !== $verify){
		$have_error=true;
        $ErrorArray[] = "Passwords do not match!";
    }

	if(!$have_error){
	    $result=mysqli_query($con, " select * from `user` where username='$username';");
	    if( $result->num_rows >0 ){
			$have_error=true;
			$ErrorArray[]='User already exists!!';
	    }
	}

	if($have_error){
		foreach ($ErrorArray AS $Errors){
            echo "<font color='red'><b>".$Errors."</font></b><br>";
        }
	}

	if( !$have_error){
	    $insert=mysqli_query($con,"insert into `user`(username, password) values('$username','$password');");
	    if($insert){
		$userid = $con->insert_id;
		session_start();
		$_SESSION['username'] = $username;
		$_SESSION['userid'] = $userid;
		header( 'Location: home.php' );

	    }
	}

}
?>

<body style="background:none">


        <form method ="POST">
        <fieldset>
          <div class="form-group">
            <label for="username">USERNAME</label>
            <input type="text" class="form-control" id = "username" name="username" placeholder="Username" value="">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="">
          </div>
          
          <div class="form-group">
            <label for="verify">Re-enter Password</label>
            <input type="password" class="form-control" id="verify" name="verify" placeholder="Password" value="">
          </div>
        
          <button type="submit" value="Login" class="btn btn-default" name="login">Submit</button>
        </fieldset>
        </form>



</body>
</html>