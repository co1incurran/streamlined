<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");//remember to chanege these when all is working
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
//Back URL
$url= $_POST["url"];

$companyid = $_POST["choose-contact"];
$companyid = trim($companyid);
$companyid = strtolower($companyid);
$filtercompanyid = filter_var($companyid, FILTER_SANITIZE_STRING);
$cleancompanyid = mysqli_real_escape_string($con, $filtercompanyid);

$projectid = $_POST["projectid"];
$projectid = trim($projectid);
$projectid = strtolower($projectid);
$filterprojectid = filter_var($projectid, FILTER_SANITIZE_STRING);
$cleanprojectid = mysqli_real_escape_string($con, $filterprojectid);

//the stuff below this is the data for the worker in the company
//First name
$firstname = $_POST["firstname"];
$firstname = trim($firstname);
$firstname = strtolower($firstname);
$filterfirstname = filter_var($firstname, FILTER_SANITIZE_STRING);
$cleanfirstname = mysqli_real_escape_string($con, $filterfirstname);

//last name
$lastname = $_POST["lastname"];
$lastname = trim($lastname);
$lastname = strtolower($lastname);
$filterlastname = filter_var($lastname, FILTER_SANITIZE_STRING);
$cleanlastname = mysqli_real_escape_string($con, $filterlastname);

//phone
$phone = $_POST["phone"];
$phone = trim($phone);
$filterphone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
$cleanphone= mysqli_real_escape_string($con, $filterphone);

//mobile
$mobile = $_POST["mobile"];
$mobile = trim($mobile);
$filtermobile = filter_var($mobile, FILTER_SANITIZE_NUMBER_INT);
$cleanmobile= mysqli_real_escape_string($con, $filtermobile);

//email
$email = $_POST["email"];
$email = trim($email);
$email = strtolower($email);
$filteremail = filter_var($email, FILTER_SANITIZE_EMAIL);
$cleanemail = mysqli_real_escape_string($con, $filteremail);

//fax
$fax = $_POST["fax"];
$fax = trim($fax);
$filterfax = filter_var($fax, FILTER_SANITIZE_NUMBER_INT);
$cleanfax= mysqli_real_escape_string($con, $filterfax);

//job title
$jobTitle = $_POST["jobtitle"];
$jobTitle = trim($jobTitle);
$jobTitle = strtolower($jobTitle);
$filterJobTitle = filter_var($jobTitle, FILTER_SANITIZE_STRING);
$cleanJobTitle = mysqli_real_escape_string($con, $filterJobTitle);

$sqlChecker = "SELECT * FROM workers WHERE first_name = '$cleanfirstname' AND last_name = '$cleanlastname' AND phone_num = '$cleanphone' AND mobile_phone_num = '$cleanmobile' AND email = '$cleanemail' AND fax = '$cleanfax' AND job_title = '$cleanJobTitle' AND workerid IN (SELECT workerid FROM works_with WHERE companyid = '$cleancompanyid'); ";

$result = mysqli_query($con,$sqlChecker);
//echo $sqlChecker.'<br>';


if (mysqli_num_rows($result) == 0){

	$sql = "INSERT INTO workers (first_name, last_name, phone_num, mobile_phone_num, email, fax, job_title) VALUES ('$cleanfirstname', '$cleanlastname', '$cleanphone', '$cleanmobile', '$cleanemail', '$cleanfax', '$cleanJobTitle'); ";

	$res = mysqli_query($con,$sql);
	echo $sql.'<br>';
	
	$sql4 = "SELECT workerid FROM workers ORDER BY workerid DESC LIMIT 1; ";
	$res4 = mysqli_query($con,$sql4);
	$row = mysqli_fetch_assoc($res4);
	$workerid = $row["workerid"];
	//echo $workerid.'<br>';

	$sql2 = "INSERT INTO works_with (workerid, companyid) VALUES ('$workerid','$cleancompanyid'); ";
	$res2 = mysqli_query($con,$sql2);
	//$row = mysqli_fetch_assoc($res2);
	//$companyid = $row["companyid"];
	echo $sql2.'<br>';

	$sql3 = "INSERT INTO worker_to_project (workerid, projectid) VALUES ('$workerid', '$cleanprojectid');";
	$res3 = mysqli_query($con,$sql3);
	echo $sql3.'<br>';

	echo'
	<!DOCTYPE html>
	<html>
		<head>
		<title>Contact Created</title>
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
					<form action="" id="form" method="post" name="form">
						<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
						<h2>Contact Created</h2>
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
}else{
	echo'
	<!DOCTYPE html>
	<html>
		<head>
		<title>Contact Created</title>
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
					<form action="" id="form" method="post" name="form">
						<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
						<h2>Contact already exists</h2>
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
}
mysqli_close($con);
?>