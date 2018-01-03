<?php
session_start();

include'../include/db_connection.php';

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
	//echo "Wrong Username or Password".'<br>';
	echo'
	<!DOCTYPE html>
	<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<title>Enable Supplies - CRM System</title>

	<!-- Compiled and minified Bootstrap CSS -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

	<!-- Compiled and minified FontAwesome CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

	<link rel="stylesheet" media="screen" href="../css/style.css" />

	</head>
	<body class="login">
		<div class="login-box main-content panel panel-default">
		  <header class="panel-heading"><h2 class="panel-title">Wrong login details</h2></header>
			<section class="panel-body">
				<!--<div class="alert alert-info"></div>-->
				<form id="form" action="../index.html" method="post" class="form-horizontal">
					
					<div class="form-group">
					  <div class="col-sm-12">
						<!--<span class="pull-left">
							<input type="checkbox" id="remember" class="" value="1" name="remember"/>
							<label class="choice" for="remember">Remember me</label>
						</span>-->
						
						<button id= "login-btn" type="submit">Try again</button>
					</div>
				</div>
				<a id = "forgotpass" href = "../forgotpassword/changepassword.php"><small>Forgot your password?</small></a>
				</form>
				<!--<ul><li><strong>HELP!</strong>&nbsp;<a href="#">I forgot my password!</a></li></ul>-->
			</section>
		</div>
	</body>
	</html>';
}
?>