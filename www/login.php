<html>
<head>
<title>Wildbook</title>
</head>
<body>
<h4>Login</h4>

<form action="login.php" method="post"> 
username: <input name="username" type="text" maxlength="10"/> 
password : <input name="password" type="password" maxlength="10"/>
<input type="submit" />
</form>
<?php
if( isset($_POST['username']) && isset($_POST['password']) ) {
	$link = mysql_connect('localhost','root','password');
	
	$wildbook = mysql_select_db('wildbook',$link);
	$info_accepted = 1;

	$username = $_POST['username'];
	$user_query = mysql_query("select username from user;");
	$not_exists = 0;
	while( ($row = mysql_fetch_array($user_query)) && $not_exists == 0 ) {
		$tempuser = $row['username'];
		if($tempuser == $username) {
			$not_exists = 1;
		}
	}
	if($not_exists == 0) {
		$info_accepted = 0; // username does not exist
	}
	else {
		$password = $_POST['password'];
		$pass_query = mysql_query("SELECT password from user where username = '$username'")
		while($row = mysql_fetch_array($pass_query)) {
			$temppass = $row['password'];
			if ($temppass != $password) {
				$info_accepted = 0;
			}
		}
	}
	if ($info_accepted == 1) {
		header("location:home.php?username=$username");
	}
	else {
		echo "Username/password invalid, try again";
	}
	mysql_close($link); 
}
?>

</body>
</html>