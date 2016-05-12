<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");//remember to chanege these when all is working
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
//Back URL
$url= $_POST["url"];

//WORKERID
$workerid = $_POST["workerid"];
$workerid = trim($workerid);
$workerid = strtolower($workerid);
$filterworkerid = filter_var($workerid, FILTER_VALIDATE_INT);
$cleanworkerid = mysqli_real_escape_string($con, $filterworkerid);

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

//JOBTITLE
$myjobtitle = $_POST["job_title"];
$myjobtitle = trim($myjobtitle);
$filterjobtitle = filter_var($myjobtitle, FILTER_SANITIZE_STRING);
$cleanjobtitle = mysqli_real_escape_string($con, $filterjobtitle);

//LASTCONTACTED
$mylastcontacted = $_POST["last_contacted"];
$mylastcontacted = trim($mylastcontacted);
$cleanlastcontacted = mysqli_real_escape_string($con, $mylastcontacted);

$sql = "UPDATE workers SET first_name= '$cleanfname', last_name= '$cleanlname', phone_num= '$myphone', mobile_phone_num= '$mymobile', email= '$cleanemail', fax= '$myfax', job_title= '$cleanjobtitle', last_contacted= '$cleanlastcontacted' WHERE workerid= $cleanworkerid; ";

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