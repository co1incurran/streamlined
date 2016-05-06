<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "userr");//remember to chanege these when all is working
define("DB_PASSWORD", "12345");
define("DB_DATABASE", "databasee");
 
//$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

//WORKERID
/*$workerid = $_POST[workerid];
echo $workerid;
$workerid = trim($workerid);
$workerid = strtolower($workerid);
$filterworkerid = filtervar($workerid, FILTER_VALIDATE_INT);
$cleanworkerid = mysql_real_escape_string($filterworkerid);

//FIRSTNAME
$myfname = $_POST["firstname"];
$myfname = trim($myfname);
$myfname = strtolower($myfname);
$filterfname = filtervar($myfname, FILTER_SANITIZE_STRING);
$cleanfname = mysql_real_escape_string($filterfname);

//LASTNAME
$mylname = $_POST[’lastname’];
$mylname = trim($mylname);
$mylname = strtolower($mylname);
$filterlname = filtervar($mylname, FILTER_SANITIZE_STRING);
$cleanlname = mysql_real_escape_string($filterlname);*/

//EMAIL
$myemail = $_POST["email"];
$filteremail = filtervar($myemail, FILTER_VALIDATE_EMAIL);
$cleanemail = mysql_real_escape_string($filteremail);

//PHONENUMBER
$myphone = $_POST[’phone’];
$myphone = trim($myphone);
$filterphone = filtervar($myphone, FILTER_VALIDATE_INT);
$cleanphone = mysql_real_escape_string($filterphone);

//MOBILENUMBER
$mymobile = $_POST[’mobile’];
$mymobile = trim($mymobile);
$filtermobile = filtervar($mymobile, FILTER_VALIDATE_INT);
$cleanmobile = mysql_real_escape_string($filtermobile);

//FAX
$myfax = $_POST[’fax’];
$myfax = trim($myfax);
$filterfax = filtervar($myfax, FILTER_VALIDATE_INT);
$cleanfax = mysql_real_escape_string($filterfax);

//JOBTITLE
$myjobtitle = $_POST[’job_title’];
$myjobtitle = trim($myjobtitle);
$filterjobtitle = filtervar($myjobtitle, FILTER_SANITIZE_STRING);
$cleanjobtitle = mysql_real_escape_string($filterjobtitle);

//LASTCONTACTED
$mylastcontacted = $_POST[’last_contacted’];
$mylastcontacted = trim($mylastcontacted);
$cleanlastcontacted = mysql_real_escape_string($mylastcontacted);

$sqll = "UPDATE workers SET first_name= $cleanfname, last_name= $cleanlname, phone_num= $cleanphone, mobile_phone_number= $cleanmobile, email= $cleanemail, fax= $cleanfax, job_title= $cleanjobtitle, last_contacted= $cleanlastcontacted WHERE workerid= $cleanworkerid";

echo $sqll;
//$res = mysqli_query($con,$sqlP);

//mysqli_close($con);
?>