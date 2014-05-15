<?php 
	require_once 'functions.php';
	require 'template.php';
	$have_error=false;
	$ErrorArray=array();

	if($_SERVER['REQUEST_METHOD']=='POST') {
		$activityname=isset($_POST['activityname']) ? $_POST['activityname'] : '';

		if (empty($activityname)){
			$have_error=true;
			$ErrorArray[] = "Activity name is empty";
		}

		if(!$have_error)
		{
				$result=mysqli_query($con, " select * from `activity` where activityName='$activityname';");
				if( $result->num_rows >0 ){
					$have_error=true;
					$ErrorArray[]='Activity already exists';
				}
		}
		
		if($have_error){
			foreach ($ErrorArray AS $Errors){
				echo "<font color='red'><b>".$Errors."</font></b><br>";
			}
		}
		
		if( !$have_error){
			$insert=mysqli_query($con,"insert into `activity`(activityName) values('$activityname');");
			if($insert){
				header( 'Location: activities.php' );
			}
		}
	}
?>

<div class="container">
<div class="row clearfix">
    <div class="col-md-12 column">
    <div class="col-md-6 col-md-offset-3 column">
		<form id="addActivity" method="post" action="addActivity.php" role="form">
			<legend> Add New Activity </legend>
			
			<label>Activity Name</label>
			<input type="text" name="activityname" class="form-control" value="" /><br>

			<button type="submit" value="saveActivity" name="addActivity" class="btn btn-primary">Submit</button><br>
			
		</form>
	</div>
    </div>
</div>
</div>

</body>
</html>
