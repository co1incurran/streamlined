<?php
include'../include/session.php';
$url= $_POST['url'];
$contactType = $_POST['contactType'];
$companyName = $_POST["companyname"];
$address1 = $_POST["address1"];
$address2 = $_POST["address2"];
$address3 = $_POST["address3"];
$address4 = $_POST["address4"];
$county = $_POST["county"];
$country = $_POST["country"];
$sector = $_POST["sector"];
$sageid = $_POST["sageid"];

echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Contact details</title>
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
				<form action="save_new_company.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Add contact details for a person in the company.</h2>
					<hr>
						<input type="hidden" name="url" id="url" value="'.$url.'">
						<input type="hidden" name="contactType" id="contactType" value="'.$contactType.'">
						<input type="hidden" name="companyname" id="companyname" value="'.$companyName.'">
						<input type="hidden" name="address1" id="address1" value="'.$address1.'">
						<input type="hidden" name="address2" id="address2" value="'.$address2.'">
						<input type="hidden" name="address3" id="address3" value="'.$address3.'">
						<input type="hidden" name="address4" id="address4" value="'.$address4.'">
						<input type="hidden" name="county" id="cunty" value="'.$county.'">
						<input type="hidden" name="country" id="country" value="'.$country.'">
						<input type="hidden" name="sector" id="sector" value="'.$sector.'">
						<input type="hidden" name="sageid" id="sageid" value="'.$sageid.'">
						
					
						<label for="firstname"><small>First Name</small></label>
						<input id="firstname" name="firstname" type="text" required maxlength = "20">
						
						<label for="lastname"><small>Last Name</small></label>
						<input id="lastname" name="lastname" type="text" maxlength = "30">
						
						<label for="email"><small>Email</small></label>
						<input id="email" name="email" type="email" maxlenght = "50">
						
						<label for="phone"><small>Phone Number</small></label>
						<input id="phone" name="phone" type="number" maxlength = "15">
						
						<label for="mobile"><small>Mobile Number</small></label>
						<input id="mobile" name="mobile" type="number" maxlength = "15">
						
						<label for="fax"><small>Fax</small></label>
						<input id="fax" name="fax" type="number" maxlength = "15">
						
						<label for="jobtitle"><small>Job title</small></label>
						<input id="jobtitle" name="jobtitle" type="text" required maxlength = "20">
						
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