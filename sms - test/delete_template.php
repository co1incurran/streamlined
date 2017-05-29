<?php
include'../include/db_connection.php';
include'../include/session.php';
//Back URL
$url= $_GET["url"];

//name of SMS template
$id = $_GET["id"];
$id = trim($id);
$id = filter_var($id, FILTER_SANITIZE_STRING);
$id = mysqli_real_escape_string($con, $id);
	

	$sql = "DELETE FROM sms WHERE id = '$id'; ";
	$res = mysqli_query($con,$sql);
	echo'
	<!DOCTYPE html>
	<html>
		<head>
		<title>Delete Template</title> 
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
						<h2>Deleted</h2>
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