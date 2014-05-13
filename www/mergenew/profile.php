<?php 
	require_once 'functions.php';
	require 'template.php';
	
	$have_error=false;
	$ErrorArray=array();

	if (!checkLogin()){
		$have_error=true;
		$ErrorArray[] = "Username is empty";
	}
	else {
		$username = $_SESSION['username'];
		if(isset($_GET["username"]))
		{
			$username = $_GET["username"];
		}
		
		$stmt = "select profile_exists('$username');";
		$result=$con->query($stmt);
		$row = $result->fetch_array();
		
		if(!$row[0]){
			$have_error=true;
			$ErrorArray[] = "Profile doesn't exist";
			echo 
				'<div class="profile">'.$username.'\'s Profile doesn\'t exist.<br></div>';	
		}
		else
		{
			$stmt = "call profile_get('$username', @firstname, @lastname, @profilepic, @birthday, @gender, @city, @description);
			
			select @firstname, @lastname, @profilepic, @birthday, @gender, @city, @description;";
			$result = $con->multi_query($stmt);
			$con->next_result();
			$result = $con->store_result();
			$row = $result->fetch_array();
			
			$firstname = $row["@firstname"];
			$lastname = $row["@lastname"];

			$profilepic = $row[2];
			$birthday = $row[3];
			$gender = $row[4];
			$city = $row[5];
			$description = $row[6];
			$gender = $row[4];
			echo '<div class="profile">

					<!-- profile pic to do store in filesystem rather than db -->
					<table cellspacing="1" cellpadding="0" border="0">
						<thead>
							'.$username.'\'s Profile
						</thead>
						<tbody>
							<tr><td>First Name</td><td>'.$row[0].'</td></tr>
							<tr><td>Last Name</td><td>'.$row[1].'</td></tr>
							<tr><td>Gender</td><td>'.$gender.'</td></tr>
							<tr><td>Birthday</td><td>'.date($row[3]).'</td></tr>
							<tr><td>City</td><td>'.$row[5].'</td></tr>
							<tr><td>Description</td><td>'.$row[6].'</td></tr>
						</tbody>
					</table>

				</div>';
				
		}
	}
?>
