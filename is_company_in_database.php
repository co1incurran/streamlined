<?php
$url = $_POST['url'];
$projectid = $_POST['projectid'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$mobile = $_POST['mobile'];
$fax = $_POST['fax'];
$jobtitle = $_POST['jobtitle'];
echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Add project contact</title>
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
				<form action="assign_to_company.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>What company does this contact work for?</h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
						<input type="hidden" name="projectid" id="projectid" value="'.$projectid.'">
						<input type="hidden" name="firstname" id="firstname" value="'.$firstname.'">
						<input type="hidden" name="lastname" id="lastname" value="'.$lastname.'">
						<input type="hidden" name="email" id="email" value="'.$email.'">
						<input type="hidden" name="phone" id="phone" value="'.$phone.'">
						<input type="hidden" name="mobile" id="mobile" value="'.$mobile.'">
						<input type="hidden" name="fax" id="fax" value="'.$fax.'">
						<input type="hidden" name="jobtitle" id="jobtitle" value="'.$jobtitle.'">
					
					<input type="submit" name="action" id="submit" value="Create New Company">
					<input type="submit" name="action" id="submit" value="Choose Existing">
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