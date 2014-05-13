<?php
	$firstname = "";
	$lastname = "";
	$gender = "";
	$gendert = "";
	$birthday = "";
	$city = "";
	$description = "";
	$profilepic = "";
	$privacy = "";
	$privacyt = "";
	
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
		$stmt = "select profile_exists('$username');";
		$result=$con->query($stmt);
		$row = $result->fetch_array();
		$existprofile = $row[0];
		if(!$existprofile){
			$have_error=true;
			$ErrorArray[] = "Profile doesn't exist";	
		}else
		{
			// Gets current profile
			$stmt = "select * from profile where username='$username';";
			$result=$con->query($stmt);
			$row = $result->fetch_array();
	
			$firstname = $row[1];
			$lastname = $row[2];
			$gender = $row[5];
			if($gender == "1") {$gendert = "Male";} else if($gender == "2") {$gendert = "Female";} else {$gendert = "";}

			$birthday = $row[4];
			$city = $row[6];
			$description = $row[7];
			$profilepic = $row[3];
			$privacy = $row[8];
			if($privacy =="1"){$privacyt="Public";}
			else if($privacy =="2"){$privacyt="Friends or Friends of Friends";}
			else if($privacy =="3"){$privacyt="Friends";}
			else if($privacy =="4"){$privacyt="Private";}
			else{$privacy="";}

		}
		
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$profilepic = "null";//$_POST['profilepic'];
			$birthday = $_POST['birthday'];
			$gender = $_POST['gender'];
			$city = $_POST['city'];
			$description = $_POST['description'];
			$privacy = $_POST['privacy'];
			if($gender == "1") {$gendert = "Male";} else if($gender == "2") {$gendert = "Female";} else {$gendert = "";}
			
			if($privacy =="1"){$privacyt="Public";}
			else if($privacy =="2"){$privacyt="Friends or Friends of Friends";}
			else if($privacy =="3"){$privacyt="Friends";}
			else if($privacy =="4"){$privacyt="Private";}
			else{$privacy="";}
			
			if(!$existprofile and false){
				$stmt = "insert into profile values('$username','$firstname','$lastname','$profilepic','$birthday','$gender','$city','$description','$privacy');";
				$result=$con->query($stmt);
				header( 'Location: account.php' );
			}
			else
			{
				$firstname = $_POST['firstname'];
				$stmt = "update profile set firstname='$firstname',lastname='$lastname',profilepic=$profilepic,birthday='$birthday',gender='$gender',city='$city',description='$description',privacy='$privacy' where username='$username';";
				$result=$con->query($stmt);
				#echo $stmt;
				//header( 'Location: account.php' );
			}
		}
	}
?>

<div>
	<form id="editprofile" method="post" action="account.php" role="form">
		<label>First Name</label>
		<input type="text" name="firstname" class="form-control" value="<?=$firstname?>" /><br>
		
		<label>Last Name</label>
		<input type="text" name="lastname" class="form-control" value="<?=$lastname?>" /><br>
		
		<label>Profile Picture</label>
		<input type="file" name="profilepic" class="form-control" /><br>
		
		<label>Gender</label>
		<select name="gender">
			<option value="<?=$gender?>" selected="1"><?=$gendert?></option>
			<option value="1">Male</option>
			<option value="2">Female</option>
		</select><br>
		
		<label >Birthday</label>
		<input type="date" name="birthday" value="<?=$birthday?>"><br>

		<label>City</label>
		<input type="text" name="city" class="form-control" value="<?=$city?>" /><br>
		
		<label>Description</label><br>
		<textarea name="description" cols="1" rows="1"style="width: 515px; height: 153px;"><?=$description?></textarea>
		<br>
	
		<label>Privacy</label><br>
			<select name="privacy" >
				<option value="<?=$privacy?>" selected="1"><?=$privacyt?></option>
				<option value="1">Public</option>
				<option value="2">Friends or Friends of Friends</option>
				<option value="3">Friends</option>
				<option value="4">Private</option>
			</select><br>

		<button type="submit" value="SaveProfile" name="editprofile" class="btn btn-primary">Save Profile</button><br>
	</form>
</div>

