<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");//remember to chanege these when all is working
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

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
echo $_POST["phone"];
$myphone = $_POST["phone"];
$myphone = trim($myphone);
//do this to teh rest 
settype($myphone, "integer");
$filterphone = filter_var($myphone, FILTER_VALIDATE_INT);
//$cleanphone = mysqli_real_escape_string($con, $filterphone);

//MOBILENUMBER
$mymobile = $_POST["mobile"];
$mymobile = trim($mymobile);
$filtermobile = filter_var($mymobile, FILTER_VALIDATE_INT);
$cleanmobile = mysqli_real_escape_string($con, $filtermobile);

//FAX
$myfax = $_POST["fax"];
$myfax = trim($myfax);
$filterfax = filter_var($myfax, FILTER_VALIDATE_INT);
$cleanfax = mysqli_real_escape_string($con, $filterfax);

//JOBTITLE
$myjobtitle = $_POST["job_title"];
$myjobtitle = trim($myjobtitle);
$filterjobtitle = filter_var($myjobtitle, FILTER_SANITIZE_STRING);
$cleanjobtitle = mysqli_real_escape_string($con, $filterjobtitle);

//LASTCONTACTED
$mylastcontacted = $_POST["last_contacted"];
$mylastcontacted = trim($mylastcontacted);
$cleanlastcontacted = mysqli_real_escape_string($con, $mylastcontacted);

$sql = "UPDATE workers SET first_name= '$cleanfname', last_name= '$cleanlname', phone_num= '$myphone', mobile_phone_num= '$cleanmobile', email= '$cleanemail', fax= '$cleanfax', job_title= '$cleanjobtitle', last_contacted= '$cleanlastcontacted' WHERE workerid= $cleanworkerid; ";
//echo $cleanphone;
echo $sql;
//$res = mysqli_query($con,$sql);

mysqli_close($con);
?>