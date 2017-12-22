<?php
include'../include/session.php';
//include'../include/db_connection.php';

	if(isset ($_GET["email"])){
		$email = $_GET["email"];
		$emailValue = 'value = "'.$email.'"';
		//echo $emailValue;
	}else{
		$emailValue = '';
	}
	
	
	if(isset ($_GET["dob"])){
		$dob = $_GET["dob"];
		$dobValue = 'value = "'.$dob.'"';
	}else{
		$dobValue = '';
	}
	
	if(isset ($_GET["maidenName"])){
		$maidenName = $_GET["maidenName"];
		$maidenNameValue = 'value = "'.$maidenName.'"';
	}else{
		$maidenNameValue = '';
	}

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
						
						<input placeholder="Username" id="username" name="username" required type="text" maxlenght = "50">
						
						<input id="email" required '.$emailValue.' placeholder ="Email" name="email" type="email" maxlenght = "50">
						
						
						
						<input id= "user-password" placeholder="Password" required name="user-password" type="password">

						<input id ="retype-password" placeholder="Re-type password"  required name="retype-password" type="password">
						
						<br></br><label>Security Questions:</label>
						
						<br></br><label for= "dob" ><small>Date of birth</small></label>
						<input id="dob" required '.$dobValue.' placeholder = "Date of birth" name="dob" type="date" >
						
						<label for= "maiden-name" ><small>Mother&#39s maiden name</small></label>
						<input id="maiden-name" '.$maidenNameValue.' name = "maiden-name" required type="text" maxlenght = "50">
					
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
?>