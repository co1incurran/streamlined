<?php
include'../include/session.php';
include'../include/db_connection.php';

//Back URL
$url= $_POST["url"];

$totalNumberOfAssets = $_POST['totalNumberOfAssets'];

$jobid = $_POST["jobid"];
$jobid = trim($jobid);
$filterjobid = filter_var($jobid, FILTER_SANITIZE_STRING);
$cleanjobid= mysqli_real_escape_string($con, $filterjobid);

$numberOfAssets = $_POST['numberofassets'];
//asset quantity
$thisAssetQuantity = $_POST["thisAssetQuantity"];

//$totalAssetsAdded = $_POST['totalAssetsAdded'];

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

//inspection date 
$inspection = $_POST["inspection"];
if($inspection == true){
	//gets the current date and adds 6 months to get the inspection date
	$inspectionDate = (new DateTime())->add(new DateInterval('P6M'))->format('Y-m-d');
}else{
	$inspectionDate = NULL;
}

//service date
$servicedate = (new DateTime())->add(new DateInterval('P12M'))->format('Y-m-d');

$numberOfAssets = $numberOfAssets - $thisAssetQuantity;



//sorting the serial number and location of the assets
$i =0;
$serialAndLocation = array();
while($i < $thisAssetQuantity){
	$serialnumber = $_POST["serialnumber$i"];
	$serialnumber = trim($serialnumber);
	$serialnumber = strtolower($serialnumber);
	$filterserialnumber = filter_var($serialnumber, FILTER_SANITIZE_STRING);
	$cleanserialnumber = mysqli_real_escape_string($con, $filterserialnumber);
	
	$worksheetnumber = $_POST["worksheetnumber$i"];
	$worksheetnumber = trim($worksheetnumber);
	$worksheetnumber = strtolower($worksheetnumber);
	$filterworksheetnumber = filter_var($worksheetnumber, FILTER_SANITIZE_STRING);
	$cleanworksheetnumber = mysqli_real_escape_string($con, $filterworksheetnumber);
	
	$location = $_POST["location$i"];
	$location = trim($location);
	$location = strtolower($location);
	$filterlocation = filter_var($location, FILTER_SANITIZE_STRING);
	$cleanlocation = mysqli_real_escape_string($con, $filterlocation);
	
	array_push($serialAndLocation,
		array('serialnumber'=>$cleanserialnumber,
		'worksheetnumber'=>$cleanworksheetnumber,
		'location'=>$cleanlocation
	));
	$i++;
}
//print_r (array_values($serialAndLocation));

//get the current date 
$dt = new DateTime();
$installDate = $dt->format('Y-m-d');

