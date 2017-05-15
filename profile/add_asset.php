<?php
include'../include/session.php';

define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");//remember to chanege these when all is working
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$url= $_GET['url'];
$customerid= $_GET['customerid'];
$companyid= $_GET['companyid'];

//this is for getting the list of manufacturers
$sql = "SELECT name FROM manufacturers ORDER BY name; ";
$res = mysqli_query($con,$sql);
$manufacturers = array();
//store them in an array
while($row = mysqli_fetch_array($res)){
	array_push($manufacturers,
		array('name'=>$row[0]
	));
}

$sql2 = "SELECT asset_type FROM asset_type ORDER BY asset_type; ";
$res2 = mysqli_query($con,$sql2);
$assetType = array();

while($row = mysqli_fetch_array($res2)){
	array_push($assetType,
		array('asset_type'=>$row[0]
	));
}

mysqli_close($con);

echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Add asset</title>
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
				<form action="save_asset.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Add asset</h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					<input type="hidden" name="customerid" id="customerid" value="'.$customerid.'">
					<input type="hidden" name="companyid" id="companyid" value="'.$companyid.'">
					
					
					</select><br>
					
				
					
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
					
					<label for="model"><small>Model</small></label>
					<input id="model" name="model" placeholder = "Model" type="text" maxlength = "50"  required>
					
					<label for="serialnumber"><small>Serial number</small></label>
					<input id="serialnumber" name="serialnumber" placeholder = "Serial Number" type="text" maxlength = "50"  required>
					
					<label for="productdescription"><small>Product description</small></label>
					<textarea maxlength="300" class ="form-textarea" id="productdescription" placeholder = "Product Description" name="productdescription" type="text"></textarea>
					
					<label for="installdate"><small>Install date</small></label>
					<input id="installdate" name="installdate" type="date" required>
					
					<label for="inspectiondue"><small>Inspection due</small></label>
					<input id="inspectiondue" name="inspectiondue" type="date">
					
					<label for="servicedue"><small>Service due</small></label>
					<input id="servicedue" name="servicedue" type="date" required>
					
					<label for="location"><small>Location <small> eg Room 20</small></small></label>
					<input id="location" name="location" placeholder = "Location" type="text" maxlength = "65" required>
					
					<label for="fundedby"><small>Maintenance funded by</small></label>
					<input id="fundedby" name="fundedby" placeholder = "Funded By" type="text" maxlength = "50" required>
					
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