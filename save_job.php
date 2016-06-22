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
//echo $cleancompanyid.'<br>';
//CUSTOMERID
$customerid = $_POST["customerid"];
$customerid = trim($customerid);
$filtercustomerid = filter_var($customerid, FILTER_SANITIZE_STRING);
$cleancustomerid= mysqli_real_escape_string($con, $filtercustomerid);
//echo $cleancustomerid.'<br>';

//DUE DATE
$date = $_POST["date"];
$date = trim($date);
$cleandate = mysqli_real_escape_string($con, $date);

//STATUS
$status = $_POST["status"];
$status = trim($status);
$status = strtolower($status);
$filterstatus = filter_var($status, FILTER_SANITIZE_STRING);
$cleanstatus= mysqli_real_escape_string($con, $filterstatus);

//JOB TYPE
$jobType = $_POST["jobType"];
$jobType = trim($jobType);
$jobType = strtolower($jobType);
$filterjobtype = filter_var($jobType, FILTER_SANITIZE_STRING);
$cleanjobtype= mysqli_real_escape_string($con, $filterjobtype);

//assigned to
$assigned = $_POST["assign"];
$assigned = trim($assigned);
$filterassigned = filter_var($assigned, FILTER_SANITIZE_STRING);
$cleanassigned = mysqli_real_escape_string($con, $filterassigned);

//JOB DESCRIPTION
$job_description = $_POST["job_description"];
$job_description = trim($job_description);
$filterjobdescription = filter_var($job_description, FILTER_SANITIZE_STRING);
$cleanjobdescription= mysqli_real_escape_string($con, $filterjobdescription);

//NOTES
$notes = $_POST["notes"];
$notes = trim($notes);
$filternotes = filter_var($notes, FILTER_SANITIZE_STRING);
$cleannotes= mysqli_real_escape_string($con, $filternotes);

//JOB NUMBER
$job_number = $_POST["job_number"];
$job_number = trim($job_number);
$filterjobnumber = filter_var($job_number, FILTER_SANITIZE_STRING);
$cleanjobnumber= mysqli_real_escape_string($con, $filterjobnumber);

//PO NUMBER
$po_number = $_POST["po_number"];
$po_number = trim($po_number);
$filterponumber = filter_var($po_number, FILTER_SANITIZE_STRING);
$cleanponumber= mysqli_real_escape_string($con, $filterponumber);

//SAGE REFERENCE
$sage_reference = $_POST["sage_reference"];
$sage_reference = trim($sage_reference);
$filtersagereference = filter_var($sage_reference, FILTER_SANITIZE_STRING);
$cleansagereference= mysqli_real_escape_string($con, $filtersagereference);

//number of assets involved in the job
$numberOfAssets = $_POST["number_of_assets"];
$numberOfAssets = trim($numberOfAssets);
$filternumberOfAssets = filter_var($numberOfAssets, FILTER_SANITIZE_STRING);
$cleannumberOfAssets= mysqli_real_escape_string($con, $filternumberOfAssets);

//gets the current date
$dt = new DateTime();
$creationdate = $dt->format('Y-m-d');


$sql = "INSERT INTO jobs (complete, job_type, job_description, job_status, due_date, creation_date, sage_reference, po_number, job_number, number_of_assets, notes) VALUES ('0', '$cleanjobtype', '$cleanjobdescription', '$cleanstatus', '$cleandate', '$creationdate', '$cleansagereference', '$cleanponumber', '$cleanjobnumber', '$cleannumberOfAssets', '$cleannotes'); ";

$res = mysqli_query($con,$sql);
//echo $sql;

$sql2 = "SELECT jobid FROM jobs ORDER BY jobid DESC LIMIT 1; ";
$result = mysqli_query($con,$sql2);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $jobid = $row["jobid"];
    }
} else {
    echo "0 results";
}
if($customerid != 0){
	$sql3 = "INSERT INTO customer_requires (jobid, customerid) VALUES ('$jobid', '$customerid'); ";
	//echo $customerid;
	//echo '<br>'. $jobid;
}else{
	$sql3 = "INSERT INTO company_requires (companyid, jobid) VALUES ('$companyid', '$jobid'); ";
	//echo $companyid;
	//echo '<br>'. $jobid;
}
$result2 = mysqli_query($con,$sql3);

$sql4 = "INSERT INTO assigned (userid, jobid) VALUES ('$cleanassigned','$jobid');";
$result4 = mysqli_query($con,$sql4);

//this gets the current timestamp
$date = new DateTime();
$timestamp = $date->getTimestamp();
//this adds the data to the job history table as the first entry for this job
$sql5 = "INSERT INTO job_history (complete, job_type, job_description, job_status, due_date, updated_date, sage_reference, po_number, job_number, number_of_assets, notes, timestamp) VALUES ('0', '$cleanjobtype', '$cleanjobdescription', '$cleanstatus', '$cleandate', '$creationdate', '$cleansagereference', '$cleanponumber', '$cleanjobnumber', '$cleannumberOfAssets', '$cleannotes', '$timestamp'); ";

$res5 = mysqli_query($con,$sql5);
echo $sql5;


$sql6 = "SELECT historyid FROM job_history ORDER BY historyid DESC LIMIT 1; ";
//echo $sql6;
$res6 = mysqli_query($con,$sql6);
$row6= mysqli_fetch_assoc($res6);
$historyid = $row6["historyid"];

$sql7 = "INSERT INTO jobs_to_history (jobid, historyid) VALUES ($jobid, $historyid);";
$res7 = mysqli_query($con,$sql7);
//echo $sql7;

//The below code if for handling jobs created form the "create job number" task
if(isset($_POST['activityid'])){
	$activityid = $_POST['activityid'];
}

mysqli_close($con);
echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Job Created</title>
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
					<h2>Job Created</h2>
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