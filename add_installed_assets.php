<?php
$url= $_POST['url'];
$customerid= $_POST['customerid'];
$companyid= $_POST['companyid'];
$jobid = $_POST['jobid'];
$numberOfAssets = $_POST['assetnumber'];
echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Result</title>
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
				<form action="add_serial_numbers.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Installation Results</h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					<input type="hidden" name="customerid" id="customerid" value="'.$customerid.'">
					<input type="hidden" name="companyid" id="companyid" value="'.$companyid.'">
					<input type="hidden" name="jobid" id="jobid" value="'.$jobid.'">
					<input type="hidden" name="numberofassets" id="numberofassets" value="'.$numberOfAssets.'">
															
					<label for="assettype"><small>Asset type</small></label><br>
					<input id="assettype" name="assettype" type="text" maxlength="50" required>
					
					<label for="assetquantity"><small>Quantity of this asset type</small></label><br>
					<input id="assetquantity" name="assetquantity" type="number" required>
					
					<label for="model"><small>Model</small></label><br>
					<input id="model" name="model" type="text" maxlength="50" required>
					
					<label for="manufacturer"><small>Manufacturer</small></label><br>
					<input id="manufacturer" name="manufacturer" type="text" maxlength="50" required>
					
					<label for="productdescription"><small>Product description</small></label><br>
					<input id="productdescription" name="productdescription" type="text" maxlength="200">
					
					<label for="inspectiondate"><small>Inspection date</small></label><br>
					<input id="inspectiondate" name="inspectiondate" type="date" required>
					
					<label for="servicedate"><small>Service date</small></label><br>
					<input id="servicedate" name="servicedate" type="date" required>
					
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