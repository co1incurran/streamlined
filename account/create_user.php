<?php
include'../include/session.php';
include'../include/db_connection.php';
$sql3 = "SELECT department FROM users WHERE userid = '$userLoggedOn';";
//echo $sql3;
$res3 = mysqli_query($con,$sql3);
$row = mysqli_fetch_assoc($res3);
$type = $row['department'];
if($type == 'admin'){

			if(isset ($_GET["email"])){
				$email = $_GET["email"];
				$emailValue = 'value = "'.$email.'"';
				
			}else{
				$emailValue = '';
			}
			
			if(isset ($_GET["taken"])){
				//message to say the username is already taken
				$warning = '<label for= "username" ><small id="errorMessage">This username is already taken</small></label>';
			}else{
				$warning = '';
			}
			
			if(isset ($_GET["match"])){
				//message to say the passwords match
				$message= '<label for= "user-password" ><small id="errorMessage">The passwords do not match</small></label>';
			}else{
				$message = '';
			}
			
			if(isset ($_GET["dob"])){
				$dob = $_GET["dob"];
				$dobValue = 'value = "'.$dob.'"';
			}else{
				$dobValue = '';
			}
			
			if(isset ($_GET["firstname"])){
				$fname = $_GET["firstname"];
				$fnameValue = 'value = "'.$fname.'"';
			}else{
				$fnameValue = '';
			}
			
			if(isset ($_GET["lastname"])){
				$lname = $_GET["lastname"];
				$lnameValue = 'value = "'.$lname.'"';
			}else{
				$lnameValue = '';
			}

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
			//get the password and then encrypt it and store the encrypted version

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
							<h2>Create User</h2>
							<hr>
							</select><br>
								'.$warning.'
								<input placeholder="Username" '.$usernameValue.' id="username" name="username" required type="text" maxlenght = "50">
								
								<input placeholder="First name" '.$fnameValue.' id="firstname" name="firstname" required type="text" maxlenght = "20">
								
								<input placeholder="Last name" '.$lnameValue.' id="lastname" name="lastname" required type="text" maxlenght = "30">
								
								<input id="email" required '.$emailValue.' placeholder ="Email" name="email" type="email" maxlenght = "50">
								
								'.$message.'
								<input id= "user-password" placeholder="Password" required name="user-password" type="password">

								<input id ="retype-password" placeholder="Re-type password"  required name="retype-password" type="password">
								
								<br></br><label>Security Questions:</label>
								
								<br></br><label for= "dob" ><small>Date of birth</small></label>
								<input id="dob" required '.$dobValue.' placeholder = "Date of birth" name="dob" type="date" >
								
								<label for= "maiden-name" ><small>Mother&#39s maiden name</small></label>
								<input id="maiden-name" '.$maidenNameValue.' name = "maiden-name" placeholder = "Maiden name" required type="text" maxlenght = "50">
							
								<input type="submit" id="submit" value="Save"> 
								
							<a onclick="goBack()" id="submit">Cancel</a>
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
}else{
	echo'<!DOCTYPE html>
			<html>
				<head>
				<title>Edit Users</title>
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
							<form action="set_users_deactive.php" id="form" method="post" name="form">
								<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
								<h2>Access Denied</h2>
								<hr>
								</select><br>
								<a onclick="goBack()" id="submit">Ok</a>
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

?>