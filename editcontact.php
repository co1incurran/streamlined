<?php
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
//settype($lastcontacted, "date");
if (!empty ($lastcontacted)){
	$line8 = 'placeholder="Last Contacted" value="'.$lastcontacted.'"';
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
				<form action="update_contact.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Edit Contact</h2>
					<hr>
					<input id="firstname" name="firstname"' .$line1. 'type="text">
					<input id="lastname" name="lastname"' .$line2. 'type="text">
					<input id="email" name="email"' .$line3. 'type="email">
					<input id="phone" name="phone"' .$line4. 'type="number">
					<input id="mobile" name="mobile"' .$line5. 'type="number">
					<input id="fax" name="fax"' .$line6. 'type="number">
					<input id="job_title" name="job_title"' .$line7. 'type="text">
					<input id="last_contacted" name="last_contacted"' .$line8. 'type="text" onfocus="(this.type="date")">
					<a href="javascript:%20check_empty()" id="submit">Save</a>
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