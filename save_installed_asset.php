<?php

define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
/*
//Back URL
$url= $_POST["url"];
$jobid = $_POST["jobid"];
$numberOfAssets = $_POST['numberofassets'];
//asset quantity
$assetquantity = $_POST["assetquantity"];

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

//asset type
$assetType = $_POST["assettype"];
$assetType = trim($assetType);
$assetType = strtolower($assetType);
$filterassettype = filter_var($assetType, FILTER_SANITIZE_STRING);
$cleanassettype = mysqli_real_escape_string($con, $filterassettype);

//product type
$type = $_POST["type"];
$type = trim($type);
$filtertype = filter_var($type, FILTER_SANITIZE_STRING);
$cleantype= mysqli_real_escape_string($con, $filtertype);

//model
$model = $_POST["model"];
$model = trim($model);
$model = strtolower($model);
$filtermodel = filter_var($model, FILTER_SANITIZE_STRING);
$cleanmodel= mysqli_real_escape_string($con, $filtermodel);

//manufacturer
$manufacturer = $_POST["manufacturer"];
$manufacturer = trim($manufacturer);
$manufacturer = strtolower($manufacturer);
$filtermanufacturer = filter_var($manufacturer, FILTER_SANITIZE_STRING);
$cleanmanufacturer = mysqli_real_escape_string($con, $filtermanufacturer);

//product description
$productdescription = $_POST["productdescription"];
$productdescription = trim($productdescription);
$filterproductdescription = filter_var($productdescription, FILTER_SANITIZE_STRING);
$cleanproductdescription= mysqli_real_escape_string($con, $filterproductdescription);

//install date
$installdate = $_POST["installdate"];
$installdate = trim($installdate);
$cleaninstalldate= mysqli_real_escape_string($con, $installdate);

//inspection date 
$inspectiondate = $_POST["inspectiondate"];
$inspectiondate = trim($inspectiondate);
$cleaninspectiondate= mysqli_real_escape_string($con, $inspectiondate);

//service date
$servicedate = $_POST["servicedate"];
$servicedate = trim($servicedate);
$cleanservicedate = mysqli_real_escape_string($con, $servicedate);
*/
//sorting the serial number and location of the assets
$i =0;
$numberOfAssets = $_POST['numberofassets'];
$serialAndLocation = array();
while($i < $numberOfAssets-1){
	$serialnumber = $_POST["serialnumber$i"];
	$serialnumber = trim($serialnumber);
	$serialnumber = strtolower($serialnumber);
	$filterserialnumber = filter_var($serialnumber, FILTER_SANITIZE_STRING);
	$cleanserialnumber = mysqli_real_escape_string($con, $filterserialnumber);
	
	$location = $_POST["location$i"];
	$location = trim($location);
	$location = strtolower($location);
	$filterlocation = filter_var($location, FILTER_SANITIZE_STRING);
	$cleanlocation = mysqli_real_escape_string($con, $filterlocation);
	
	array_push($serialAndLocation,
		array('serialnumber'=>$cleanserialnumber,
		'loaction'=>$cleanlocation,
	));
	$i++;
}

foreach($serialAndLocation as $s){
	
	$sql = "INSERT INTO stock (serialid, name, model, manufacturer, product_description, installation_date, inspection_date, service_date, location) VALUES ('$s['serialnumber']', '$cleanassettype', '$cleanmodel', '$cleanmanufacturer', '$cleanproductdescription', '$cleaninstalldate', '$cleaninspectiondue', '$cleanservicedue', '$cleanlocation', '$cleanrenewaldate', '$cleancontracttype', '$cleanfundedby');";
	
}
//print_r (array_values($serialAndLocation));
/*
//put the asset info into the stock table
$sql1 = "INSERT INTO stock (serialid, name, model, manufacturer, product_description, installation_date, inspection_date, service_date, location, contract_renewal_date, contract_type, funded_by) VALUES ('$cleanserialnumber', '$cleantype', '$cleanmodel', '$cleanmanufacturer', '$cleanproductdescription', '$cleaninstalldate', '$cleaninspectiondue', '$cleanservicedue', '$cleanlocation', '$cleanrenewaldate', '$cleancontracttype', '$cleanfundedby');";
$res1 = mysqli_query($con,$sql1);
//echo $sql1;

//get the stockid of the asset
	$sql3 = "SELECT stockid FROM stock ORDER BY stockid DESC LIMIT 1; ";
	$res3 = mysqli_query($con,$sql3);
	$row = mysqli_fetch_assoc($res3);
    $stockid = $row["stockid"];
	//echo $stockid.'<br>';

//if an existing job numbre has been choosen
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

echo'
<!DOCTYPE html>
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
	<script type="text/javascript">
	function goBack() {
		window.history.go(-2);
	}
	window.onload = div_show();
	</script>
<!-- Body Ends Here -->
</html>';*/
mysqli_close($con);
?>