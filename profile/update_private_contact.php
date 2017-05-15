<?php
include'../include/session.php'

define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");//remember to chanege these when all is working
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
//Back URL
$url= $_POST["url"];

//CUSTOMERID
$customerid = $_POST["customerid"];
$customerid = trim($customerid);
$customerid = strtolower($customerid);
$filtercustomerid = filter_var($customerid, FILTER_VALIDATE_INT);
$cleancustomerid = mysqli_real_escape_string($con, $filtercustomerid);

//FIRSTNAME
$myfname = $_POST["firstname"];
$myfname = trim($myfname);
$myfname = strtolower($myfname);
$filterfname = filter_var($myfname, FILTER_SANITIZE_STRING);
$cleanfname = mysqli_real_escape_string($con, $filterfname);

//LASTNAME
$mylname = $_POST["lastname"];
$mylname = trim($mylname);
$mylname = strtolower($mylname);
$filterlname = filter_var($mylname, FILTER_SANITIZE_STRING);
$cleanlname = mysqli_real_escape_string($con, $filterlname);

//EMAIL
$myemail = $_POST["email"];
$filteremail = filter_var($myemail, FILTER_VALIDATE_EMAIL);
$cleanemail = mysqli_real_escape_string($con, $filteremail);

//PHONENUMBER
$myphone = $_POST["phone"];
$myphone = trim($myphone);
//do this to teh rest 
//settype($myphone, "integer");
$filterphone = filter_var($myphone, FILTER_VALIDATE_INT);
//$cleanphone = mysqli_real_escape_string($con, $filterphone);

//MOBILENUMBER
$mymobile = $_POST["mobile"];
$mymobile = trim($mymobile);
//settype($mymobile, "integer");

//FAX
$myfax = $_POST["fax"];
$myfax = trim($myfax);
//settype($myfax, "integer");

//LASTCONTACTED
$mylastcontacted = $_POST["last_contacted"];
$mylastcontacted = trim($mylastcontacted);
$cleanlastcontacted = mysqli_real_escape_string($con, $mylastcontacted);

//address1
$address1 = $_POST["address1"];
$address1 = trim($address1);
$address1 = strtolower($address1);
$filterAddress1 = filter_var($address1, FILTER_SANITIZE_STRING);
$cleanAddress1 = mysqli_real_escape_string($con, $filterAddress1);

//address2
$address2 = $_POST["address2"];
$address2 = trim($address2);
$address2 = strtolower($address2);
$filterAddress2 = filter_var($address2, FILTER_SANITIZE_STRING);
$cleanAddress2 = mysqli_real_escape_string($con, $filterAddress2);

//address3
$address3 = $_POST["address3"];
$address3 = trim($address3);
$address3 = strtolower($address3);
$filterAddress3 = filter_var($address3, FILTER_SANITIZE_STRING);
$cleanAddress3 = mysqli_real_escape_string($con, $filterAddress3);

//address4
$address4 = $_POST["address4"];
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

$sql = "UPDATE customer SET first_name= '$cleanfname', last_name= '$cleanlname', phone_num= '$myphone', mobile_phone_num= '$mymobile', email= '$cleanemail', fax= '$myfax', address_line1 = '$cleanAddress1', address_line2 = '$cleanAddress2', address_line3 = '$cleanAddress3', address_line4 = '$cleanAddress4', county = '$cleanCounty', country = '$cleanCountry', last_contacted= '$cleanlastcontacted' WHERE customerid= $cleancustomerid; ";
//echo $sql;
$res = mysqli_query($con,$sql);

mysqli_close($con);
echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Update Successful</title>
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