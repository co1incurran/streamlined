<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

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
				<form action="update_asset_list.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Asset List</h2>
					<hr>
					<a href = "add_asset_type.php">Add Asset</a><br><br>';

				
					foreach ($assetType as $at){
						$type = $at['asset_type'];
						$id = $at['assetid'];
						echo'<label><input type="checkbox" name="assetType[]" value="'.$id.'">'.ucwords($type).'<br></label>';
					}
		
					echo'
					<input type="submit" id="submit" value="Remove">
					<!--<a href="javascript:%20check_empty()" id="submit">Save</a>-->
					<a onclick="getPage()" id="submit">Done</a>
				</form>
			</div>
		<!-- Popup Div Ends Here -->
		</div>
	</div>
	</body>
	<script>
	function getPage() {
		window.history.go(http://localhost/enablesupplieswebsite/streamlined/add_installed_assets.php");
	}
	</script>
	<script type="text/javascript">
	 	
	window.onload = div_show();
	</script>
	
<!-- Body Ends Here -->
</html>';
mysqli_close($con);
?>