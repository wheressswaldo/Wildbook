<?php 
	"folder/";
	require_once 'functions.php';
	require 'template.php';
	
	$have_error=false;
	$ErrorArray=array();

	if (!checkLogin()){
		$have_error=true;
		$ErrorArray[] = "You are not logged in.";
		header("Location: index.php");
	}
	else {
		$username = $_SESSION['username'];
		if(isset($_GET["username"]))
		{
			$username = $_GET["username"];
		}

		$stmt =	 	"(SELECT username2 as friends
					FROM FriendsWith 
					WHERE username1 = '$username') UNION 
					(SELECT username1 as friends
					FROM FriendsWith
					WHERE username2 = '$username');";
		$result = $con->query($stmt);
		
		echo "<div><h3 id='title'>".$username."'s friends</h3><br><div>";
		echo "<div id='friends'><div class='row'>";
		$count = 0;
		$tester = 0;
		while($row = $result->fetch_array())
		{
			$friend = $row[0];
			$tempImage = "kitten" . (string)$tester . ".jpg";
			echo "<div class='col-xs-6 col-md-3'>
					<a href='profile.php?username=".$friend."' class='thumbnail'>
						<img src='$tempImage' 'data-src='holder.js/100%x180' alt='...' style='min-height:300px;height:300px;'>
					</a>
					<div class='caption'>
						<h4> $friend </h4>
					</div>
				</div>";
			$count += 1;
			$tester += 1;
			if ($count === 3){
				echo "</div>
						<div class = 'row'>";
				$count = 0;
			}
			//echo "<li><a href='profile.php?username=".$friend."'>".$friend."</a></li>";
		}
		echo "</div>
			<style>
				.caption{
					text-align:center;
				}
				#friends{
					position: relative;
					left: 250px;
				}
				#title{
					position: relative;
					left: 30px;
				}
			</style>
		</div>";
			
	}
	
?>
<a href="friendRequests.php">
				<button type="button" class="btn btn-default btn-md">
				 Friend Requests
				</button>
				</a>