<?php

$url = $_POST['url'];

if ($_POST['action'] == 'New Contact') {
    //ask them to fill out the details here
	//what is if is a new contact and the company they work for already exists?
	//should ask them if it is a new compnay or contact
	//get the company info first then the individual info
	//look
	
	
	
	
	
	
	
} else if ($_POST['action'] == 'Choose Existing') {
    //show a search box to find people and companies with a JQuery plugin 
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
			<!-- Contact Us Form -->
				<form action="save_new_private_customer.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Contact details</h2>
					<hr>
						<input type="hidden" name="url" id="url" value="'.$url.'">
					
						<label for="firstname"><small>First Name</small></label>
						<input id="firstname" name="firstname" type="text" required maxlength = "20">
						
						<label for="lastname"><small>Last Name</small></label>
						<input id="lastname" name="lastname" type="text" required maxlength = "30">
						
						<label for="email"><small>Email</small></label>
						<input id="email" name="email" type="email" maxlenght = "50">
						
						<label for="phone"><small>Phone Number</small></label>
						<input id="phone" name="phone" type="number" maxlength = "15">
						
						<label for="mobile"><small>Mobile Number</small></label>
						<input id="mobile" name="mobile" type="number" maxlength = "15">
						
						<label for="fax"><small>Fax</small></label>
						<input id="fax" name="fax" type="number" maxlength = "15">
						
						<label for="address1"><small>Address</small></label>
						<input id="address1" name="address1" type="text" placeholder="Address line 1" required maxlenght = "45">
						<input id="address2" name="address2" type="text" placeholder="Address line 2" required maxlength = "35">
						<input id="address3" name="address3" type="text" placeholder="Address line 3 (Optional)" maxlength = "35">
						<input id="address4" name="address4" type="text" placeholder="Town/City" required maxlength = "35">
						<input id="county" name="county" type="text" placeholder= "County" maxlength = "20">
						<input id="country" name="country" type="text" value="Ireland" maxlength = "28">
						
						<label for="sageid"><small>Sage ID</small></label>
						<input id="sageid" name="sageid" type="text" maxlength = "20">
						
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
	
} else {
    //dont think this is necessary
}
?>