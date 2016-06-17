<?php
$url= $_GET['url'];
echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Add new contact</title>
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
				<form action="add_contact_details.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Add new contact</h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					
					<label for="contact"><small>Contact type:</small></label><br><br>
					<input type="radio" name="contactType" value="company" > Trade Customer<br>
					<input type="radio" name="contactType" value="private customer"> Private Customer<br>
					<input type="radio" name="contactType" value="lead" checked> Lead<br>
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