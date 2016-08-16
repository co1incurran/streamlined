<?php
$url= $_GET['url'];
$projectid = $_GET['projectid'];

echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Close Project</title>
	<link href="css/elements.css" rel="stylesheet">
	<script src="js/popup.js"></script>
	</head>
<!-- Body Starts Here -->
	<body>
	<div id="body" style="overflow:hidden;">
		<div id="abc">
			<!-- Popup Div Starts Here -->
			<div id="popupContact">
			<!-- Contact Us Form -->
				<form action="process_closed_projects.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Are you sure you want to reopen this project?</h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					<input type="hidden" name="projectid" id="projectid" value="'.$projectid.'">
				
					<input type="submit" id="submit" name="reopen" value="Yes">
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
?>