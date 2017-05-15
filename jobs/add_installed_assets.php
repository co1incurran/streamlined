<?php
include'../include/session.php';

define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

if(isset($_POST['setter'])){
	$totalNumberOfAssets = $_POST['numberOfAssets'];
}

if(isset($_POST['totalNumberOfAssets'])){
	$totalNumberOfAssets = $_POST['totalNumberOfAssets'];
}

$url = $_POST['url'];
$customerid = $_POST['customerid'];
$companyid = $_POST['companyid'];
$jobid = $_POST['jobid'];
$numberOfAssets = $_POST['numberOfAssets'];

$sql = "SELECT name FROM manufacturers ORDER BY name; ";
$res = mysqli_query($con,$sql);
$manufacturers = array();

while($row = mysqli_fetch_array($res)){
	array_push($manufacturers,
		array('name'=>$row[0]
	));
}
//print_r (array_values($manufacturers));

$sql2 = "SELECT asset_type FROM asset_type ORDER BY asset_type; ";
$res2 = mysqli_query($con,$sql2);
$assetType = array();

while($row = mysqli_fetch_array($res2)){
	array_push($assetType,
		array('asset_type'=>$row[0]
	));
}
//print_r (array_values($assetType));

if($totalNumberOfAssets < 1){
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
				<form action="" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>ERROR</h2>
					<hr>
					<p>The number of assets installed must be at least 1.</p>
					<p>The number you provided was: '.$totalNumberOfAssets.'</p>
					<p>Please change this to the correct value.</p>
					
					<a onclick="goBack()" id="submit">Change</a>
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
				<form action="add_serial_numbers.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Asset details</h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					<input type="hidden" name="customerid" id="customerid" value="'.$customerid.'">
					<input type="hidden" name="companyid" id="companyid" value="'.$companyid.'">
					<input type="hidden" name="jobid" id="jobid" value="'.$jobid.'">
					<input type="hidden" name="numberOfAssets" id="numberOfAssets" value="'.$numberOfAssets.'">
					<input type="hidden" name="totalNumberOfAssets" id="totalNumberOfAssets" value="'.$totalNumberOfAssets.'">	
					
					
					<label for="assettype"><small>Asset type</small><small class="edit-button"><a href = "edit_asset_list.php">Options</a></small></label><br>
					<select id="assettype"class="drop_down"  name = "assettype" class="form-control" required>
					<option value="" disabled selected>Please Choose</option>
					<option value= "hoist">Hoist</option>';
					foreach ($assetType as $at){
						$type = $at['asset_type'];
						echo'<option value= "'.$type.'">'.ucwords($type).'</option>';
					}
					echo'
					</select><br>
					
					<label for="manufacturer"><small>Manufacturer</small><small class="edit-button"><a href = "edit_manufacturer_list.php">Options</a></small></label><br>
					<select id="manufacturer"class="drop_down"  name = "manufacturer" class="form-control" required>
					<option value="" disabled selected>Please Choose</option>
					<option value= "guldmann">Guldmann</option>';
					foreach ($manufacturers as $m){
						$man = $m['name'];
						echo'<option value= "'.$man.'">'.ucwords($man).'</option>';
					}
					echo'
					</select><br>
					
					<label for="model"><small>Model</small></label><br>
					<input id="model" name="model" type="text" maxlength="50" required>
					
					
					<label for="thisAssetQuantity"><small>Quantity of this asset type</small></label><br>
					<input id="thisAssetQuantity" name="thisAssetQuantity" type="number" required>			
					
					
					<label for="productdescription"><small>Product description</small></label><br>
					<input id="productdescription" name="productdescription" type="text" maxlength="200">
					
					<!--<label for="inspectiondate"><small>Inspection date</small></label><br>
					<input id="inspectiondate" name="inspectiondate" type="date" required>-->
					
					<label><input type="checkbox" name="inspection" value="inspection"> Inspection required<br></label>
					
					<!--echo date("F, 1 Y", strtotime("-6 months", strtotime("Feb 2, 2010")));-->
					
					<!--<label for="servicedate"><small>Service date</small></label><br>
					<input id="servicedate" name="servicedate" type="date" required>-->
					
					<!--<input type="checkbox" name="service" value="service" checked> Service required<br>-->
					
					<input type="submit" id="submit" value="Next">
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
}
mysqli_close($con);
?>