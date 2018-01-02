<?php
/*
$host="localhost"; // Host name 
$username=""; // Mysql username 
$password=""; // Mysql password 
$db_name="test"; // Database name 
$tbl_name="members"; // Table name
*/
session_start();

include'../include/db_connection.php';


// Connect to server and select databse.
//mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
//mysql_select_db("$db_name")or die("cannot select DB");

// username and password sent from form 
$username = $_POST['username']; 
$password = hash('sha512', $_POST['password']); 
//echo $password;

// To protect MySQL injection (more detail about MySQL injection)
$username = stripslashes($username);
//$password = stripslashes($password);

//hashing
//$hashed = hash('sha512', $data);

$username = mysqli_real_escape_string($con, $username);
//$password = mysqli_real_escape_string($con, $password);

$sql="SELECT * FROM users WHERE userid='$username' AND password='$password'";
$res = mysqli_query($con,$sql);

// Mysql_num_row is counting table row
$count = mysqli_num_rows($res);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

	// Register $myusername, $mypassword and redirect to file "welcome.php"
	$_SESSION['username'] = $username;
	$_SESSION['password'] = $password;
	//$_SESSION['mypassword'] = "$mypassword";
	
	
	header("location:welcome.php");
	//echo ("{$_SESSION['username']}");
}
else {
	//echo $password.'<br>';
	//echo $sql.'<br>';
	echo "Wrong Username or Password".'<br>';
	
}
?>