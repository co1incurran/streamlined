<?php
include'../include/session.php';
include'../include/db_connection.php';

//this is for getting the last job number so it can be incremented to create the next one.
$sql10 = "SELECT job_number FROM jobs ORDER BY jobid DESC LIMIT 1;";
$res10 = mysqli_query($con,$sql10);
$jobNumber = mysqli_fetch_assoc($res10);
$jobNumber = $jobNumber['job_number'];

list($year, $number) = explode('-', $jobNumber);
//echo $jobNumber.'<br>';
//echo $year.'<br>';
//echo $number.'<br>';
//check if the last job was in the same year as this new job we are about to create
if($year = date("y")){
	$number++;
}else{
	$year = date("y");
	$number = 1;
}
$number = str_pad($number, 4, '0', STR_PAD_LEFT);
//echo $number.'<br>';
$newJobNumber = $year.'-'.$number;
echo $newJobNumber.'<br>';

//Back URL
$url= $_POST["url"];

//COMPANYID
if(isset($_POST['companyid'])){
	$companyid = $_POST["companyid"];
	$companyid = trim($companyid);
	$filtercompanyid = filter_var($companyid, FILTER_VALIDATE_INT);
	$cleancompanyid = mysqli_real_escape_string($con, $filtercompanyid);
	//echo $cleancompanyid.'<br>';
}

//CUSTOMERID
if(isset($_POST['customerid'])){
	$customerid = $_POST["customerid"];
	$customerid = trim($customerid);
	$filtercustomerid = filter_var($customerid, FILTER_SANITIZE_STRING);
	$cleancustomerid= mysqli_real_escape_string($con, $filtercustomerid);
	//echo $cleancustomerid.'<br>';
}

//this is for making the project into a customer
if(isset($_POST['projectid']) &&$_POST['projectid'] != '' ){
	
	//PROJECTID
	$projectid = $_POST["projectid"];
	$projectid = trim($projectid);
	$filterprojectid = filter_var($projectid, FILTER_VALIDATE_INT);
	$cleanprojectid = mysqli_real_escape_string($con, $filterprojectid);
	//echo $cleanprojectid.'<br>';
	$sql13 = "SELECT companyid FROM company WHERE projectid = '$cleanprojectid';";
	//echo $sql13;
	$res13 = mysqli_query($con,$sql13);
	
	if(mysqli_num_rows($res13) < 1){
				
			$sql10 = "SELECT * FROM projects WHERE projectid = '$cleanprojectid';";
			$res10 = mysqli_query($con,$sql10);
			$row10  = mysqli_fetch_assoc($res10);
			$planningNumber = $row10['planning_number'];
			$address1 = $row10['address1'];
			$address2 = $row10['address2'];
			$address3 = $row10['address3'];
			$address4 = $row10['address4'];
			$county = $row10['county'];
			$country = $row10['country'];

			
			$sql11 = "INSERT INTO company (name, address_line1, address_line2, address_line3, address_line4, county, country, project, projectid) VALUES ('$planningNumber', '$address1', '$address2', '$address3', '$address4', '$county', '$country', '1', '$cleanprojectid')";
			//echo $sql11;
			$res11 = mysqli_query($con,$sql11);
			
			$sql12 = "SELECT companyid FROM company ORDER BY companyid DESC LIMIT 1; ";
			//echo $sql12;
			$res12 = mysqli_query($con,$sql12);
			$row12= mysqli_fetch_assoc($res12);
			$cleancompanyid = $row12["companyid"];
	}else{
		$row13 = mysqli_fetch_assoc($res13);
		$cleancompanyid = $row13["companyid"];
	}
}



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

/*//JOB NUMBER
$job_number = $_POST["job_number"];
$job_number = trim($job_number);
$filterjobnumber = filter_var($job_number, FILTER_SANITIZE_STRING);
$cleanjobnumber= mysqli_real_escape_string($con, $filterjobnumber);*/

//Quote NUMBER
$quoteNumber = $_POST["quote_number"];
$quoteNumber = trim($quoteNumber);
$filterQuoteNumber = filter_var($quoteNumber, FILTER_SANITIZE_STRING);
$cleanQuoteNumber= mysqli_real_escape_string($con, $filterQuoteNumber);

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


$sql = "INSERT INTO jobs (complete, job_type, job_description, job_status, due_date, creation_date, sage_reference, po_number, job_number, number_of_assets, notes, quote_number) VALUES ('0', '$cleanjobtype', '$cleanjobdescription', '$cleanstatus', '$cleandate', '$creationdate', '$cleansagereference', '$cleanponumber', '$newJobNumber', '$cleannumberOfAssets', '$cleannotes', '$cleanQuoteNumber'); ";

$res = mysqli_query($con,$sql);
//echo $sql;

$sql2 = "SELECT jobid FROM jobs ORDER BY jobid DESC LIMIT 1; ";
$result = mysqli_query($con,$sql2);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $jobid = $row["jobid"];
    }
} 
if(isset($_POST['customerid']) && $customerid != 0){
	$sql3 = "INSERT INTO customer_requires (jobid, customerid) VALUES ('$jobid', '$cleancustomerid'); ";
	//echo $cleancustomerid;
	//echo '<br>'. $sql3;
}elseif((isset($_POST['companyid']) && $companyid != 0) || (isset($_POST['projectid'])&& $_POST['projectid'] != '')){
	$sql3 = "INSERT INTO company_requires (companyid, jobid) VALUES ('$cleancompanyid', '$jobid'); ";
	//echo $companyid;
	//echo '<br>'. $jobid;
	//echo $companyid;
	//echo $customerid;
	//echo $projectid;
	
}
$result2 = mysqli_query($con,$sql3);

$sql4 = "INSERT INTO assigned (userid, jobid) VALUES ('$cleanassigned','$jobid');";
$result4 = mysqli_query($con,$sql4);

//this gets the current timestamp
$date = new DateTime();
$timestamp = $date->getTimestamp();
//this adds the data to the job history table as the first entry for this job
$sql5 = "INSERT INTO job_history (complete, job_type, job_description, job_status, due_date, updated_date, sage_reference, po_number, job_number, number_of_assets, notes, timestamp) VALUES ('0', '$cleanjobtype', '$cleanjobdescription', '$cleanstatus', '$cleandate', '$creationdate', '$cleansagereference', '$cleanponumber', '$newJobNumber', '$cleannumberOfAssets', '$cleannotes', '$timestamp'); ";

$res5 = mysqli_query($con,$sql5);
//echo $sql5;


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
	$date = date("Y-m-d");
	$activityid = $_POST['activityid'];
	$sql8 = "UPDATE activity SET complete  = '1', result = 'Job Number: $cleanjobnumber', complete_date = '$date' WHERE activityid = '$activityid' ;";
	$res8 = mysqli_query($con,$sql8);	
	//echo $sql8;
}
//this ensures that all leads are converted to customers
if(isset ($_POST['customerid']) && $cleancustomerid > 0){
	$sql9 = "UPDATE customer SET lead  = '0' WHERE customerid = '$cleancustomerid' ;";
	$res9 = mysqli_query($con,$sql9);
}elseif(isset ($_POST['companyid']) && $cleancompanyid > 0){
	$sql9 = "UPDATE company SET lead  = '0' WHERE companyid = '$cleancompanyid' ;";
	$res9 = mysqli_query($con,$sql9);
}


mysqli_close($con);
echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Job Created</title>
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