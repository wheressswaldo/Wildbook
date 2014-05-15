<?php 
	require_once 'functions.php';
	require 'template.php';
	$have_error=false;
	$ErrorArray=array();
	
	if (!checkLogin()){
		$have_error=true;
		$ErrorArray[] = "Username is empty";
	}

	else if($_SERVER['REQUEST_METHOD']=='POST') {
		
		$location=isset($_POST['location']) ? $_POST['location'] : '';
		$activity=isset($_POST['activity']) ? $_POST['activity'] : '';
		
		
		if (empty($location)){
			$have_error=true;
			$ErrorArray[] = "Location is empty";
		}
		else if (empty($activity)){
			$have_error=true;
			$ErrorArray[] = "Activity is empty";
		}
		if(!$have_error)
		{
				$username = $_SESSION['username'];
	
				$result=mysqli_query($con, "select 1, locationID from location where locationName = '$location';");
				$row = $result->fetch_array();
				$locationID = $row[1];
				if(!$row[0]) 
				{
					$have_error=true;
					$ErrorArray[] = "Location does not exist";
				}
				
				$result=mysqli_query($con, "select 1, activityID from activity where activityName= '$activity';");
				$row = $result->fetch_array();
				$aID = $row[1];
				if(!$row[0])
				{
					$have_error=true;
					$ErrorArray[] = "Activity is does not exist";
				}

				
				//echo $aID.$locationID.$multimediaID;
				$timeposted = date('Y-m-d H:i:s');
				$stmt = "insert into activityatlocation(username,activityID, locationID) values('$username',$aID ,$locationID);";
				
				$insert=mysqli_query($con, $stmt);
				if($insert){
					header( 'Location: index.php' );
				}
		}
		
		if($have_error){
			foreach ($ErrorArray AS $Errors){
				echo "<font color='red'><b>".$Errors."</font></b><br>";
			}
		}
		
	}

	
?>

<div class="container">
<div class="row clearfix">
    <div class="col-md-12 column">
    <div class="col-md-6 col-md-offset-3 column">
		<form id="likeActivityatLocation" method="post" action="postActivity.php" role="form">
			<legend>New Activity at Location </legend>

			<label>Location</label>
			<input type="text" name="location" class="form-control" value="" /><br>
			
			<label>Activity</label>
			<input type="text" name="activity" class="form-control" value="" /><br>
			
			<button type="submit" value="saveActivityLocation" name="activitylocation" class="btn btn-primary">Submit</button><br>
			
		</form>
	</div>
    </div>
</div>
</div>

</body>
</html>