<?php

//this is the session to ensure a user is logged in
	session_start();
	if(!isset ($_SESSION['username'])){
		header("location:../index.html");
	}
	$userLoggedOn = $_SESSION['username'];
?>