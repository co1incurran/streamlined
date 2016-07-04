<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");//remember to chanege these when all is working
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
//Back URL
$url= $_POST["url"];
$projectid = $_POST['projectid'];

//user name
$userName = $_POST["userName"];
$userName = trim($userName);
$filterUserName = filter_var($userName, FILTER_SANITIZE_STRING);
$cleanUserName = mysqli_real_escape_string($con, $filterUserName);

//project number
$planningNumber = $_POST["planningNumber"];
$planningNumber = trim($planningNumber);
$filterPlanningNumber = filter_var($planningNumber, FILTER_SANITIZE_STRING);
$cleanPlanningNumber = mysqli_real_escape_string($con, $filterPlanningNumber);

//project start date
$startDate = $_POST["startDate"];
$filterStartDate = filter_var($startDate, FILTER_SANITIZE_STRING);
$cleanStartDate = mysqli_real_escape_string($con, $filterStartDate);

//address1
$address1 = $_POST["location1"];
$address1 = trim($address1);
$address1 = strtolower($address1);
$filterAddress1 = filter_var($address1, FILTER_SANITIZE_STRING);
$cleanAddress1 = mysqli_real_escape_string($con, $filterAddress1);

//address2
$address2 = $_POST["location2"];
$address2 = trim($address2);
$address2 = strtolower($address2);
$filterAddress2 = filter_var($address2, FILTER_SANITIZE_STRING);
$cleanAddress2 = mysqli_real_escape_string($con, $filterAddress2);

//address3
$address3 = $_POST["location3"];
$address3 = trim($address3);
$address3 = strtolower($address3);
$filterAddress3 = filter_var($address3, FILTER_SANITIZE_STRING);
$cleanAddress3 = mysqli_real_escape_string($con, $filterAddress3);

//address4
$address4 = $_POST["location4"];
$address4 = trim($address4);
$address4 = strtolower($address4);
$filterAddress4 = filter_var($address4, FILTER_SANITIZE_STRING);
$cleanAddress4 = mysqli_real_escape_string($con, $filterAddress4);

//county
$county = $_POST["county"];
$county = trim($county);
$county = strtolower($county);
$filterCounty = filter_var($county, FILTER_SANITIZE_STRING);
$cleanCounty = mysqli_real_escape_string($con, $filterCounty);

//country
$country = $_POST["country"];
$country = trim($country);
$country = strtolower($country);
$filterCountry = filter_var($country, FILTER_SANITIZE_STRING);
$cleanCountry = mysqli_real_escape_string($con, $filterCountry);

//regarding
$regarding = $_POST["regarding"];
$regarding = trim($regarding);
$filterRegarding = filter_var($regarding, FILTER_SANITIZE_STRING);
$cleanRegarding = mysqli_real_escape_string($con, $filterRegarding);

//notes
$notes = $_POST["notes"];
$filterNotes = filter_var($notes, FILTER_SANITIZE_STRING);
$cleanNotes = mysqli_real_escape_string($con, $filterNotes);


$sql = "UPDATE projects SET planning_number= '$cleanPlanningNumber', est_start_date ='$cleanStartDate', address1 = '$cleanAddress1', address2 = '$cleanAddress2', address3 = '$cleanAddress3', address4 = '$cleanAddress4', county = '$county', country = '$country', regarding = '$cleanRegarding', notes = '$cleanNotes' WHERE projectid = $projectid; ";
//echo $sql;
$res = mysqli_query($con,$sql);

$sql2 = "UPDATE managed_by SET userid = '$userName' WHERE projectid = '$projectid';";
echo $sql2;
//$res2 = mysqli_query($con,$sql2);

mysqli_close($con);
echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Update Successful</title>
	<link href=".css/elements.css" rel="stylesheet">
	<script src="js/popup.js"></script>
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
					<h2>Update Successful</h2>
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