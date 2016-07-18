<?php
//this is the session to ensure a user is logged in
	session_start();
	if(!isset ($_SESSION['username'])){
		header("location:index.html");
	}
	$userLoggedOn = $_SESSION['username'];
	
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$activityid = $_POST['activityid'];
$sql = "UPDATE activity SET new = '0' WHERE activityid = '$activityid';";
$res = mysqli_query($con,$sql);
mysqli_close($con);

  header("Location: tasks.php");
  exit();

?>