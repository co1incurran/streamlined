<?php
$url= $_GET['url'];
$projectid = $_GET['projectid'];

if ($_POST['action'] == 'Yes') {
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
					<form action="process_closed_project.php" id="form" method="post" name="form">
						<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
						<h2>Close Project</h2>
						<hr>
						<input type="hidden" name="url" id="url" value="'.$url.'">
						<input type="hidden" name="projectid" id="projectid" value="'.$projectid.'">
																
						<label for="numberOfAssets">Please provide </label><br>
						
						<input type="submit" id="submit" value="Yes">
						<input type="submit" id="submit" value="No">
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
}elseif ($_POST['action'] == 'No') {
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
					<form action="process_closed_project.php" id="form" method="post" name="form">
						<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
						<h2>Close Project</h2>
						<hr>
						<input type="hidden" name="url" id="url" value="'.$url.'">
						<input type="hidden" name="projectid" id="projectid" value="'.$projectid.'">
																
						<label for="numberOfAssets">Did we win the project?</label><br>
						
						<input type="submit" id="submit" value="Yes">
						<input type="submit" id="submit" value="No">
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
}
?>