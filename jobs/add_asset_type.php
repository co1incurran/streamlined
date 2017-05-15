<?php
include'../include/session.php';
include'../include/db_connection.php';

$sql2 = "SELECT * FROM asset_type ORDER BY asset_type; ";
$res2 = mysqli_query($con,$sql2);
$assetType = array();

while($row = mysqli_fetch_array($res2)){
	array_push($assetType,
		array('assetid'=>$row[0],
			'asset_type'=>$row[1]
	));
}
//print_r (array_values($assetType));
echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Asset List</title>
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
				<form action="add_to_asset_list.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Add Asset</h2>
					<hr>
					<label for="asset"><small>Asset:</small></label>
					<input id="asset" name="asset" type="text" placeholder = "Asset Name" maxlength = "70" required>
					
					<input type="submit" id="submit" value="Add">
					<!--<a href="javascript:%20check_empty()" id="submit">Save</a>-->
					<a onclick="goBack()" id="submit">Back</a>
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
mysqli_close($con);
?>