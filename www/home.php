<?php 
	require_once 'functions.php';
	require 'template.php';
	

	$isLoggedIn= checkLogin();
	if(!$isLoggedIn){
		header("Location: index.php");
	}
	

?>

<div>
<?php
	require_once 'functions.php';
	require 'display.php';
	
	if (!checkLogin()){
		$have_error=true;
		$ErrorArray[] = "Username is empty";
	}
	else {
		$username = $_SESSION['username'];
		$people = array();
		$people[] = $username;
		$stmt = "(SELECT username2 as friends
					FROM FriendsWith 
					WHERE username1 = '$username') UNION 
					(SELECT username1 as friends
					FROM FriendsWith
					WHERE username2 = '$username');";
		$result = $con->query($stmt);	
		while($row = $result->fetch_array())
		{	
			$people[] = $row[0];
		}
		$feed = array();
		foreach ($people AS $person){
           
			$stmt = "select * from diaryEntry where username= '$person';";
			$result = $con->query($stmt);	
			
			while($row = $result->fetch_array())
			{			
			displayEntry($row["username"], $row["diaryTitle"],$row["diaryDesc"],$row["timeposted"], $row["lastedited"]);		
			}
        }
		
		
	}
?>
</div>
</body>
</html>