<?php
include'../include/session.php';
include'../include/db_connection.php';

//Back URL
$url= $_POST["url"];

if(isset($_POST["activityid"])){
	echo 'here';
	$activityid= $_POST["activityid"];
	$sql1 = "UPDATE activity SET complete = 0 WHERE activityid = $activityid;";
}elseif(isset($_POST["jobid"])){
	$jobid= $_POST["jobid"];
	$sql1 = "UPDATE jobs SET complete = 0 WHERE jobid = $jobid;";
}
echo $sql1;
$res1 = mysqli_query($con,$sql1);

mysqli_close($con);
echo'<!DOCTYPE html>
<html>
	<head>
	<title>Marked as incomplete</title>
	<link href=".../css/elements.css" rel="stylesheet">
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
					<h2>Marked as incomplete</h2>
					<hr>
					<a href="'.$url.'" id="submit">OK</a>
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