<?php
	include'../include/session.php';
	include'../include/db_connection.php';

	$sql2 = "SELECT userid FROM users;";
	$res2 = mysqli_query($con,$sql2);
	$usernames = array();
	//$names = array("Colin", "Pat", "Mary");

	while($row = mysqli_fetch_array($res2)){
		$usernames[] = $row['userid'];
	}
	
	if(isset ($_POST["email"])){
		$email = $_POST["email"];
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		$email = mysqli_real_escape_string($con, $email);
	}
	
	if(isset ($_POST["user-password"])){
		$password1 = $_POST["user-password"];
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
		//get the name of the user and check if it is in the array
		//echo $username.'<br>';
		
		if (in_array($username, $usernames)){
			//echo " in array";
			echo "<script>window.location = 'create_user.php?email=".$email."&dob=".$dob."&maidenName=".$maidenName."&username=".$username."&taken=true&firstname=".$fname."&lastname=".$lname."'</script>";
			
		}elseif($password1 != $password2 || !(isset($_POST["user-password"]) && isset($_POST["retype-password"]))){
			echo "<script>window.location = 'create_user.php?email=".$email."&dob=".$dob."&maidenName=".$maidenName."&username=".$username."&match=false'</script>";
		}else{
			//get all the data and put it into the database
			$password = hash('sha512', $password1); 
			//echo $password.'<br>';
			//echo $email.'<br>';
			//echo $dob.'<br>';
			//put the rest of the stuff into the database but clean it first 
			//get the rest of the 
			$sql = "INSERT INTO users (userid, first_name, last_name, email, password, maiden_name, dob) VALUES ('$username', '$fname', '$lname', '$email', '$password', '$maidenName', '$dob'); ";
			$res = mysqli_query($con,$sql); 
			//echo $sql;
			
			echo'
				<!DOCTYPE html>
				<html>
					<head>
					<title>Create User</title>
					<link href="../css/elements.css" rel="stylesheet">
					<script src="../js/popup.js"></script>
					</head>
				<!-- Body Starts Here -->
					<body>
					<div id="body" style="overflow:hidden;">
						<div id="abc">
							<!-- Popup Div Starts Here -->
							<div id="popupContact">
							<!-- Contact Us Form -->
								<form action="save_new_user.php" id="form" method="post" name="form">
									<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
									<h2>User Created</h2>
									<hr>
									</select><br>
									
									<a href="users.php" id="submit">Ok</a>
								</form>
							</div>
						<!-- Popup Div Ends Here -->
						</div>
					</div>
					</body>
					<script type="text/javascript">
					window.onload = div_show();
					</script>
				<!-- Body Ends Here -->
				</html>';
		}
	} 
mysqli_close($con);

?>