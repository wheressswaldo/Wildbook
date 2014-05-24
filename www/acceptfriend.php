 <?php
	require_once 'functions.php';
	if (!checkLogin()){
		header('Location: index.php');
	}
	else{
		$username = $_SESSION['username'];
		$accept=isset($_GET['username']) ? $_GET['username'] : '';
		
		$stmt = "insert into friendswith values('$username','$accept');";
		echo $stmt;
		$stmt2 = "delete from friendrequest where usernamefrom='$accept' and usernameTo='$username'";
		
		$result = $con->query($stmt);
		$result = $con->query($stmt2);
		
		//header('Location: friendrequests.php');
		}
	
?>	
