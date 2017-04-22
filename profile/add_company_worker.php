<?php
$url= $_GET['url'];
$customerid= $_GET['customerid'];
$companyid= $_GET['companyid'];

echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Add Contact</title>
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
				<form action="save_contact.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Add contact</h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					<input type="hidden" name="customerid" id="customerid" value="'.$customerid.'">
					<input type="hidden" name="companyid" id="companyid" value="'.$companyid.'">
					
					
					<label for="firstname"><small>First name</small></label>
					<input id="firstname" name="firstname" placeholder = "First name" type="text" maxlength = "20"  required>
					
					<label for="lastname"><small>Last name</small></label>
					<input id="lastname" name="lastname" placeholder = "Last name" type="text" maxlength = "30" >
					
					<label for="phone"><small>Phone number</small></label>
					<input id="phone" name="phone" placeholder = "Phone number" type="number" max = "999999999999999">
					
					<label for="mobile"><small>Mobile number</small></label>
					<input id="mobile" name="mobile" placeholder = "Mobile number" type="number" max = "999999999999999">
					
					<label for="email"><small>Email</small></label>
					<input id="email" name="email" placeholder = "Email address" type="email" maxlength = "50">
					
					<label for="fax"><small>Fax</small></label>
					<input id="fax" name="fax" placeholder = "Fax" type="number" max = "999999999999999">
					
					<label for="jobtitle"><small>Job title</small></label>
					<input id="jobtitle" name="jobtitle" placeholder = "Job title" type="text" maxlength = "65">
					
					<input type="submit" id="submit" value="Save">
					<!--<a href="javascript:%20check_empty()" id="submit">Save</a>-->
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