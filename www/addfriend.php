 <?php
	require_once 'functions.php';
	if (!checkLogin()){
		header('Location: index.php');
	}
	else{
		$username = $_SESSION['username'];
		$add=isset($_GET['username']) ? $_GET['username'] : '';

		$stmt2 = "insert into friendrequest values('$username','$add');";

		$result = $con->query($stmt2);
		
		header("Location: profile.php?username=$add");
		}
?>	
