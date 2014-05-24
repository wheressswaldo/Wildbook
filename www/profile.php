<?php 
	require_once 'functions.php';
	require 'template.php';
	
	function getRelationship($con,$username,$target)
	{
		if($username != $target)
		{
			$stmt = "select 1 from ((SELECT username2 as friends
					FROM FriendsWith 
					WHERE username1 = '$target') UNION 
					(SELECT username1 as friends
					FROM FriendsWith
					WHERE username2 = '$target')) as tbl1
					where friends = '$username';";
			$result = $con->query($stmt);	
			$row = $result->fetch_array();
			if($row[0])
			{
				return "friend";
			}
			else 
			{
				$stmt = "select 1 from friendrequest where usernameFrom = '$username' and usernameTo = '$target';";
				$result = $con->query($stmt);	
				$row = $result->fetch_array();
				if($row[0])
				{
					return "friendreq";
				} else return "notfriend";
			}
		}
		else return "";
	}

	
	
	function getPermission($privacy, $username, $target, $con)
	{
		if(!isset($_GET["username"]) or $username = $_GET["username"]) return true;
		else if($privacy=="1") return true;
		else if($privacy=="2")
		{
			$stmt =	"select 1 from ((SELECT username2 as friends
					FROM FriendsWith 
					WHERE username1 = '$target') UNION 
					(SELECT username1 as friends
					FROM FriendsWith
					WHERE username2 = '$target')) as tbl1
					where friends = '$username';";

			$result = $con->query($stmt);	
			$row = $result->fetch_array();
			if($row[0])
			{
				return true;
			}else return false;
		}
		else if($privacy=="3")
		{	
			if(getPermission("2", $username, $target, $con)) {return true;}
			else {
				$stmt="select 1 from ((SELECT username2 as friends
					FROM 
					((SELECT username2 as friends
					FROM FriendsWith 
					WHERE username1 = '$target') UNION 
					(SELECT username1 as friends
					FROM FriendsWith
					WHERE username2 = '$target')) as firstFriend JOIN FriendsWith
					WHERE firstFriend.friends = FriendsWith.username1)  UNION
					(SELECT username1
					FROM 
					((SELECT username2 as friends
					FROM FriendsWith 
					WHERE username1 = '$target') UNION 
					(SELECT username1 as friends
					FROM FriendsWith
					WHERE username2 = '$target')) as firstFriend JOIN FriendsWith
					WHERE firstFriend.friends = FriendsWith.username2)) as tbl1 where friends = '$username';";
				$result = $con->query($stmt);
				$row = $result->fetch_array();
				if($row[0])
				{
					return true;
				}else return false;
			}
		}
		else if($privacy=="4") return $username == $target;
		else return false;
	}
	
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
	$addfriend = "";
	
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
				'<div class="newdiv">'.$username.'\'s Profile doesn\'t exist.<br></div>';	
		}
		else
		{
			$privacy = $row[8];
			if(getPermission($privacy, $_SESSION['username'], $username, $con))
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
				
				
				$user = $_SESSION['username']; 
				$target = $username;
				if(getRelationship($con,$user,$target) == "notfriend")
				{
					$addfriend = '<a href="addfriend.php?username='.$target.'" class="btn btn-primary" role="button">
					   Add Friend
					</a>';
				}
				else if(getRelationship($con,$user,$target) == "friendreq")
				{
					$addfriend = '<a href="" class="btn btn-primary" role="button">
						   Added
						</a>';
				}
			}				
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
			<?=$addfriend?>
			</p>
		</div>
	</div>
</div>

<div>
<?php
	require_once 'functions.php';
	require 'display.php';
	
	if (!checkLogin()){
		$have_error=true;
		$ErrorArray[] = "Username is empty";
	}
	else {
		$username = $_SESSION['username'];
		if(isset($_GET["username"])) {$username = $_GET["username"];}
		$stmt = "select * from diaryEntry where username= '$username';";
		$result = $con->query($stmt);	
		
		while($row = $result->fetch_array())
		{			
			displayEntry($row["username"], $row["diaryTitle"],$row["diaryDesc"],$row["timeposted"], $row["lastedited"]);		
		}
	}
?>
</div>
</body>
</html>