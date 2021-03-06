<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");//remember to chanege these when all is working
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

//STOCKID
$stockid = $_POST["stockid"];
$stockid = trim($stockid);
$stockid = strtolower($stockid);
$filterstockid = filter_var($stockid, FILTER_VALIDATE_INT);
$cleanstockid = mysqli_real_escape_string($con, $filterstockid);

//PRODUCT
$product = $_POST["name"];
$product = trim($product);
$product = strtolower($product);
$filterproduct = filter_var($product, FILTER_SANITIZE_STRING);
$cleanproduct= mysqli_real_escape_string($con, $filterproduct);

//Model
$model = $_POST["model"];
$model = trim($model);
$model = strtolower($model);
$filtermodel = filter_var($model, FILTER_SANITIZE_STRING);
$cleanmodel = mysqli_real_escape_string($con, $filtermodel);

//Manufacturer
$manufacturer = $_POST["manufacturer"];
$manufacturer = trim($manufacturer);
$manufacturer = strtolower($manufacturer);
$filtermanufacturer = filter_var($manufacturer, FILTER_SANITIZE_STRING);
$cleanmanufacturer = mysqli_real_escape_string($con, $filtermanufacturer);

//installation date
$installationdate = $_POST["installationdate"];
$installationdate = trim($installationdate);
$cleaninstallationdate = mysqli_real_escape_string($con, $installationdate);

//inspection date
$inspectiondate = $_POST["inspectiondate"];
$inspectiondate = trim($inspectiondate);
$cleaninspectiondate = mysqli_real_escape_string($con, $inspectiondate);

//service date
$servicedate = $_POST["servicedate"];
$servicedate = trim($servicedate);
$cleanservicedate = mysqli_real_escape_string($con, $servicedate);

//location
$location = $_POST["location"];
$location = trim($location);
$location = strtolower($location);
$filterlocation = filter_var($location, FILTER_SANITIZE_STRING);
$cleanlocation = mysqli_real_escape_string($con, $filterlocation);

//contract renewal date
$contractrenewaldate = $_POST["contractrenewaldate"];
$contractrenewaldate = trim($contractrenewaldate);
$cleanlservicedate = mysqli_real_escape_string($con, $contractrenewaldate);

//LAST results
$lastresults = $_POST["lastresults"];
$lastresults = trim($lastresults);
//$lastresults = strtolower($lastresults);
$filterlastresults = filter_var($lastresults, FILTER_SANITIZE_STRING);
$cleanlastresults = mysqli_real_escape_string($con, $filterlastresults);

//Maintenance funded by
$fundedby = $_POST["fundedby"];
$fundedby = trim($fundedby);
$fundedby = strtolower($fundedby);
$filterfundedby = filter_var($fundedby, FILTER_SANITIZE_STRING);
$cleanfundedby = mysqli_real_escape_string($con, $filterfundedby);

//Product Description
$productdescription = $_POST["productdescription"];
$productdescription = trim($productdescription);
//$productdescription = strtolower($productdescription);
$filterproductdescription = filter_var($productdescription, FILTER_SANITIZE_STRING);
$cleanproductdescription = mysqli_real_escape_string($con, $filterproductdescription);

//Serial id 
$serialid = $_POST["serialid"];
$serialid = trim($serialid);
//$productdescription = strtolower($productdescription);
$filterserialid = filter_var($serialid, FILTER_SANITIZE_STRING);
$cleanserialid = mysqli_real_escape_string($con, $filterserialid);

$sql = "UPDATE stock SET serialid= '$cleanserialid', name= '$cleanproduct', model= '$cleanmodel', manufacturer= '$cleanmanufacturer', product_description= '$cleanproductdescription', installation_date= '$cleaninstallationdate', inspection_date= '$cleaninspectiondate', service_date= '$cleanservicedate' WHERE stockid= $cleanstockid; ";
//echo $cleanphone;
//echo $sql;
$res = mysqli_query($con,$sql);

mysqli_close($con);
echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Update Successful</title>
	<link href="../css/elements.css" rel="stylesheet">
	<script src="js/popup.js"></script>
	</head>
<!-- Body Starts Here -->
	<body>
	<div id="bbody">
		<div id="abc">
			<!-- Popup Div Starts Here -->
			<div id="ppopupContact">
			<!-- Contact Us Form -->
				<form action="" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Update Successful</h2>
					<hr>
					<input type="hidden" name="stockid" id="stockid" value="$stockid">
					<label for="name"><small>Product</small></label>
					<input id="name" name="name"type="text">';
					
					/*<label for="model"><small>Model</small></label>
					<input id="model" name="model"' .$line2. 'type="text">
					
					<label for="manufacturer"><small>Manufacturer</small></label>
					<input id="manufacturer" name="manufacturer"' .$line3. 'type="text">
					
					<label for="serialid"><small>Serial Number</small></label>
					<input id="serialid" name="serialid"' .$line12. 'type="text">
					
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
					<!--<a href="javascript:%20check_empty()" id="submit">Save</a>-->*/
					echo'
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