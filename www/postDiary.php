<?php
    require_once 'functions.php';
	require 'template.php';

    if($isGuest){
		header('Location: /index.php');
    }

    if($_SERVER['REQUEST_METHOD']=='POST'){
		$username = $_SESSION['username'];
		$title=mysqli_real_escape_string($con, $_POST['title']);
		$content=mysqli_real_escape_string($con, $_POST['content']);
		$privacy=$_POST['privacy'];

	if(!empty($_POST['locationname'])){
		$locationname=$_POST['locationname'];
		$isnew = mysqli_query($con,"select locationid from location where locationname='$locationname'");

	    if(empty($isnew)){
			$longitude=$_POST['longitude'];
			$latitude=$_POST['latitude'];
			$result = mysqli_query($con,"insert into location(locationname, longitude, latitude) values ('$locationname',$longitude,$latitude)");
			$locationid = $result['locationid'];
	    }
	    else{
		  $row = $isnew->fetch_assoc();
		  $locationid = $row['locationid'];
	    }
	}
	else{
	    $locationid = 'NULL';
	}

	$result=mysqli_query($con, "insert into diaryentry(username, locationID, diaryTitle, diaryDesc, privacySetting) values('$username',$locationid,'$title','$content', '$privacy')");

	header("Location: diary/$diaryid");
    }

?>
