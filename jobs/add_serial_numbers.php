<?php
include'../include/session.php';

$url= $_POST['url'];
$customerid= $_POST['customerid'];
$companyid= $_POST['companyid'];
$jobid = $_POST['jobid'];
$numberOfAssets = $_POST['numberOfAssets'];
$assettype = $_POST['assettype'];
$thisAssetQuantity = $_POST['thisAssetQuantity'];
$model = $_POST['model'];
$manufacturer = $_POST['manufacturer'];
$productdescription = $_POST['productdescription'];

//$servicedate = $_POST['servicedate'];
$totalNumberOfAssets = $_POST['totalNumberOfAssets'];
if (isset($_POST['inspection'])){
	$inspection = true;
}else{
	$inspection = false;
}


if($thisAssetQuantity > $numberOfAssets){
echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Result</title>
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
				<form action="add_serial_numbers.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>ERROR</h2>
					<hr>
					<p>The number of assets is greater than the total number of assets you claim to have installed.</p>
					<p>Total number of assets left to add: '.$numberOfAssets.'</p>
					<p>Number of this type of asset: '.$thisAssetQuantity.'.</p>
					<a onclick="goBack()" id="submit">Change number of this asset</a>
					<a href= "'.$url.'" id="submit">Start again</a>
					<a href = "'.$url.'" id="submit">Cancel</a>
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
}else{
	
echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Result</title>
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
				<form action="save_installed_asset.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Serial number & location</h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					<input type="hidden" name="customerid" id="customerid" value="'.$customerid.'">
					<input type="hidden" name="companyid" id="companyid" value="'.$companyid.'">
					<input type="hidden" name="jobid" id="jobid" value="'.$jobid.'">
					<input type="hidden" name="numberofassets" id="numberofassets" value="'.$numberOfAssets.'">
					<input type="hidden" name="assettype" id="assettype" value="'.$assettype.'">
					<input type="hidden" name="thisAssetQuantity" id="thisAssetQuantity" value="'.$thisAssetQuantity.'">
					<input type="hidden" name="model" id="model" value="'.$model.'">
					<input type="hidden" name="manufacturer" id="manufacturer" value="'.$manufacturer.'">
					<input type="hidden" name="productdescription" id="productdescription" value="'.$productdescription.'">
					<input type="hidden" name="inspection" id="inspection" value="'.$inspection.'">
					<input type="hidden" name="totalNumberOfAssets" id="totalNumberOfAssets" value="'.$totalNumberOfAssets.'">';
					$i=0;
				while($i < $thisAssetQuantity){
					echo'
					<h3>'.($i+1).'</h3>
					<label for="serialnumber'.$i.'"><small>Serial Number</small></label><br>
					<input id="serialnumber'.$i.'" name="serialnumber'.$i.'" type="text" maxlength="50" required>
					
					<label for="worksheetnumber'.$i.'"><small>Work sheet number</small></label><br>
					<input id="worksheetnumber'.$i.'" name="worksheetnumber'.$i.'" type="text" maxlength="65" required>
					
					<label for="location'.$i.'"><small>Location <small>eg Room 12</small></small></label><br>
					<input id="location'.$i.'" name="location'.$i.'" type="text" maxlength="65">';
					
					$i++;
				}
				echo'	
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
}
?>