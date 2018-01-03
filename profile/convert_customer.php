<?php
include'../include/session.php';
include'../include/db_connection.php';
//Back URL
$url= $_POST["url"];
//echo $url;


//COMPANYID
if(isset($_POST['customerid'])){
	$customerid = $_POST["customerid"];
}

//put the activity into the activty table
$sql = "UPDATE customer SET lead = 0 WHERE customerid = $customerid;";
//echo $sql;
$res = mysqli_query($con,$sql);
//echo $sql1;

		
mysqli_close($con);
echo'<!DOCTYPE html>
<html>
	<head>
	<title>Converted</title>
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
					<h2>Converted</h2>
					<hr>
					<a href="../profile/profile.php?customerid='.$customerid.'&companyid=0" id="submit">OK</a>
				</form>
			</div>
		<!-- Popup Div Ends Here -->
		</div>
	</div>
	</body>
	<script type="text/javascript">
	function goBack() {
		window.history.go(-2);
	}
	window.onload = div_show();
	</script>
<!-- Body Ends Here -->
</html>';
?>