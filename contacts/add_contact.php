<?php
include'../include/session.php'
$url= $_GET['url'];
echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Add new contact</title>
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
				<form action="add_contact_details.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Add new contact</h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					
					<label for="contact"><small>Contact type:</small></label><br><br>
					<label><input type="radio" name="contactType" value="company" checked> Company<br></label>
					<label><input type="radio" name="contactType" value="private customer"> Private Customer<br></label>
					<label><input type="radio" name="contactType" value="lead" > Lead<br></label>
					<input type="submit" id="submit" value="Next">
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