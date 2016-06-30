<?php
$url= $_POST['url'];

$name = $_POST['name'];

$regarding = $_POST['regarding'];

$planningNumber = $_POST['planningNumber'];

$startDate = $_POST['startDate'];

$location1 = $_POST['location1'];

$location2 = $_POST['location2'];

$location3 = $_POST['location3'];

$location4 = $_POST['location4'];

$locationCounty = $_POST['locationCounty'];

$locationCountry = $_POST['locationCountry'];

$assignTo = $_POST['assign'];

$notes = $_POST['notes'];

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
				<form action="add_project_contact_worker.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Company contact details</h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					<input type="hidden" name="name" id="name" value="'.$name.'">
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
					
					<label for="companyname"><small>Company Name</small></label>
					<input id="companyname" name="companyname" type="text" required maxlength = "70">
					
					<label for="address1"><small>Address</small></label>
					<input id="address1" name="address1" type="text" placeholder="Address line 1" required maxlenght = "45">
					<input id="address2" name="address2" type="text" placeholder="Address line 2" required maxlength = "35">
					<input id="address3" name="address3" type="text" placeholder="Address line 3 (Optional)" maxlength = "35">
					<input id="address4" name="address4" type="text" placeholder="Town/City" required maxlength = "35">
					
					<select id="address" class="drop_down"  name = "county" class="form-control" required>
						<option value="" disabled selected>Select a county</option>
						<option value= "antrim">Antrim</option>
						<option value= "armagh">Armagh</option>
						<option value= "carlow">Carlow</option>
						<option value= "cavan">Cavan</option>
						<option value= "clare">Clare</option>
						<option value= "cork">Cork</option>
						<option value= "derry">Derry</option>
						<option value= "donegal">Donegal</option>
						<option value= "down">Down</option>
						<option value= "dublin">Dublin</option>
						<option value= "fermanagh">Fermanagh</option>
						<option value= "galway">Galway</option>
						<option value= "kerry">Kerry</option>
						<option value= "kildare">Kildare</option>
						<option value= "kilkenny">Kilkenny</option>
						<option value= "laois">Laois</option>
						<option value= "leitrim">Leitrim</option>
						<option value= "limerick">Limerick</option>
						<option value= "longford">Longford</option>
						<option value= "louth">Louth</option>
						<option value= "mayo">Moyo</option>
						<option value= "meath">Meath</option>
						<option value= "monaghan">Monaghan</option>
						<option value= "offaly">Offaly</option>
						<option value= "roscommon">Roscommon</option>
						<option value= "sligo">Sligo</option>
						<option value= "tipperary">Tipperary</option>
						<option value= "tyrone">Tyrone</option>
						<option value= "waterford">Waterford</option>
						<option value= "westmeath">Westmeath</option>
						<option value= "wexford">Wexford</option>
						<option value= "wicklow">Wicklow</option>
					</select>
					<input id="country" name="country" type="text" value="Ireland" maxlength = "28" required>
					
					<select id="sector" class="drop_down"  name = "sector" class="form-control" required>
						<option value="" disabled selected>Select a sector</option>
						<option value= "hse">HSE</option>
						<option value= "construction">Construction</option>
						<option value= "nursing home">Nursing home</option>
						<option value= "architecture">Architecture</option>
						<option value= "school">School</option>
						<option value= "charity">Charity</option>
						<option value= "building services">Building services</option>
					</select>
					
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