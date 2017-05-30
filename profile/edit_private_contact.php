<?php
include'../include/session.php';

$url = $_GET['url'];
$customerid = $_GET['customerid'];
$firstname = ucwords($_GET['firstname']);
if (!empty ($firstname)){
	$line1 = 'placeholder="First Name" value="'.$firstname.'"';
}else{
	$line1 = 'placeholder="First Name"';
}

$lastname = ucwords($_GET['lastname']);
if (!empty ($lastname)){
	$line2 = 'placeholder="Last Name" value="'.$lastname.'"';
}else{
	$line2 = 'placeholder="Last Name"';
}

$email = $_GET['email'];
if (!empty ($email)){
	$line3 = 'placeholder="Email" value="'.$email.'"';
}else{
	$line3 = 'placeholder="Email"';
}

$phonenumber = $_GET['phonenumber'];
if (!empty ($phonenumber)){
	$line4 = 'placeholder="Phone Number" value="'.$phonenumber.'"';
}else{
	$line4 = 'placeholder="Phone Number"';
}

$mobilenumber = $_GET['mobilenumber'];
if (!empty ($mobilenumber)){
	$line5 = 'placeholder="Mobile Number" value="'.$mobilenumber.'"';
}else{
	$line5 = 'placeholder="Mobile Number"';
}

$fax = $_GET['fax'];
if (!empty ($fax)){
	$line6 = 'placeholder="Fax" value="'.$fax.'"';
}else{
	$line6 = 'placeholder="Fax"';
}


$lastcontacted = $_GET['lastcontacted'];
if (!empty ($lastcontacted)){
	$line8 = 'value="'.$lastcontacted.'"';
}else{
	$line8 = 'placeholder="Last Contacted"';
}

$address1 = ucwords($_GET['address1']);
if (!empty ($address1)){
	$line9 = 'placeholder="Address Line 1" value="'.ucwords($address1).'"';
}else{
	$line9 = 'placeholder="Address Line 1"';
}

$address2 = ucwords($_GET['address2']);
if (!empty ($address2)){
	$line10 = 'placeholder="Address Line 2" value="'.ucwords($address2).'"';
}else{
	$line10 = 'placeholder="Address Line 2"';
}

$address3 = ucwords($_GET['address3']);
if (!empty ($address3)){
	$line11 = 'placeholder="Address Line 3" value="'.ucwords($address3).'"';
}else{
	$line11 = 'placeholder="Address Line 3"';
}

$address4 = ucwords($_GET['address4']);
if (!empty ($address4)){
	$line12 = 'placeholder="Address Line 4" value="'.ucwords($address4).'"';
}else{
	$line12 = 'placeholder="Address Line 4"';
}

$county = $_GET['county'];
if (!empty ($county)){
	$line13 = 'placeholder="County" value="'.ucwords($county).'"';
}else{
	$line13 = 'placeholder="County"';
}

$country = $_GET['country'];
if (!empty ($country)){
	$line14 = 'placeholder="Country" value="'.ucwords($country).'"';
}else{
	$line14 = 'placeholder="Country"';
}

echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Edit contact form</title>
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
				<form action="update_private_contact.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Edit Contact</h2>
					<small><a href = "delete_contact.php?url='.$url.'&id='.$customerid.'">Delete contact</a></small>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					<input type="hidden" name="customerid" id="customerid" value="'.$customerid.'">
					<label for="firstname"><small>First Name</small></label>
					<input id="firstname" name="firstname"' .$line1. 'type="text">
					<label for="lastname"><small>Last Name</small></label>
					<input id="lastname" name="lastname"' .$line2. 'type="text">
					<label for="email"><small>Email</small></label>
					<input id="email" name="email"' .$line3. 'type="text">
					<label for="phone"><small>Phone Number</small></label>
					<input id="phone" name="phone"' .$line4. 'type="number">
					<label for="mobile"><small>Mobile Number</small></label>
					<input id="mobile" name="mobile"' .$line5. 'type="number">
					<label for="fax"><small>Fax</small></label>
					<input id="fax" name="fax"' .$line6. 'type="number">
					<label for="last_contacted"><small>Last Contacted</small></label>
					<input id="last_contacted" name="last_contacted"' .$line8. 'type="date">
					
					<label for="address"><small>Address</small></label>
					<input id="address" name="address1"' .$line9. 'type="text" maxlength = "45">
					<input id="address" name="address2"' .$line10. 'type="text" maxlength = "35">
					<input id="address" name="address3"' .$line11. 'type="text" maxlength = "35">
					<input id="address" name="address4"' .$line12. 'type="text" maxlength = "35">
					<input id="address" name="county"' .$line13. 'type="text" maxlength = "20">
					<input id="address" name="country"' .$line14. 'type="text" maxlength = "28">
					
					
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