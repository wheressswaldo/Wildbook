<?php 
	require_once 'functions.php';
	require 'template.php';
	

	$isLoggedIn= checkLogin();
	if(!$isLoggedIn){
		header("Location: index.php");
	}

?>
