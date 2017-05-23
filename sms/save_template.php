<?php
include'../include/db_connection.php';
include'../include/session.php';
//Back URL
$url= $_POST["url"];

//name of SMS template
$name = $_POST["name"];
$name = trim($name);
$name = filter_var($name, FILTER_SANITIZE_STRING);
$name = mysqli_real_escape_string($con, $name);

//SMS
$message = $_POST["message"];
$message = trim($message);
$message = filter_var($message, FILTER_SANITIZE_STRING);
$message = mysqli_real_escape_string($con, $message);

	$sql = "INSERT INTO sms (name, message) VALUES ('$name', '$message'); ";
	$res = mysqli_query($con,$sql);
	//echo $sql.'<br>';

	echo'
	<!DOCTYPE html>
	<html>
		<head>
		<title>Template Created</title>
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
					<form action="" id="form" method="post" name="form">
						<h2>Template Created</h2>
						<hr>
						<a href="'.$url.'" id="submit">OK</a>
					</form>
				</div>
			<!-- Popup Div Ends Here -->
			</div>
		</div>
		</body>
		
		<script type="text/javascript">
		function goBack() {
			window.history.go(-2);
		}
		window.onload = div_show();
		</script>
	<!-- Body Ends Here -->
	</html>';

mysqli_close($con);
?>