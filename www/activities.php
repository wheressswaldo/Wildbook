<?php 
	require_once 'functions.php';
	require 'template.php';
	if (!checkLogin()){
		header('Location: index.php');
	}
	else{
		$stmt =	 	"SELECT *
					FROM activity;";
		$result = $con->query($stmt);
		echo "<div><h3 id='title'>Activities</h3>
				<a id='button' href='addActivity.php' class='btn btn-primary' role='button'>
					Add New Activity
				</a><br><div>";
		echo "<div id='activities'><div class='row'>";
		$count = 0;
		$tester = 0;
		while($row = $result->fetch_array())
		{
			$activityid = $row[0];
			$activityname = $row[1];
			$tempImage = "kitten" . (string)$tester . ".jpg";
			echo "<div class='col-xs-6 col-md-3'>
					<a href='#' class='thumbnail'>
						<img src='$tempImage' 'data-src='holder.js/100%x180' alt='...' style='min-height:300px;height:300px;'>
					</a>
					<div class='caption'>
						<h3> $activityname </h3>
						<h5> You can do this at: ";
			if($a = mysqli_query($con, "select * from activityatlocation natural join location where activityid='$activityid'")){
				while ($b = $a->fetch_array()){
					echo "<a href='locations.php'> $b[4] </a>";
				}
			}
			echo "</h5>
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
				#button{
					position: relative;
					left: 30px;
				}
				#activities{
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

</body>
</html>