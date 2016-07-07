<?php
/*
$host="localhost"; // Host name 
$username=""; // Mysql username 
$password=""; // Mysql password 
$db_name="test"; // Database name 
$tbl_name="members"; // Table name
*/

define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);


// Connect to server and select databse.
//mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
//mysql_select_db("$db_name")or die("cannot select DB");

// username and password sent from form 
$myusername = $_POST['username']; 
$mypassword = $_POST['password']; 

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);

$myusername = mysqli_real_escape_string($con, $myusername);
$mypassword = mysqli_real_escape_string($con, $mypassword);

$sql="SELECT * FROM users WHERE userid='$myusername' AND password='$mypassword'";
$res = mysqli_query($con,$sql);

// Mysql_num_row is counting table row
$count = mysqli_num_rows($res);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

	// Register $myusername, $mypassword and redirect to file "welcome.php"
	$_SESSION['username'] = "$myusername";
	$_SESSION['mypassword'] = "$mypassword";
	header("location:welcome.php");
}
else {
	echo "Wrong Username or Password";
}
?>