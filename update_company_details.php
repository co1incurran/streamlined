<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");//remember to chanege these when all is working
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
//Back URL
$url= $_POST["url"];

//COMPANYID
$companyid = $_POST["companyid"];
$companyid = trim($companyid);
$companyid = strtolower($companyid);
$filterCompanyid = filter_var($companyid, FILTER_VALIDATE_INT);
$cleanCompanyid = mysqli_real_escape_string($con, $filterCompanyid);

//COMPANY NAME
$name = $_POST["name"];
$name = trim($name);
$name = strtolower($name);
$filterName = filter_var($name, FILTER_SANITIZE_STRING);
$cleanName = mysqli_real_escape_string($con, $filterName);

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

//sageid
$sageid = $_POST["sageid"];
$sageid = trim($sageid);
$sageid = strtolower($sageid);
$filterSageid = filter_var($sageid, FILTER_SANITIZE_STRING);
$cleanSageid = mysqli_real_escape_string($con, $filterSageid);

//sector
$sector = $_POST["sector"];
$sector = trim($sector);
$sector = strtolower($sector);
$filterSector = filter_var($sector, FILTER_SANITIZE_STRING);
$cleanSector = mysqli_real_escape_string($con, $filterSector);

$sql = "UPDATE company SET name= '$cleanName', address_line1 ='$address1', address_line2 = '$address2', address_line3 = '$address3', address_line4 = '$address4', county = '$county', country = '$country', sage_id = '$sageid', sector = '$sector' WHERE companyid= $cleanCompanyid; ";
//echo $sql;
$res = mysqli_query($con,$sql);

mysqli_close($con);
echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Update Successful</title>
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