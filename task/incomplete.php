<?php
include'../include/session.php';
include'../include/db_connection.php';

$url= $_GET['url'];
$activityid = $_GET['activityid'];
echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Result</title>
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
				<form action="save_incomplete.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Are you sure you want to mark this task as incomplete?</h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					<input type="hidden" name="activityid" id="activityid" value="'.$activityid.'">
					<input type="submit" id="submit" value="Yes">
					<a onclick="goBack()" id="submit">No</a>
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
mysqli_close($con);
?>