<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$asset = $_POST['asset'];
$asset = trim($asset);
$asset = strtolower($asset);
$filterasset = filter_var($asset, FILTER_SANITIZE_STRING);
$cleanasset = mysqli_real_escape_string($con, $filterasset);

$sql = "SELECT * FROM asset_type WHERE asset_type = '$asset';";
$res = mysqli_query($con,$sql);
if(mysqli_num_rows($res) == 0){
	$sql2 = "INSERT INTO asset_type (asset_type) VALUES ('$asset');";
	$res2 = mysqli_query($con,$sql2);
	$title = "Assets Added";
}else{
	$title = "Asset Already Exists";
}
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
				<form action="edit_asset_list.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>'.$title.'</h2>
					<hr>
					
					<a onclick="goBack()" id="submit">OK</a>
				</form>
			</div>
		<!-- Popup Div Ends Here -->
		</div>
	</div>
	</body>

	<script>
	function goBack() {
		window.history.go(-2);
	}
	</script>
	
	<script type="text/javascript">
	window.onload = div_show();
	</script>
<!-- Body Ends Here -->
</html>';
mysqli_close($con);
?>