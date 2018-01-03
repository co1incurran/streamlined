<?php

	if(isset ($_GET["username"])){
		$username = $_GET["username"];
		$usernameValue = 'value = "'.$username.'"';
	}else{
		$usernameValue = '';
	}
	
	if(isset ($_GET["maidenName"])){
		$maidenName = $_GET["maidenName"];
		$maidenNameValue = 'value = "'.$maidenName.'"';
	}else{
		$maidenNameValue = '';
	}
	
	if(isset ($_GET["dob"])){
		$dob = $_GET["dob"];
		$dobValue = 'value = "'.$dob.'"';
	}else{
		$dobValue = '';
	}
	
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
	  <header class="panel-heading"><h2 class="panel-title">Security questions</h2></header>
		<section class="panel-body">
			<!--<div class="alert alert-info"></div>-->
			<form id="form" action="update_password.php" method="post" class="form-horizontal">';
				if(isset ($_GET["correct"])){
						echo "<small id='changepswd-errmsg'>The data you supplied is incorrect</small>";
				}
				echo'
				<div class="form-group">
					<div class="col-sm-12">
						<label for= "username" class = "changepswd-label" ><small class="security-label">Username</small></label>
						<input type="text" id="username" class="form-control security" '.$usernameValue.' name="username" required="required" placeholder="Username" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<label for= "dob" class = "changepswd-label"><small class="security-label">Date of birth</small></label>
						<input type="date" id="dob" class="form-control security" '.$dobValue.' name="dob" required="required" placeholder="Date of birth" />
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-12">
						<label for= "dob" class = "changepswd-label"><small class="security-label">Mother&#39s maiden name</small></label>
						<input type="text" id="maidenName" class="form-control security" '.$maidenNameValue.' name="maidenName" required="required" placeholder="Mother&#39s maiden name" />
					</div>
				</div>';
				
					if(isset ($_GET["match"])){
						echo "<small id='changepswd-errmsg'>The passwords you entered do not match</small>";
					}
				
				echo'
				<div class="form-group">
					<div class="col-sm-12">
						<label for= "password1" class = "changepswd-label"><small class="security-label">New password</small></label>
						<input type="password" id="password1" class="form-control security"  name="password1" required="required" placeholder="New password" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						<label for= "password2" class = "changepswd-label"><small class="security-label">Re-type new password</small></label>
						<input type="password" id="password2" class="form-control security"  name="password2" required="required" placeholder="Re-type password" />
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-12">
						<!--<span class="pull-left">
							<input type="checkbox" id="remember" class="" value="1" name="remember"/>
							<label class="choice" for="remember">Remember me</label>
						</span>-->
						
						<button id= "login-btn" type="submit">Change password</button>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
						
						<a id= "cancel-changing-password" href = "../index.html">Cancel</a>
					</div>
				</div>
			

			</form>
			<!--<ul><li><strong>HELP!</strong>&nbsp;<a href="#">I forgot my password!</a></li></ul>-->
		</section>
	</div>
	</body>';
?>
