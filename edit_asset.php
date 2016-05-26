<?php
$url= $_GET['url'];
$stockid= $_GET['stockid'];

$name = ucwords($_GET['name']);
if (!empty ($name)){
	$line1 = 'placeholder="Product" value="'.$name.'"';
}else{
	$line1 = 'placeholder="Product"';
}

$model = ucwords($_GET['model']);
if (!empty ($model)){
	$line2 = 'placeholder="Model" value="'.$model.'"';
}else{
	$line2 = 'placeholder="Model"';
}

$manufacturer = $_GET['manufacturer'];
if (!empty ($manufacturer)){
	$line3 = 'placeholder="Manufacturer" value="'.$manufacturer.'"';
}else{
	$line3 = 'placeholder="Manufacturer"';
}

$installationdate = $_GET['installationdate'];
if (!empty ($installationdate)){
	$line4 = 'placeholder="Install Date" value="'.$installationdate.'"';
}else{
	$line4 = 'placeholder="Install Date"';
}

$inspectiondate = $_GET['inspectiondate'];
if (!empty ($inspectiondate)){
	$line5 = 'placeholder="Inspection Date" value="'.$inspectiondate.'"';
}else{
	$line5 = 'placeholder="Inspection Date"';
}

$servicedate = $_GET['servicedate'];
if (!empty ($servicedate)){
	$line6 = 'placeholder="Service Date" value="'.$servicedate.'"';
}else{
	$line6 = 'placeholder="Service Date"';
}

$location = $_GET['location'];
if (!empty ($location)){
	$line7 = 'placeholder="Location" value="'.$location.'"';
}else{
	$line7 = 'placeholder="Location"';
}

$contractrenewaldate = $_GET['contractrenewaldate'];
if (!empty ($contractrenewaldate)){
	$line8 = 'placeholder="Contract Renewal Date" value="'.$contractrenewaldate.'"';
}else{
	$line8 = 'placeholder="Contract Renewal Date"';
}

$lastresults = $_GET['lastresults'];
if (!empty ($lastresults)){
	$line9 = 'placeholder="Last Results" value="'.$lastresults.'"';
}else{
	$line9 = 'placeholder="Last Results"';
}

$fundedby = $_GET['fundedby'];
if (!empty ($fundby)){
	$line10 = 'placeholder="Funded By" value="'.$fundedby.'"';
}else{
	$line10 = 'placeholder="Funded By"';
}

$productdescription = $_GET['productdescription'];
if (!empty ($productdescription)){
	$line11 = 'placeholder="Product Description" value="'.$productdescription.'"';
}else{
	$line11 = 'placeholder="Product Description"';
}

$serialid = $_GET['serialid'];
if (!empty ($serialid)){
	$line12 = 'placeholder="Serial Number" value="'.$serialid.'"';
}else{
	$line12 = 'placeholder="Serial Number"';
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
				<form action="update_asset.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Edit Asset</h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					<input type="hidden" name="stockid" id="stockid" value="'.$stockid.'">
					<label for="name"><small>Product</small></label>
					<input id="name" name="name"' .$line1. 'type="text" required>
					
					<label for="model"><small>Model</small></label>
					<input id="model" name="model"' .$line2. 'type="text" required>
					
					<label for="manufacturer"><small>Manufacturer</small></label>
					<input id="manufacturer" name="manufacturer"' .$line3. 'type="text" required>
					
					<label for="serialid"><small>Serial Number</small></label>
					<input id="serialid" name="serialid"' .$line12. 'type="text" required>
					
					<label for="installationdate"><small>Install Date</small></label>
					<input id="installationdate" name="installationdate"' .$line4. 'type="date">
					
					<label for="inspectiondate"><small>Inspection Date</small></label>
					<input id="inspectiondate" name="inspectiondate"' .$line5. 'type="date">
					
					<label for="servicedate"><small>Service Due</small></label>
					<input id="servicedate" name="servicedate"' .$line6. 'type="date">
					
					<label for="location"><small>Location<small> (eg room 1 - first floor)</small></small></label>
					<input id="location" name="location"' .$line7. 'type="text">
					
					<label for="contractrenewaldate"><small>Service Contract Renewal Date</small></label>
					<input id="contractrenewaldate" name="contractrenewaldate"' .$line8. 'type="date">
					
					<label for="lastresults"><small>Last Results</small></label>
					<textarea maxlength="300" class ="form-textarea" id="lastresults" name="lastresults"' .$line9. 'type="text"></textarea>
					
					<label for="fundedby"><small>Maintenance Funded By<small> (eg owner or HSE etc)</small></small></label>
					<input id="fundedby" name="fundedby"' .$line10. 'type="text">
					
					<label for="productdescription"><small>Product Description</small></label>
					<textarea maxlength="300" class ="form-textarea" id="productdescription" name="productdescription"' .$line11. 'type="text"></textarea>
					
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