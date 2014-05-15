<?php 
	require_once 'functions.php';
	require 'template.php';
	$have_error=false;
	$ErrorArray=array();

	if($_SERVER['REQUEST_METHOD']=='POST') {
		$locationname=isset($_POST['locationname']) ? $_POST['locationname'] : '';
		$longitude=isset($_POST['longitude']) ? $_POST['longitude'] : '';
		$latitude=isset($_POST['latitude']) ? $_POST['latitude'] : '';

		if (empty($locationname)){
			$have_error=true;
			$ErrorArray[] = "Location name is empty";
		}
		else if (empty($longitude)){
			$have_error=true;
			$ErrorArray[] = "Longitude is empty";
		}
		else if (empty($latitude)){
			$have_error=true;
			$ErrorArray[] = "Latitude is empty";
		}
		else if	(!is_numeric($longitude) or !is_numeric($latitude)){
			$have_error=true;
			$ErrorArray[] = "Please enter proper longitude or latitudes";
		}
		if(!$have_error)
		{
				$result=mysqli_query($con, " select * from `location` where locationName='$locationname';");
				if( $result->num_rows >0 ){
					$have_error=true;
					$ErrorArray[]='Location already exists';
				}
		}
		
		if($have_error){
			foreach ($ErrorArray AS $Errors){
				echo "<font color='red'><b>".$Errors."</font></b><br>";
			}
		}
		
		if( !$have_error){
			$insert=mysqli_query($con,"insert into `location`(locationName,longitude,latitude) values('$locationname','$longitude','$latitude');");
			if($insert){
				header( 'Location: locations.php' );
			}
		}
	}
?>

<div class="container">
<div class="row clearfix">
    <div class="col-md-12 column">
    <div class="col-md-6 col-md-offset-3 column">
		<form id="addlocation" method="post" action="addLocation.php" role="form">
			<legend> Add New Location </legend>
			
			<label>Location Name</label>
			<input type="text" name="locationname" class="form-control" value="" /><br>

			<label>Longitude</label>
			<input type="text" name="longitude" class="form-control" value="" /><br>
			
			<label>Latitude</label>
			<input type="text" name="latitude" class="form-control" value="" /><br>


			<button type="submit" value="savelocation" name="addlocation" class="btn btn-primary">Submit</button><br>
			
		</form>
	</div>
    </div>
</div>
</div>

</body>
</html>
