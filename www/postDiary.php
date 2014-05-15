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
		$diarytitle=isset($_POST['diarytitle']) ? $_POST['diarytitle'] : '';
		$location=isset($_POST['location']) ? $_POST['location'] : '';
		$activity=isset($_POST['activity']) ? $_POST['activity'] : '';
		$diaryDesc=isset($_POST['diaryDesc']) ? $_POST['diaryDesc'] : '';
		$multimedia=isset($_POST['multimedia']) ? $_POST['multimedia'] : '';
		$privacy=isset($_POST['privacy']) ? $_POST['privacy'] : '';
		
		
		if (empty($diarytitle)){
			$have_error=true;
			$ErrorArray[] = "Title is empty";
		}
		else if (empty($privacy)){
			$have_error=true;
			$ErrorArray[] = "Privacy is empty";
		}
		else if (empty($diaryDesc)){
			$have_error=true;
			$ErrorArray[] = "Description is empty";
		}
		if(!$have_error)
		{
				$username = $_SESSION['username'];
	
				$result=mysqli_query($con, "select 1, locationID from location where locationName = '$location';");
				$row = $result->fetch_array();
				$locationID = $row[1];
				if(!$row[0]) $locationID = 'null';
				
				$result=mysqli_query($con, "select 1, activityID from activity where activityName= '$activity';");
				$row = $result->fetch_array();
				$aID = $row[1];
				if(!$row[0]) $aID = "null";
				
				$multimediaID = "null";
				
				//echo $aID.$locationID.$multimediaID;
				$timeposted = date('Y-m-d H:i:s');
				$stmt = "insert into diaryentry(username,activityID, locationID, multimediaID, diaryTitle, diaryDesc, timeposted, privacysetting) values('$username',$aID ,$locationID, $multimediaID, '$diarytitle', '$diaryDesc','$timeposted','$privacy');";
				
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
		<form id="adddiaryentry" method="post" action="postDiary.php" role="form">
			<legend> New Diary Entry </legend>
				
			<label>Title</label>
			<input type="text" name="diarytitle" class="form-control" value="" /><br>

			<label>Location</label>
			<input type="text" name="location" class="form-control" value="" /><br>
			
			<label>Activity</label>
			<input type="text" name="activity" class="form-control" value="" /><br>
			
			<textarea name="diaryDesc" cols="1" rows="1"style="width: 540px; height: 153px;"></textarea>
			
			<label>Multimedia</label>
			<input type="file" name="multimedia" class="form-control" /><br>
			
			<label>Privacy</label><br>
			<select name="privacy">
				<option value="1">Public</option>
				<option value="2">Friends or Friends of Friends</option>
				<option value="3">Friends</option>
				<option value="4">Private</option>
			</select><br>
			<button type="submit" value="saveDiaryEntry" name="postdiary" class="btn btn-primary">Submit</button><br>
			
		</form>
	</div>
    </div>
</div>
</div>

</body>
</html>
