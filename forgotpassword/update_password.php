<?php
	include'../include/db_connection.php';

	if(isset ($_POST["password1"])){
		$password1 = $_POST["password1"];
		//echo $password1.'<br>';
	}
	
	if(isset ($_POST["password2"])){
		$password2 = $_POST["password2"];
		//echo $password2.'<br>';
	}
	
	if(isset ($_POST["dob"])){
		$dob = $_POST["dob"];
		$dob = filter_var($dob, FILTER_SANITIZE_STRING);
		$dob = mysqli_real_escape_string($con, $dob);
	}
	
	if(isset ($_POST["maidenName"])){
		$maidenName = $_POST["maidenName"];
		$maidenName = strtolower($maidenName);
		$maidenName = filter_var($maidenName, FILTER_SANITIZE_STRING);
		$maidenName = mysqli_real_escape_string($con, $maidenName);
	}
	
	if(isset ($_POST["username"])){
		$username = $_POST["username"];
		$username = filter_var($username, FILTER_SANITIZE_STRING);
		$username = mysqli_real_escape_string($con, $username);
	}
	
	if($password1 != $password2){
		echo "<script>window.location = 'changepassword.php?dob=".$dob."&maidenName=".$maidenName."&username=".$username."&match=false'</script>";
	}else{
		
		$sql = "SELECT * FROM users WHERE userid = '$username' AND dob = '$dob' AND maiden_name = '$maidenName';";
		//echo $sql.'<br>';
		$res = mysqli_query($con,$sql);
		
		//Mysql_num_row is counting table row
		$count = mysqli_num_rows($res);

		//If result matched $myusername and $mypassword, table row must be 1 row
		if($count==1){
			$password = hash('sha512', $password1); 
			$sql2 = "UPDATE users SET password = '$password' WHERE userid = '$username';";
			//echo $sql2.'<br>';
			$res2 = mysqli_query($con,$sql2);
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
			  <header class="panel-heading"><h2 class="panel-title">Password changed</h2></header>
				<section class="panel-body">
					<!--<div class="alert alert-info"></div>-->
					<form id="form" action="../index.html" method="post" class="form-horizontal">
						<div class="form-group">
							<div class="col-sm-12">
								
								<button id= "login-btn" type="submit">Login</button>
							</div>
						</div>
					</form>
					
				</section>
			</div>
			</body>';
		}
		else {
			echo "<script>window.location = 'changepassword.php?dob=".$dob."&maidenName=".$maidenName."&username=".$username."&correct=false'</script>";
		}
	}
mysqli_close($con);
?>