<?php
echo'
	<!DOCTYPE html>
	<html>
		<head>
		<title>Contact details</title>
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
					<form action="send_sms.php" id="form" method="post" name="form">
						<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
						<h2>Contact details</h2>
						<hr>

							<label for="mobilenumber"><small>Mobile Number</small></label>
							<input id="mobilenumber" name="mobilenumber" type="number" required maxlength = "12">
							
							<label for="message"><small>Message</small></label>
							<textarea class ="form-textarea" id="message" name="message" type="text"></textarea>
							
							<input type="submit" id="submit" value="Next">
							<a onclick="goBack()" id="submit">Cancel</a>
					</form>';
						
						echo'
						
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