<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");//remember to chanege these when all is working
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

//I need to get the id of the user and change the active value to false in the table
foreach($_POST['checkbox'] as $userid) {
	$sql = "UPDATE users SET active = 1 WHERE userid = '$userid';";
	$res = mysqli_query($con,$sql);
	echo $sql.'<br>';
	echo $userid.'<br>';
}
//also go back and adda  activate button to  the form before this to reactivate a user 
mysqli_close($con);
?>