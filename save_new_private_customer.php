<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");//remember to chanege these when all is working
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
//Back URL
$url= $_POST["url"];
$contactType = $_POST['contactType'];

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

//address1
$address1 = $_POST["address1"];
$address1 = trim($address1);
$address1 = strtolower($address1);
$filteraddress1 = filter_var($address1, FILTER_SANITIZE_STRING);
$cleanaddress1 = mysqli_real_escape_string($con, $filteraddress1);

//address2
$address2 = $_POST["address2"];
$address2 = trim($address2);
$address2 = strtolower($address2);
$filteraddress2 = filter_var($address2, FILTER_SANITIZE_STRING);
$cleanaddress2 = mysqli_real_escape_string($con, $filteraddress2);

//address3
$address3 = $_POST["address3"];
$address3 = trim($address3);
$address3 = strtolower($address3);
$filteraddress3 = filter_var($address3, FILTER_SANITIZE_STRING);
$cleanaddress3 = mysqli_real_escape_string($con, $filteraddress3);

//address4
$address4 = $_POST["address4"];
$address4 = trim($address4);
$address4 = strtolower($address4);
$filteraddress4 = filter_var($address4, FILTER_SANITIZE_STRING);
$cleanaddress4 = mysqli_real_escape_string($con, $filteraddress4);

//county
$county = $_POST["county"];
$county = trim($county);
$county = strtolower($county);
$filtercounty = filter_var($county, FILTER_SANITIZE_STRING);
$cleancounty = mysqli_real_escape_string($con, $filtercounty);

//country
$country = $_POST["country"];
$country = trim($country);
$country = strtolower($country);
$filtercountry = filter_var($country, FILTER_SANITIZE_STRING);
$cleancountry = mysqli_real_escape_string($con, $filtercountry);

//sageid
$sageid = $_POST["sageid"];
$sageid = trim($sageid);
$sageid = strtolower($sageid);
$filtersageid = filter_var($sageid, FILTER_SANITIZE_STRING);
$cleansageid = mysqli_real_escape_string($con, $filtersageid);

// this is used to ensure a page reload doesnt put the data in a secon time
$sql1 = "SELECT * FROM customer WHERE first_name = '$cleanfirstname' AND last_name = '$cleanlastname' AND phone_num = '$cleanphone' AND  mobile_phone_num = '$cleanmobile' AND email = '$cleanemail' AND fax = '$cleanfax' AND  address_line1 = '$cleanaddress1' AND  address_line2 = '$cleanaddress2' AND  address_line3 = '$cleanaddress3' AND  address_line4 = '$cleanaddress4' AND county = '$cleancounty' AND country = '$cleancountry' ;";

$res1 = mysqli_query($con,$sql1);
	if($contactType == 'lead'){
		$lead = 1;
	}else{
		$lead = 0;
	}
if (mysqli_num_rows($res1) == 0){

	$sql2 = "INSERT INTO customer (first_name, last_name, phone_num, mobile_phone_num, email, fax, address_line1, address_line2, address_line3, address_line4, county, country, last_contacted, sage_id, lead) VALUES ('$cleanfirstname', '$cleanlastname', '$cleanphone', '$cleanmobile', '$cleanemail', '$cleanfax', '$cleanaddress1','$cleanaddress2', '$cleanaddress3', '$cleanaddress4', '$cleancounty', '$cleancountry', '2000-01-01', '$cleansageid', '$lead'); ";

	$res2 = mysqli_query($con,$sql2);
	//echo $sql2;
	$title = 'Contact created';
}else{
	$title = 'Contact already exists';
}

mysqli_close($con);

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
					<h2>'.$title.'</h2>
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