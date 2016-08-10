<?php
$url= $_POST['url'];

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
				<form action="save_project_details.php" id="form" method="post" name="form">
					<h2>'.ucwords($sector).' Contact</h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">

					
					<label for="firstname"><small>First Name</small></label>
					<input id="firstname" name="firstname" placeholder = "First Name" type="text" required maxlength = "20">
					
					<label for="lastname"><small>Last Name</small></label>
					<input id="lastname" name="lastname" placeholder = "Last Name" type="text" required maxlength = "30">
					
					<label for="email"><small>Email</small></label>
					<input id="email" name="email" placeholder = "Email" type="email" maxlenght = "50">
					
					<label for="phone"><small>Phone Number</small></label>
					<input id="phone" name="phone" placeholder = "Phone Number" type="number" maxlength = "15">
					
					<label for="mobile"><small>Mobile Number</small></label>
					<input id="mobile" name="mobile" placeholder = "Mobile Number" type="number" maxlength = "15">
					
					<label for="fax"><small>Fax</small></label>
					<input id="fax" name="fax" placeholder = "Fax" type="number" maxlength = "15">
					
					<label for="jobtitle"><small>Job title</small></label>
					<input id="jobtitle" name="jobtitle" placeholder = "Job Title" type="text" required maxlength = "20">
					
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