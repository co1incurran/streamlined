<?php
	include'../include/db_connection.php';

	if(isset ($_POST["password1"])){
		$password1 = $_POST["password1"];
	}
	
	if(isset ($_POST["retype-password"])){
		$password2 = $_POST["retype-password"];
	}
	
	if(isset ($_POST["dob"])){
		$dob = $_POST["dob"];
		$dob = filter_var($dob, FILTER_SANITIZE_STRING);
		$dob = mysqli_real_escape_string($con, $dob);
	}
	
	if(isset ($_POST["maiden-name"])){
		$maidenName = $_POST["maiden-name"];
		$maidenName = strtolower($maidenName);
		$maidenName = filter_var($maidenName, FILTER_SANITIZE_STRING);
		$maidenName = mysqli_real_escape_string($con, $maidenName);
	}
	
	if(isset ($_POST["firstname"])){
		$fname = $_POST["firstname"];
		$fname = filter_var($fname, FILTER_SANITIZE_STRING);
		$fname = mysqli_real_escape_string($con, $fname);
	}
	
	if(isset ($_POST["lastname"])){
		$lname = $_POST["lastname"];
		$lname = filter_var($lname, FILTER_SANITIZE_STRING);
		$lname = mysqli_real_escape_string($con, $lname);
	}
	
	if(isset ($_POST["username"])){
		$username = $_POST["username"];
		$username = filter_var($username, FILTER_SANITIZE_STRING);
		$username = mysqli_real_escape_string($con, $username);
	}
		
?>