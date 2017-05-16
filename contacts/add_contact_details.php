<?php
include'../include/session.php';
$url= $_POST['url'];
$contactType = $_POST['contactType'];
//echo $url.'<br>'.$contactType;

if(isset ($_POST['leadtype'])){
	$leadType = $_POST['leadtype'];
}else{
	$leadType = '';
}

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
			<!-- Contact Us Form -->';
			if($contactType == 'private customer' || $leadType == 'private customer'){
				echo'
				<form action="save_new_private_customer.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Contact details</h2>
					<hr>
						<input type="hidden" name="url" id="url" value="'.$url.'">
						<input type="hidden" name="contactType" id="contactType" value="'.$contactType.'">
					
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
						<input id="address2" name="address2" type="text" placeholder="Address line 2 (Optional)" maxlength = "35">
						<input id="address3" name="address3" type="text" placeholder="Address line 3 (Optional)" maxlength = "35">
						<input id="address4" name="address4" type="text" placeholder="Town/City" required maxlength = "35">
						<select id="county" class="drop_down"  name = "county" class="form-control" required>
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
						<input id="country" name="country" type="text" value="Ireland" maxlength = "28">
						
						<label for="sageid"><small>Sage ID</small></label>
						<input id="sageid" name="sageid" type="text" maxlength = "20">
						
						<input type="submit" id="submit" value="Next">
						<a onclick="goBack()" id="submit">Cancel</a>
				</form>';
					}elseif ($contactType == 'company'|| $leadType == 'company'){
						echo'						
						<form action="add_company_contact.php" id="form" method="post" name="form">
							<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
							<h2>Contact details</h2>
							<hr>
							<input type="hidden" name="url" id="url" value="'.$url.'">
							<input type="hidden" name="contactType" id="contactType" value="'.$contactType.'">
						
							<label for="companyname"><small>Company Name</small></label>
							<input id="companyname" name="companyname" type="text" placeholder = "Company Name" required maxlength = "70">
							
							<label for="address1"><small>Address</small></label>
							<input id="address1" name="address1" type="text" placeholder="Address line 1" required maxlenght = "45">
							<input id="address2" name="address2" type="text" placeholder="Address line 2 (Optional)" maxlength = "35">
							<input id="address3" name="address3" type="text" placeholder="Address line 3 (Optional)" maxlength = "35">
							<input id="address4" name="address4" type="text" placeholder="Town/City" required maxlength = "35">
							<select id="county" class="drop_down"  name = "county" class="form-control" required>
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
							<input id="country" name="country" type="text" value="Ireland" maxlength = "28">
							
							<label for="sector"><small>Sector</small></label>
							<input id="sector" name="sector" type="text" required maxlength = "30">
							
							<label for="sageid"><small>Sage ID</small></label>
							<input id="sageid" name="sageid" type="text" maxlength = "20">
							
							<input type="submit" id="submit" value="Next">
							<a onclick="goBack()" id="submit">Cancel</a>
						</form>';
					}else{
						echo'
						<form action="add_contact_details.php" id="form" method="post" name="form">
							<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
							<h2>Lead type</h2>
							<hr>
							<input type="hidden" name="url" id="url" value="'.$url.'">
							<input type="hidden" name="contactType" id="contactType" value="'.$contactType.'">
						
							<label for="contact"><small>Lead type:</small></label><br><br>
							<label><input type="radio" name="leadtype" value="company" checked> Company<br></label>
							<label><input type="radio" name="leadtype" value="private customer"> Private Customer<br></label>
							
							<input type="submit" id="submit" value="Next">
							<a onclick="goBack()" id="submit">Cancel</a>
						</form>';
					}
					echo'
					
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