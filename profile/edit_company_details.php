<?php
$url = $_GET['url'];
$companyid = $_GET['companyid'];
$name = ucwords($_GET['name']);
if (!empty ($name)){
	$line1 = 'placeholder="Company Name" value="'.$name.'"';
}else{
	$line1 = 'placeholder="Company Name"';
}

$address1 = ucwords($_GET['address_line1']);
if (!empty ($address1)){
	$line2 = 'placeholder="Address Line 1" value="'.ucwords($address1).'"';
}else{
	$line2 = 'placeholder="Address Line 1"';
}

$address2 = ucwords($_GET['address_line2']);
if (!empty ($address2)){
	$line3 = 'placeholder="Address Line 2" value="'.ucwords($address2).'"';
}else{
	$line3 = 'placeholder="Address Line 2"';
}

$address3 = ucwords($_GET['address_line3']);
if (!empty ($address3)){
	$line4 = 'placeholder="Address Line 3" value="'.ucwords($address3).'"';
}else{
	$line4 = 'placeholder="Address Line 3"';
}

$address4 = ucwords($_GET['address_line4']);
if (!empty ($address4)){
	$line5 = 'placeholder="Address Line 4" value="'.ucwords($address4).'"';
}else{
	$line5 = 'placeholder="Address Line 4"';
}

$county = $_GET['county'];
if (!empty ($county)){
	$line6 = 'placeholder="County" value="'.ucwords($county).'"';
}else{
	$line6 = 'placeholder="County"';
}

$country = $_GET['country'];
if (!empty ($country)){
	$line7 = 'placeholder="Country" value="'.ucwords($country).'"';
}else{
	$line7 = 'placeholder="Country"';
}

$sageid = $_GET['sage_id'];
if (!empty ($sageid)){
	$line8 = 'placeholder="Sage ID" value="'.$sageid.'"';
}else{
	$line8 = 'placeholder="Sage ID"';
}

$sector = $_GET['sector'];
if (!empty ($sector)){
	$line9 = 'placeholder="Sector" value="'.ucwords($sector).'"';
}else{
	$line9 = 'placeholder="Sector"';
}

echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Edit company</title>
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
				<form action="update_company_details.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Edit Contact</h2>
					<small><a href = "delete_contact.php?url='.$url.'&companyid='.$companyid.'">Delete contact</a></small>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					<input type="hidden" name="companyid" id="companyid" value="'.$companyid.'">
					
					<label for="name"><small>Company Name</small></label>
					<input id="name" name="name"' .$line1. 'type="text" maxlength="70" required>
					
					<label for="address"><small>Address</small></label>
					<input id="address1" name="address1"' .$line2. 'type="text" maxlength="45">
					
					<input id="address2" name="address2"' .$line3. 'type="text" maxlength="35">
					
					<input id="address3" name="address3"' .$line4. 'type="text" maxlength="35">
					
					<input id="address4" name="address4"' .$line5. 'type="text" maxlength="35">
					
					<input id="county" name="county"' .$line6. 'type="text" maxlength="20">

					<input id="country" name="country"' .$line7. 'type="text" maxlength="28">
					
					<label for="sageid"><small>Sage ID</small></label>
					<input id="sageid" name="sageid"' .$line8. 'type="text" maxlength="20">
					
					<label for="sector"><small>Sector</small></label>
					<input id="sector" name="sector"' .$line9. 'type="text" maxlength="30">
					
					<input type="submit" id="submit" value="Save">
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