<?php 
	require_once 'functions.php';
	require 'template.php';
	/*
	function getPermission($privacy, $username, $target, $con)
	{
		if(!isset($_GET["username"])) return true;
		else if($privacy=="1") return true;
		else if($privacy=="2")
		{
			$stmt =	"select count(*) from ((SELECT username2 as friends
					FROM FriendsWith 
					WHERE username1 = '$target') UNION 
					(SELECT username1 as friends
					FROM FriendsWith
					WHERE username2 = '$target')) as tbl1
					where friends = '$username';";

			$result = $con->query($stmt);	
			$row = $result->fetch_array();
			if($row)
			{
				echo "yes";
			}else	echo "no";
			echo $stmt;
		}
		else if($privacy=="3")
		{	
			
		}
		else if($privacy=="4") return $username == $target;
		else return false;
	}
	echo getPermission("2","kevin","bobjoe", $con);
	*/
	
	$have_error=false;
	$ErrorArray=array();

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
		
		$stmt = "select * from profile where username='$username';";
		$result=$con->query($stmt);
		$row = $result->fetch_array();
		if(!$row){
			$have_error=true;
			$ErrorArray[] = "Profile doesn't exist";
			echo 
				'<div class="profile">'.$username.'\'s Profile doesn\'t exist.<br></div>';	
		}
		else
		{
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
			
			/*
		
			echo '<div class="profile">
					<!-- profile pic -->
					<table cellspacing="1" cellpadding="0" border="0">
						<thead>
							'.$username.'\'s Profile
						</thead>
						<tbody>
							<tr><td>First Name</td><td>'.$firstname.'</td></tr>
							<tr><td>Last Name</td><td>'.$lastname.'</td></tr>
							<tr><td>Gender</td><td>'.$gender.'</td></tr>
							<tr><td>Birthday</td><td>'.date($birthday).'</td></tr>
							<tr><td>City</td><td>'.$city.'</td></tr>
							<tr><td>Privacy</td><td>'.$privacyt.'</td></tr>
							<tr><td>Description</td><td>'.$description.'</td></tr>
						</tbody>
					</table>

				</div>';*/
				
		}
	}
?>

<div class="profile">
   <div class="col-sm-6 col-md-3">
		<div class="thumbnail">
			<img src="bobjoe.jpg" 
			alt="Profile thumbnail">
		</div>
		<div class="caption">
			<h3><?=$firstname?> <?=$lastname?></h3>
			<p>
			<b>First Name: </b><?=$firstname?><br>
			<b>Last Name: </b><?=$lastname?><br>
			<b>Gender: </b><?=$gender?><br>
			<b>Birthday: </b><?=date($birthday)?><br>
			<b>City: </b><?=$city?><br>
			<b>Privacy: </b><?=$privacyt?><br>
			<b>Description: </b><?=$description?><br>
			</p>
			<p>
			<a href="#" class="btn btn-primary" role="button">
               Friends
            </a> 
			</p>
		</div>
	</div>
</div>
</body>
</html>