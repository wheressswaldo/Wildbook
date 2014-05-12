<?php 
	require_once 'functions.php';
	require 'template.php';
	
	$have_error=false;
	$ErrorArray=array();

	if (!checkLogin()){
		$have_error=true;
		$ErrorArray[] = "Username is empty";
	}
	else {
		$username = $_SESSION['username'];

		$stmt =	 	"(SELECT username2 as friends
					FROM FriendsWith 
					WHERE username1 = '$username') UNION 
					(SELECT username1 as friends
					FROM FriendsWith
					WHERE username2 = '$username');";
		$result = $con->query($stmt);
		
		echo "<div class=friends><h3>".$username."'s friends</h3><ul>";
		while($row = $result->fetch_array())
		{
			echo "<li><a href='findUser.php'>".$row[0]."</a></li>";
		}
		echo "</ul></div>";
			
	}
	
?>

