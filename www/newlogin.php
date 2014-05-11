<html>
<head>
<title>Login - Wildbook</title>
</head>

<?php 
require_once 'functions.php';
$have_error=false;
$ErrorArray=array();


if($_SERVER['REQUEST_METHOD']=='POST') {
    $username=isset($_POST['username']) ? $_POST['username'] : '';
    $password=isset($_POST['password']) ? $_POST['password'] : '';

	if (empty($username)){
		$have_error=true;
		$ErrorArray[] = "Username is empty";
	}
	else if (empty($password)){
		$have_error=true;
        $ErrorArray[] = "Password is empty";
    }

	if(!$have_error){

		$stmt = "select user_isPasswordValid('$username', '$password');";
		$query2 = "select test();";
		$result=$mysqli->query($stmt);
		$row = $result->fetch_array();
		
		if($row[0]){
			echo "hello";
			session_start();
			//$userid=$row['userid'];
			$_SESSION['username']=$username;
			//$_SESSION['userid']=$userid;
			//header( "Location: home.php");
		}
		else{
			$have_error = true;
			$ErrorArray[] = "Username or password is incorrect.";
		}
    }
	if($have_error){
		foreach ($ErrorArray AS $Errors){
            echo "<font color='red'><b>".$Errors."</font></b><br>";
        }
	}
}
?>

<body style="background:none">


        <form method ="POST">
        <fieldset>
          <div class="form-group">
            
            <input type="text" class="form-control" id = "username" name="username" placeholder="Username" value="">
          </div>
          <div class="form-group">

            <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="">
          </div>
		  
          <button type="submit" value="Login" class="btn btn-default" name="login">Submit</button>
        </fieldset>
        </form>



</body>
</html>