<?php 
	session_start();
	session_destroy();
	if(!isset ($_SESSION['username'])){
		//this bring you bac to the login page once you log out
		header("location:index.html");
	}else{
		//you need to call this page again to refresh it so that it works 
		header("location:logout.php");
		//get the next page reload here
	}
?>