<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

//Back URL
$url= $_POST["url"];

$jobid = $_POST["jobid"];
$jobid = trim($jobid);
$filterjobid = filter_var($jobid, FILTER_SANITIZE_STRING);
$cleanjobid= mysqli_real_escape_string($con, $filterjobid);

$numberOfAssets = $_POST['numberofassets'];
//asset quantity
$assetquantity = $_POST["assetquantity"];

$totalAssetsAdded = $_POST['totalAssetsAdded'];

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
$inspectiondate = $_POST["inspectiondate"];
$inspectiondate = trim($inspectiondate);
$cleaninspectiondate= mysqli_real_escape_string($con, $inspectiondate);

//service date
$servicedate = $_POST["servicedate"];
$servicedate = trim($servicedate);
$cleanservicedate = mysqli_real_escape_string($con, $servicedate);

if ($totalAssetsAdded == $numberOfAssets ){
	echo'
	<!DOCTYPE html>
	<html>
		<head>
		<title>All assets added</title>
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

//sorting the serial number and location of the assets
$i =0;
$serialAndLocation = array();
while($i < $assetquantity){
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
$installdate = $dt->format('Y-m-d');

foreach($serialAndLocation as $s){
	
	$serialnumber = $s['serialnumber'];
	$location = $s['location'];
	$sql1 = "INSERT INTO stock (serialid, name, model, manufacturer, product_description, installation_date, inspection_date, service_date, location) VALUES ('$serialnumber', '$cleanassettype', '$cleanmodel', '$cleanmanufacturer', '$cleanproductdescription', '$installdate', '$cleaninspectiondate', '$cleanservicedate', '$location');";
	
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


echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Result</title>
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
				<form action="add_installed_assets.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>You have '.($numberOfAssets - $totalAssetsAdded).' asset(s) to account for. </h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					<input type="hidden" name="customerid" id="customerid" value="'.$customerid.'">
					<input type="hidden" name="companyid" id="companyid" value="'.$companyid.'">
					<input type="hidden" name="jobid" id="jobid" value="'.$jobid.'">
					<input type="hidden" name="assetnumber" id="assetnumber" value="'.$numberOfAssets.'">
					<input type="hidden" name="totalAssetsAdded" id="totalAssetsAdded" value="'.$totalAssetsAdded.'">
					
					<input type="submit" id="submit" value="Add more assets">
					<a href = "'.$url.'" id="submit">Cancel</a>
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