<?php
include'../include/session.php';
include'../include/db_connection.php';
//$url = $_POST['url'];<input type="hidden" name="url" id="url" value="'.$url.'">

$selected = false;
	if(!empty($_POST['assetType'])) {
		$selected = true;
		foreach($_POST['assetType'] as $assetid) {
				
				$sql = "DELETE FROM asset_type WHERE assetid = '$assetid';";
				$res = mysqli_query($con,$sql);
				
		}
	}
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
				<form action="edit_asset_list.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>';
					if ($selected == true){
						echo'Assets Removed';
					}else{
						echo'No assets selected';
					}
					echo'
					</h2>
					<hr>
					<a href = "edit_asset_list.php" id="submit">OK</a>
					<!--<a onclick="goBack()" id="submit">OK</a>-->
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