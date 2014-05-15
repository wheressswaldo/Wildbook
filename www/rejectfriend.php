 <?php
	require_once 'functions.php';
	if (!checkLogin()){
		header('Location: index.php');
	}
	else{
		$username = $_SESSION['username'];
		$reject=isset($_GET['username']) ? $_GET['username'] : '';
		

		$stmt2 = "delete from friendrequest where usernamefrom='$reject' and usernameTo='$username'";

		$result = $con->query($stmt2);
		
		header('Location: friendrequests.php');
		}
?>	
