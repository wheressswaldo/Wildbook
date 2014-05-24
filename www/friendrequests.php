 <div >

 <?php
	require_once 'functions.php';
	

	if (!checkLogin()){
		header('Location: index.php');
	}
	else{
		$username = $_SESSION['username'];
		$stmt =	 "SELECT usernameFrom
				FROM friendrequest where usernameTo ='$username';";
		$result = $con->query($stmt);
		$count = 0;
		$tester = 0;
		while($row = $result->fetch_array())
		{
			$request = $row[0];
			$stmt = "select * from profile where username = '$request';";
			$profile = $con->query($stmt);
			$profile = $profile->fetch_array();
			$fn = $profile[1];
			$ln = $profile[2];
			echo "<div>
				<a href='#' class='thumbnail'>
					<img src='' 'data-src='holder.js/100%x180' alt='...' style='min-height:300px;height:300px;'>
				</a>
				<div>
					<a href='profile.php?username=$request'><h3>$fn $ln</h3></a>		
				</div> 
				
				<a id='button' href='acceptfriend.php?username=$request' class='btn btn-primary' role='button'>Accept</a>
				
			
				<a id='button' href='rejectfriend.php?username=$request' class='btn btn-primary' role='button'>Reject</a>
			</div>
				";
			
			
		
		}
	}

?>	

<style>
	.caption{
		text-align:center;
	}
	#button{
		position: relative;
		left: 30px;
	}
	#title{
		position: relative;
		left: 30px;
	}
</style>
</div>
