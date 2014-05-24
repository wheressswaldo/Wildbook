<?php 
	require_once 'functions.php';
	require 'template.php';

	if (!checkLogin()){
		header('Location: index.php');
	}
	else{
		$stmt =	 	"SELECT *
					FROM location;";
		$result = $con->query($stmt);
		echo "<div><h3 id='title'>Locations</h3>
				<a id='button' href='addLocation.php' class='btn btn-primary' role='button'>
					Add New Location
				</a><br><div>";
		echo "<div id='locations'><div class='row'>";
		$count = 0;
		$tester = 0;
		while($row = $result->fetch_array())
		{
			$locationid = $row[0];
			$locationName = $row[1];
			$longitude = $row[2];
			$latitude = $row[3];
			$tempImage = "kitten" . (string)$tester . ".jpg";
			echo "<div class='col-xs-6 col-md-3'>
					<a href='#' class='thumbnail'>
						<img src='$tempImage' 'data-src='holder.js/100%x180' alt='...' style='min-height:300px;height:300px;'>
					</a>
					<div class='caption'>
						<h3> $locationName </h3>
						<h4> $longitude, $latitude </h4>
						<h5> Good for: ";
			if($a = mysqli_query($con, "select * from activityatlocation natural join activity where locationid='$locationid'")){
				while ($b = $a->fetch_array()){
					echo "<a href='activities.php'> $b[4] </a>";
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
				#locations{
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