<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
//Back URL
$url= $_POST["url"];

//COMPANYID
$companyid = $_POST["companyid"];
$companyid = trim($companyid);
$filtercompanyid = filter_var($companyid, FILTER_VALIDATE_INT);
$cleancompanyid = mysqli_real_escape_string($con, $filtercompanyid);

//CUSTOMERID
$customerid = $_POST["customerid"];
$customerid = trim($customerid);
$filtercustomerid = filter_var($customerid, FILTER_SANITIZE_STRING);
$cleancustomerid= mysqli_real_escape_string($con, $filtercustomerid);

//activity type
$activitytype = $_POST["activitytype"];
$activitytype = trim($activitytype);
$activitytype = strtolower($activitytype);
$filteractivitytype = filter_var($activitytype, FILTER_SANITIZE_STRING);
$cleanactivitytype = mysqli_real_escape_string($con, $filteractivitytype);

//activity description
$activitydescription = $_POST["activity_description"];
$activitydescription = trim($activitydescription);
$filteractivitydescription = filter_var($activitydescription, FILTER_SANITIZE_STRING);
$cleanactivitydescription = mysqli_real_escape_string($con, $filteractivitydescription);

//due date
$date = $_POST["date"];
$date = trim($date);
$cleandate= mysqli_real_escape_string($con, $date);

//TIME
$time = $_POST["time"];
$time = trim($time);
$cleantime = mysqli_real_escape_string($con, $time);


//put the activity into the activty table
$sql1 = "INSERT INTO activity (assigned, type, description, due_date, time) VALUES ('$cleanserialnumber', '$cleantype', '$cleanmodel', '$cleanmanufacturer', '$cleanproductdescription', '$cleaninstalldate', '$cleaninspectiondue', '$cleanservicedue', '$cleanlocation', '$cleanrenewaldate', '$cleancontracttype', '$cleanfundedby');";
$res1 = mysqli_query($con,$sql1);
//echo $sql1;

//get the stockid of the asset
	$sql3 = "SELECT stockid FROM stock ORDER BY stockid DESC LIMIT 1; ";
	$res3 = mysqli_query($con,$sql3);
	$row = mysqli_fetch_assoc($res3);
    $stockid = $row["stockid"];
	//echo $stockid.'<br>';

//if an existing job number has been choosen
if($jobnumber != "not available"){
	//get the jobid that corresponds to that job number
	$sql2 = "SELECT jobid FROM jobs WHERE job_number = '$jobnumber';";
	$res2 = mysqli_query($con,$sql2);
	$row = mysqli_fetch_assoc($res2);
    $jobid = $row["jobid"];
	//echo $jobnumber.'<br>';
	//echo $jobid.'<br>';
	
}else{
	//this creates a row in the job table for the asset
	$sql5 = "INSERT INTO jobs (job_number) VALUES ('$jobnumber');";
	$res5 = mysqli_query($con,$sql5);
	
	//get the jobid of the newly created job
	$sql6 = "SELECT jobid FROM jobs ORDER BY jobid DESC LIMIT 1; ";
	$res6 = mysqli_query($con,$sql6);
	$row = mysqli_fetch_assoc($res6);
    $jobid = $row["jobid"];
	//echo $jobnumber.'<br>';
	//echo $jobid.'<br>';
	
	//this check to assign it to a private customer or a company
	if($customerid != 0){
		$sql7 = "INSERT INTO customer_requires (jobid, customerid) VALUES('$jobid', '$customerid')";
	}else{
		$sql7 = "INSERT INTO company_requires (companyid, jobid) VALUES('$companyid', '$jobid')";
	}
	$res7 = mysqli_query($con,$sql7);
	
}

//assign the asset to a job by putting stockid and jobid into the 'uses' table
	$sql4 = "INSERT INTO uses (stockid, jobid) VALUES ('$stockid', '$jobid');";
    $res4 = mysqli_query($con,$sql4);
	//echo $stockid;
mysqli_close($con);
echo'<!DOCTYPE html>
<html>
	<head>
	<title>Asset added</title>
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
					<h2>Asset added</h2>
					<hr>
					<a href="'.$url.'" id="submit">OK</a>
				</form>
			</div>
		<!-- Popup Div Ends Here -->
		</div>
	</div>
	</body>
<!-- Body Ends Here -->
</html>';
?>