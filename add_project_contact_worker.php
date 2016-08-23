<?php
$url= $_POST['url'];

$regarding = $_POST['regarding'];

$planningNumber = $_POST['planningNumber'];

$startDate = $_POST['startDate'];

$location1 = $_POST['location1'];

$location2 = $_POST['location2'];

$location3 = $_POST['location3'];

$location4 = $_POST['location4'];

$locationCounty = $_POST['locationCounty'];

$locationCountry = $_POST['locationCountry'];

$assignTo = $_POST['assignTo'];

$notes = $_POST['notes'];
//company details
$companyname = $_POST['companyname'];

$address1 = $_POST['address1'];

$address2 = $_POST['address2'];

$address3 = $_POST['address3'];

$address4 = $_POST['address4'];

$county = $_POST['county'];

$country = $_POST['country'];

$sector = $_POST['sector'];

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
					<input type="hidden" name="companyname" id="companyname" value="'.$companyname.'">
					<input type="hidden" name="address1" id="address1" value="'.$address1.'">
					<input type="hidden" name="address2" id="address1" value="'.$address2.'">
					<input type="hidden" name="address3" id="address1" value="'.$address3.'">
					<input type="hidden" name="address4" id="address1" value="'.$address4.'">
					
					<input type="hidden" name="county" id="county" value="'.$county.'">
					<input type="hidden" name="country" id="country" value="'.$country.'">
					<input type="hidden" name="sector" id="sector" value="'.$sector.'">
					<input type="hidden" name="regarding" id="regarding" value="'.$regarding.'">
					<input type="hidden" name="planningNumber" id="planningNumber" value="'.$planningNumber.'">
					<input type="hidden" name="startDate" id="startDate" value="'.$startDate.'">
					<input type="hidden" name="location1" id="location1" value="'.$location1.'">
					<input type="hidden" name="location2" id="location2" value="'.$location2.'">
					<input type="hidden" name="location3" id="location3" value="'.$location3.'">
					<input type="hidden" name="location4" id="location4" value="'.$location4.'">
					<input type="hidden" name="locationCounty" id="locationCounty" value="'.$locationCounty.'">
					<input type="hidden" name="locationCountry" id="locationCountry" value="'.$locationCountry.'">
					<input type="hidden" name="assignTo" id="assignTo" value="'.$assignTo.'">
					<input type="hidden" name="notes" id="notes" value="'.$notes.'">
					
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