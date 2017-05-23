<?php
include'../include/db_connection.php';
include'../include/session.php';
//Back URL
$url= $_POST["url"];
$contactType = $_POST['contactType'];

//company name
$companyName = $_POST["companyname"];
$companyName = trim($companyName);
$companyName = strtolower($companyName);
$filterCompanyName = filter_var($companyName, FILTER_SANITIZE_STRING);
$cleanCompanyName = mysqli_real_escape_string($con, $filterCompanyName);

//Address1
$address1 = $_POST["address1"];
$address1 = trim($address1);
$address1 = strtolower($address1);
$filterAddress1 = filter_var($address1, FILTER_SANITIZE_STRING);
$cleanAddress1 = mysqli_real_escape_string($con, $filterAddress1);

//Address2
$address2 = $_POST["address2"];
$address2 = trim($address2);
$address2 = strtolower($address2);
$filterAddress2 = filter_var($address2, FILTER_SANITIZE_STRING);
$cleanAddress2 = mysqli_real_escape_string($con, $filterAddress1);

//Address3
$address3 = $_POST["address3"];
$address3 = trim($address3);
$address3 = strtolower($address3);
$filterAddress3 = filter_var($address3, FILTER_SANITIZE_STRING);
$cleanAddress3 = mysqli_real_escape_string($con, $filterAddress3);

//Address4
$address4 = $_POST["address4"];
$address4 = trim($address4);
$address4 = strtolower($address4);
$filterAddress4 = filter_var($address4, FILTER_SANITIZE_STRING);
$cleanAddress4 = mysqli_real_escape_string($con, $filterAddress4);

//County
$county = $_POST["county"];
$county = trim($county);
$county = strtolower($county);
$filterCounty = filter_var($county, FILTER_SANITIZE_STRING);
$cleanCounty = mysqli_real_escape_string($con, $filterCounty);

//Country
$country = $_POST["country"];
$country = trim($country);
$country = strtolower($country);
$filterCountry = filter_var($country, FILTER_SANITIZE_STRING);
$cleanCountry = mysqli_real_escape_string($con, $filterCountry);

//Sector
$sector = $_POST["sector"];
$sector = trim($sector);
$sector = strtolower($sector);
$filterSector = filter_var($sector, FILTER_SANITIZE_STRING);
$cleanSector = mysqli_real_escape_string($con, $filterSector);

//Sageid
$sageid = $_POST["sageid"];
$sageid = trim($sageid);
$sageid = strtolower($sageid);
$filterSageid = filter_var($sageid, FILTER_SANITIZE_STRING);
$cleanSageid = mysqli_real_escape_string($con, $filterSageid);

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

$sqlChecker = "SELECT * FROM company WHERE name = '$cleanCompanyName' AND address_line1 = '$cleanAddress1' AND address_line2 = '$cleanAddress2' AND address_line3 = '$cleanAddress3' AND address_line4 = '$cleanAddress4' AND county = '$cleanCounty' AND country = '$cleanCountry' AND sage_id = '$cleanSageid' AND sector = '$cleanSector'; ";

$result = mysqli_query($con,$sqlChecker);
//echo $sqlChecker.'<br>';
if($contactType == 'lead'){
	$lead = 1;
}else{
	$lead = 0;
}

if (mysqli_num_rows($result) == 0){

	$sql = "INSERT INTO company (name, address_line1, address_line2, address_line3, address_line4, county, country, sage_id, sector, lead) VALUES ('$cleanCompanyName', '$cleanAddress1', '$cleanAddress2', '$cleanAddress3', '$cleanAddress4', '$cleanCounty', '$cleanCountry', '$cleanSageid', '$cleanSector', '$lead'); ";

	$res = mysqli_query($con,$sql);
	//echo $sql.'<br>';

	$sql2 = "SELECT companyid FROM company ORDER BY companyid DESC LIMIT 1; ";
	$res2 = mysqli_query($con,$sql2);
	$row = mysqli_fetch_assoc($res2);
	$companyid = $row["companyid"];
	//echo $companyid.'<br>';

	$sql3 = "INSERT INTO workers (first_name, last_name, phone_num, mobile_phone_num, email, fax, job_title) VALUES ('$cleanfirstname', '$cleanlastname', '$cleanphone', '$cleanmobile', '$cleanemail', '$cleanfax', '$cleanJobTitle');";
	$res3 = mysqli_query($con,$sql3);
	//echo $sql3.'<br>';

	$sql4 = "SELECT workerid FROM workers ORDER BY workerid DESC LIMIT 1; ";
	$res4 = mysqli_query($con,$sql4);
	$row = mysqli_fetch_assoc($res4);
	$workerid = $row["workerid"];
	//echo $workerid.'<br>';

	$sql5 = "INSERT INTO works_with (workerid, companyid) VALUES ('$workerid', '$companyid'); ";
	$res5 = mysqli_query($con,$sql5);
	//echo $sql5;
	
	if(isset($_POST['projectid'])){
		$projectid = $_POST['projectid'];
		$sql6 = "INSERT INTO worker_to_project (workerid, projectid) VALUES ('$workerid', '$projectid'); ";
		$res6 = mysqli_query($con,$sql6);
	}
	echo'
	<!DOCTYPE html>
	<html>
		<head>
		<title>Contact Created</title>
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