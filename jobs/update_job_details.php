<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

//Back URL
$url= $_POST["url"];

//jobid
$jobid = $_POST["jobid"];

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

//quote number
$quoteNumber = $_POST["quote_number"];
$quoteNumber = trim($quoteNumber);
$filterQuoteNumber = filter_var($quoteNumber, FILTER_SANITIZE_STRING);
$cleanQuoteNumber = mysqli_real_escape_string($con, $filterQuoteNumber);

//PO NUMBER
$po_number = $_POST["po_number"];
$po_number = trim($po_number);
$filterponumber = filter_var($po_number, FILTER_SANITIZE_STRING);
$cleanponumber= mysqli_real_escape_string($con, $filterponumber);

//INVOICE NUMBER
$invoiceNumber = $_POST["invoice_number"];
$invoiceNumber = trim($invoiceNumber);
$filterinvoiceNumber = filter_var($invoiceNumber, FILTER_SANITIZE_STRING);
$cleaninvoiceNumber= mysqli_real_escape_string($con, $filterinvoiceNumber);

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

$sql2 = "SELECT * FROM jobs WHERE jobid = '$jobid'; ";
$res2 = mysqli_query($con,$sql2);
$row = mysqli_fetch_assoc($res2);
$originalJobid = $row["jobid"];
$originalCompletee = $row["complete"];
$originalJobType = $row["job_type"];
$originalJobDescription = $row["job_description"];
$originalJobStatus = $row["job_status"];
$originalDueDate = $row["due_date"];
$originalCreationDate = $row["creation_date"];
$originalSageReference = $row["sage_reference"];
$originalPoNumber = $row["po_number"];
$originalJobNumber = $row["job_number"];
$originalNumberOfAssets = $row["number_of_assets"];
$originalNotes = $row["notes"];
$originalQuoteNumber = $row["quote_number"];
$originalInvoiceNumber = $row["invoice_number"];
//echo $originalInvoiceNumber.'hello';

if($cleanjobtype != $originalJobType || $cleanjobdescription != $originalJobDescription ||  $cleanstatus != $originalJobStatus || $cleandate != $originalDueDate || $cleansagereference != $originalSageReference || $cleanponumber != $originalPoNumber || $cleanjobnumber != $originalJobNumber || $cleannumberOfAssets != $originalNumberOfAssets || $cleannotes != $originalNotes || $cleanQuoteNumber != $originalQuoteNumber || $cleaninvoiceNumber != $originalInvoiceNumber){

$sql = "UPDATE jobs SET job_type = '$cleanjobtype', job_description = '$cleanjobdescription', job_status = '$cleanstatus', due_date = '$cleandate', sage_reference = '$cleansagereference', po_number = '$cleanponumber', job_number = '$cleanjobnumber', number_of_assets = '$cleannumberOfAssets', notes = '$cleannotes', quote_number = '$cleanQuoteNumber', invoice_number = '$cleaninvoiceNumber' WHERE jobid = '$jobid'; ";

$res = mysqli_query($con,$sql);
//echo $sql;

//this gets the current timestamp
$timestamp = time();

//this adds the data to the job history table as the first entry for this job
$sql5 = "INSERT INTO job_history (complete, job_type, job_description, job_status, due_date, updated_date, sage_reference, po_number, job_number, number_of_assets, notes, timestamp) VALUES ('0', '$cleanjobtype', '$cleanjobdescription', '$cleanstatus', '$cleandate', '$creationdate', '$cleansagereference', '$cleanponumber', '$cleanjobnumber', '$cleannumberOfAssets', '$cleannotes', '$timestamp'); ";

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


echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Job Updated</title>
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
					<h2>Job Updated</h2>
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
}else{
	echo'
	<!DOCTYPE html>
<html>
	<head>
	<title>Job Updated</title>
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
					<h2>You did not make any changes</h2>
					<hr>
					<a href="'.$url.'" id="submit">OK</a>
					<a onclick="goBack()" id="submit">Make changes</a>
				</form>
			</div>
		<!-- Popup Div Ends Here -->
		</div>
	</div>
	</body>
	
	<script type="text/javascript">
	function goBack() {
		window.history.go(-1);
	}
	window.onload = div_show();
	</script>
<!-- Body Ends Here -->
</html>';
}
?>