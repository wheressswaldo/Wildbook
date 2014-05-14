<html>

<?php
require_once 'functions.php';

$isLoggedIn= checkLogin();
if($isLoggedIn){
	header("Location: home.php");
}
?>

<head>
	<title> Wildbook </title>
</head>

<body style="background:none">
       
	<div id="index">
        <a id="login" class="btn btn-default btn-lg" href="/wildbook/login.php">Log In</a>
        <a id="signup" class="btn btn-default btn-lg" href="/wildbook/signup.php">Sign Up</a>
    </div>
</body>
</html>