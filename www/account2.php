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
			if($gender = "1") {$gendert = "Male";} else if($gender = "2") {$gendert = "Female";} else {$gendert = "";}
			
			$birthday = $row[4];
			$city = $row[6];
			$description = $row[7];
			$profilepic = $row[3];
			if($privacy ="1"){$privacyt="Public";}
			else if($privacy ="2"){$privacyt="Friends or Friends of Friends";}
			else if($privacy ="3"){$privacyt="Friends";}
			else if($privacy ="4"){$privacyt="Private";}
			else{$privacy="";}
			$privacy = $row[8];
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
<form class="form-horizontal">
<fieldset>
<!-- Form Name -->
<legend>Change Profile</legend>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="firstname">First Name</label>
  <div class="controls">
    <input id="firstname" name="firstname" type="text" placeholder="First Name" class="input-medium">
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="lastname">Last Name</label>
  <div class="controls">
    <input id="lastname" name="lastname" type="text" placeholder="Last Name" class="input-medium">
    
  </div>
</div>

<!-- File Button --> 
<div class="control-group">
  <label class="control-label" for="profilepic">Profile Picture</label>
  <div class="controls">
    <input id="profilepic" name="profilepic" class="input-file" type="file">
  </div>
</div>

<!-- Select Basic -->
<div class="control-group">
  <label class="control-label" for="gender">Gender</label>
  <div class="controls">
    <select id="gender" name="gender" class="input-medium">
      <option>Male</option>
      <option>Female</option>
    </select>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="birthday">Birthday</label>
  <div class="controls">
    <input id="birthday" name="birthday" type="date" placeholder="Birthday" class="input-xlarge">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="city">City</label>
  <div class="controls">
    <input id="city" name="city" type="text" placeholder="City" class="input-large">
    
  </div>
</div>

<!-- Textarea -->
<div class="control-group">
  <label class="control-label" for="description">Description</label>
  <div class="controls">                     
    <textarea id="description" name="description">Description</textarea>
  </div>
</div>

</fieldset>
<button type="submit" value="SaveProfile" name="editprofile" class="btn btn-primary">Save Profile</button><br>
</form>
</body>
</html>