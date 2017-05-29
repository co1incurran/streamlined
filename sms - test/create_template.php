<?php
include'../include/session.php';
$url= $_GET['url'];
echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Create Template</title>
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
				<form action="save_template.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Create SMS  Template</h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					
					<label for="name"><small>Name of template:</small></label>
					<input id="name" name="name" type="text" placeholder="e.g Service Reminder" required maxlength = "50">
					
					<label for="message"><small>Message:</small></label>
					<textarea maxlength="480" placeholder = "Message (max 480 characters)" class ="form-textarea" id="message" name="message" type="text"></textarea>
					
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