foreach($serialAndLocation as $s){
	
	$serialnumber = $s['serialnumber'];
	$location = $s['location'];
	if($inspection == true){
		$sql1 = "INSERT INTO stock (serialid, name, model, manufacturer, product_description, installation_date, inspection_date, service_date, location) VALUES ('$serialnumber', '$cleanassettype', '$cleanmodel', '$cleanmanufacturer', '$cleanproductdescription', '$installDate', '$inspectionDate', '$servicedate', '$location');";
	}else{
		$sql1 = "INSERT INTO stock (serialid, name, model, manufacturer, product_description, installation_date, service_date, location) VALUES ('$serialnumber', '$cleanassettype', '$cleanmodel', '$cleanmanufacturer', '$cleanproductdescription', '$installDate', '$servicedate', '$location');";
	}
	$res1 = mysqli_query($con,$sql1);
	//echo $sql1.'<br>';
	
	$worksheetnumber = $s['worksheetnumber'];
	
	$sql2 = "SELECT stockid FROM stock ORDER BY stockid DESC LIMIT 1; ";
	$res2 = mysqli_query($con,$sql2);
	$row = mysqli_fetch_assoc($res2);
    $stockid = $row["stockid"];
	//echo $stockid.'<br>';
	
	$sql3 = "INSERT INTO work_sheets (worksheet_number) VALUES ('$worksheetnumber');";
	$res3 = mysqli_query($con,$sql3);
	//echo $sql3.'<br>';
	
	$sql4 = "SELECT worksheetid FROM work_sheets ORDER BY worksheetid DESC LIMIT 1; ";
	$res4 = mysqli_query($con,$sql4);
	$row = mysqli_fetch_assoc($res4);
    $worksheetid = $row["worksheetid"];
	//echo $worksheetid.'<br>';
	
	$sql5 = "INSERT INTO stock_to_worksheets (stockid, worksheetid) VALUES ('$stockid','$worksheetid');";
	$res5 = mysqli_query($con,$sql5);
	//echo $sql5.'<br>';
	//echo $cleanjobid.'<br>';
	
	//linking the stock to the job
	$sql6 = "INSERT INTO uses (stockid, jobid) VALUES ($stockid, $jobid);";
	$res6 = mysqli_query($con,$sql6);
	//echo $sql6;
	//echo'<br><br>';
}
if ($numberOfAssets == 0){
	//change the complete status of the job to complete
	$sql7 = "UPDATE jobs SET complete = '1' WHERE jobid = '$jobid';";
	$res7 = mysqli_query($con,$sql7);
	
//everything below this is for adding the completion to the job_history table
	//gets the current date
$dt = new DateTime();
$creationdate = $dt->format('Y-m-d');

//gets the current data for the job
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

//this gets the current timestamp
$timestamp = time();

//this adds the data to the job history table as the first entry for this job
$sql5 = "INSERT INTO job_history (complete, job_type, job_description, job_status, due_date, updated_date, sage_reference, po_number, job_number, number_of_assets, notes, timestamp) VALUES ('1', '$originalJobType', '$originalJobDescription', '$originalJobStatus', '$originalDueDate', '$creationdate', '$originalSageReference', '$originalPoNumber', '$originalJobNumber', '$originalNumberOfAssets', '$originalNotes', '$timestamp'); ";

$res5 = mysqli_query($con,$sql5);

$sql6 = "SELECT historyid FROM job_history ORDER BY historyid DESC LIMIT 1; ";
//echo $sql6;
$res6 = mysqli_query($con,$sql6);
$row6= mysqli_fetch_assoc($res6);
$historyid = $row6["historyid"];

$sql7 = "INSERT INTO jobs_to_history (jobid, historyid) VALUES ($jobid, $historyid);";
$res7 = mysqli_query($con,$sql7);

$today = date("Y/m/d");
if($companyid !=0){
	$sql8 = "UPDATE company SET last_contacted = '$today' WHERE companyid = '$cleancompanyid';";

}elseif($customerid !=0){

	$sql8 = "UPDATE customer SET last_contacted = '$today' WHERE customerid = '$cleancustomerid';";
}
$res8 = mysqli_query($con,$sql8);
//echo $sql8;
	
	echo'
	<!DOCTYPE html>
	<html>
		<head>
		<title>All assets added</title>
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
						<h2>All asstes added</h2>
						<hr>
						<a href="'.$url.'" id="submit">OK</a>
					</form>
				</div>
			<!-- Popup Div Ends Here -->
			</div>
		</div>
		</body>
		<script type="text/javascript">
		window.onload = div_show();
		</script>
	<!-- Body Ends Here -->
	</html>';
}else{
	if ($numberOfAssets == 1){
		$word = 'asset';
	}else{
		$word = 'assets';
	}
echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Result</title>
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
				<form action="add_installed_assets.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>You have '.$numberOfAssets.' '.$word.' to account for. </h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					<input type="hidden" name="customerid" id="customerid" value="'.$customerid.'">
					<input type="hidden" name="companyid" id="companyid" value="'.$companyid.'">
					<input type="hidden" name="jobid" id="jobid" value="'.$jobid.'">
					<input type="hidden" name="numberOfAssets" id="numberOfAssets" value="'.$numberOfAssets.'">
					<input type="hidden" name="totalNumberOfAssets" id="totalNumberOfAssets" value="'.$totalNumberOfAssets.'">
					
					<input type="submit" id="submit" value="Add more assets">
					<!--<a href = "'.$url.'" id="submit">Cancel</a>-->
				</form>
			</div>
		<!-- Popup Div Ends Here -->
		</div>
	</div>
	</body>
	<script type="text/javascript">
	window.onload = div_show();
	</script>

<!-- Body Ends Here -->
</html>';
}
mysqli_close($con);
?>