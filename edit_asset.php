<?php
$workerid= $_GET['worker_number'];

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

$jobtitle = $_GET['jobtitle'];
if (!empty ($jobtitle)){
	$line7 = 'placeholder="Job Title" value="'.$jobtitle.'"';
}else{
	$line7 = 'placeholder="Job Title"';
}

$lastcontacted = $_GET['lastcontacted'];
if (!empty ($lastcontacted)){
	$line8 = 'value="'.$lastcontacted.'"';
}else{
	$line8 = 'placeholder="Last Contacted"';
}

echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Edit contact form</title>
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
				<form action="php/update_worker_info.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Edit Asset</h2>
					<hr>
					<input type="hidden" name="stockid" id="stockid" value="'.$stockid.'">
					<label for="name"><small>Product</small></label>
					<input id="name" name="name"' .$line1. 'type="text">
					<label for="model"><small>Model</small></label>
					<input id="model" name="model"' .$line2. 'type="text">
					<label for="maufacturer"><small>Manufacturer</small></label>
					<input id="maufacturer" name="maufacturer"' .$line3. 'type="text">
					<label for="installationdate"><small>Install Date</small></label>
					<input id="installationdate" name="installationdate"' .$line4. 'type="date">
					<label for="mobile"><small>Mobile Number</small></label>
					<input id="mobile" name="mobile"' .$line5. 'type="number">
					<label for="fax"><small>Fax</small></label>
					<input id="fax" name="fax"' .$line6. 'type="number">
					<label for="job_title"><small>Job Title</small></label>
					<input id="job_title" name="job_title"' .$line7. 'type="text">
					<label for="last_contacted"><small>Last Contacted</small></label>
					<input id="last_contacted" name="last_contacted"' .$line8. 'type="date">
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