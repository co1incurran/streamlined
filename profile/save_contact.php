<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");//remember to chanege these when all is working
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
//Back URL
$url= $_POST["url"];

//COMPANYID
if(isset($_POST["companyid"])){
	$companyid = $_POST["companyid"];
}else{
	$companyid = '';
}
	$companyid = trim($companyid);
	$filtercompanyid = filter_var($companyid, FILTER_VALIDATE_INT);
	$cleancompanyid = mysqli_real_escape_string($con, $filtercompanyid);

//echo $cleancompanyid.'<br>';

//CUSTOMERID
if(isset($_POST["customerid"])){
	$customerid = $_POST["customerid"];
}else{
	$customerid = '';
}
$customerid = $_POST["customerid"];
$customerid = trim($customerid);
$filtercustomerid = filter_var($customerid, FILTER_SANITIZE_STRING);
$cleancustomerid= mysqli_real_escape_string($con, $filtercustomerid);
//echo $cleancustomerid.'<br>';

//First name
if(isset($_POST["firstname"])){
	$firstname = $_POST["firstname"];
}else{
	$firstname = '';
}
$firstname = $_POST["firstname"];
$firstname = trim($firstname);
$firstname = strtolower($firstname);
$filterfirstname = filter_var($firstname, FILTER_SANITIZE_STRING);
$cleanfirstname = mysqli_real_escape_string($con, $filterfirstname);

//last name
if(isset($_POST["lastname"])){
	$lastname = $_POST["lastname"];
}else{
	$lastname = '';
}
$lastname = $_POST["lastname"];
$lastname = trim($lastname);
$lastname = strtolower($lastname);
$filterlastname = filter_var($lastname, FILTER_SANITIZE_STRING);
$cleanlastname = mysqli_real_escape_string($con, $filterlastname);

//phone
if(isset($_POST["phone"])){
	$phone = $_POST["phone"];
}else{
	$phone = '';
}
$phone = $_POST["phone"];
$phone = trim($phone);
$filterphone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
$cleanphone= mysqli_real_escape_string($con, $filterphone);

//mobile
if(isset($_POST["mobile"])){
	$mobile = $_POST["mobile"];
}else{
	$mobile = '';
}
$mobile = $_POST["mobile"];
$mobile = trim($mobile);
$filtermobile = filter_var($mobile, FILTER_SANITIZE_NUMBER_INT);
$cleanmobile= mysqli_real_escape_string($con, $filtermobile);

//email
if(isset($_POST["email"])){
	$email = $_POST["email"];
}else{
	$email = '';
}
$email = $_POST["email"];
$email = trim($email);
$email = strtolower($email);
$filteremail = filter_var($email, FILTER_SANITIZE_EMAIL);
$cleanemail = mysqli_real_escape_string($con, $filteremail);

//fax
if(isset($_POST["email"])){
	$email = $_POST["email"];
}else{
	$email = '';
}
$fax = $_POST["fax"];
$fax = trim($fax);
$filterfax = filter_var($fax, FILTER_SANITIZE_NUMBER_INT);
$cleanfax= mysqli_real_escape_string($con, $filterfax);

//job title
$jobtitle = $_POST["jobtitle"];
$jobtitle = trim($jobtitle);
$jobtitle = strtolower($jobtitle);
$filterjobtitle = filter_var($jobtitle, FILTER_SANITIZE_STRING);
$cleanjobtitle= mysqli_real_escape_string($con, $filterjobtitle);

/*
//echo $creationdate;
echo $cleanjobtype.'<br>';
echo $cleanjobdescription.'<br>';
echo $cleanstatus.'<br>';
echo $cleandate.'<br>';
//echo $cleantime.'<br>';
echo $creationdate.'<br>';
echo $cleansagereference.'<br>';
echo $cleanponumber.'<br>';
echo $cleanjobnumber.'<br>';*/

$sql = "INSERT INTO workers (first_name, last_name, phone_num, mobile_phone_num, email, fax, job_title) VALUES ('$cleanfirstname', '$cleanlastname', '$cleanphone', '$cleanmobile', '$cleanemail', '$cleanfax', '$cleanjobtitle'); ";

$res = mysqli_query($con,$sql);
//echo $sql;

$sql2 = "SELECT workerid FROM workers ORDER BY workerid DESC LIMIT 1; ";
$result = mysqli_query($con,$sql2);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $workerid = $row["workerid"];
		//echo $workerid;
		//echo $companyid;
    }
} else {
    echo "0 results";
}

$sql3 = "INSERT INTO works_with (workerid, companyid) VALUES ('$workerid', '$companyid'); ";

$result2 = mysqli_query($con,$sql3);
mysqli_close($con);
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
?>