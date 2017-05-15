<?php
include'../include/session.php';

define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$url= $_POST['url'];
$projectid = $_POST['projectid'];
$projectid = trim($projectid);
$filterprojectid = filter_var($projectid, FILTER_VALIDATE_INT);
$cleanprojectid = mysqli_real_escape_string($con, $filterprojectid);

if(isset($_POST['reopen'])){
		if($_POST['reopen'] == 'Yes') {
			$sql = "UPDATE projects SET closed = '0', won = '0' WHERE projectid = '$cleanprojectid'; ";
			$res3 = mysqli_query($con,$sql);
			
			//echo $sql;
			echo'
			<!DOCTYPE html>
			<html>
				<head>
				<title>Close Project</title>
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
								<h2>This project is reopen</h2>
								<hr>
																		
								<a href="'.$url.'" id="submit">OK</a>
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
}elseif($_POST['action'] == 'Yes') {
	
	$sql = "UPDATE projects SET closed = '1', won = '1' WHERE projectid = '$cleanprojectid'; ";
	$res = mysqli_query($con,$sql);
	
	//echo $sql;
	echo'
	<!DOCTYPE html>
	<html>
		<head>
		<title>Close Project</title>
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
						<h2>Project Closed</h2>
						<hr>
																
						<a href="'.$url.'" id="submit">OK</a>
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
}elseif ($_POST['action'] == 'No') {
	$sql = "UPDATE projects SET closed = '1', won = '0' WHERE projectid = '$cleanprojectid'; ";
	$res = mysqli_query($con,$sql);
	
	//echo $sql;
	echo'
	<!DOCTYPE html>
	<html>
		<head>
		<title>Close Project</title>
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
						<h2>Project Closed</h2>
						<hr>
																
						<a href="'.$url.'" id="submit">OK</a>
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