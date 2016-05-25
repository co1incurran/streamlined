<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");//remember to chanege these when all is working
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$url= $_GET['url'];
$customerid= $_GET['customerid'];
$companyid= $_GET['companyid'];

//to get the job number
if($companyid != 0){
	$sql = "SELECT job_number FROM jobs WHERE jobid IN (SELECT jobid FROM company_requires WHERE companyid = $companyid);";
}else{
	$sql = "SELECT job_number FROM jobs WHERE jobid IN (SELECT jobid FROM customer_requires WHERE customerid = $customerid);";
}
$result = mysqli_query($con,$sql);
mysqli_close($con);
echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Add asset</title>
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
				<form action="save_asset.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Add asset</h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					<input type="hidden" name="customerid" id="customerid" value="'.$customerid.'">
					<input type="hidden" name="companyid" id="companyid" value="'.$companyid.'">
					
					<label for="jobnumber"><small>Job number</small></label>
					<select id="jobnumber" class="drop_down" name = "jobnumber" class="form-control" required>';
					if (mysqli_num_rows($result) > 0) {
						while($row = mysqli_fetch_assoc($result)) {
							echo'<option value="'.$row["job_number"].'">'.$row["job_number"].'</option>';
						}
						echo '<option value= "not available">Not available</option>';
					}else{
						echo '<option value= "not available">Not available</option>';
					}
					echo'
					</select><br>
					
					<label for="serialnumber"><small>Serial number</small></label>
					<input id="serialnumber" name="serialnumber" type="text" maxlength = "50"  required>
					
					<label for="type"><small>Product type</small></label>
					<input id="type" name="type" type="text" maxlength = "50" required>
					
					<label for="model"><small>Model</small></label>
					<input id="model" name="model" type="text" maxlength = "50"  required>
					
					<label for="manufacturer"><small>Manufacturer</small></label>
					<input id="manudacturer" name="manufacturer" type="text" maxlenght = "50">
					
					<label for="productdescription"><small>Product description</small></label>
					<textarea maxlength="300" class ="form-textarea" id="productdescription" name="productdescription" type="text"></textarea>
					
					<label for="installdate"><small>Install date</small></label>
					<input id="installdate" name="installdate" type="date" required>
					
					<label for="inspectiondue"><small>Inspection due</small></label>
					<input id="inspectiondue" name="inspectiondue" type="date">
					
					<label for="servicedue"><small>Service due</small></label>
					<input id="servicedue" name="servicedue" type="date" required>
					
					<label for="location"><small>Location <small> eg Room 20</small></small></label>
					<input id="location" name="location" type="text" maxlength = "65" required>
					
					<label for="contracttype"><small>Service contract type</small></label>
					<select id="contracttype" class="drop_down" name = "contracttype" class="form-control">
						<option value= "not specified">Not specified</option>
						<option value= "a">A</option>
						<option value= "b">B</option>
						<option value= "c">C</option>
						<option value= "d">D</option>
						<option value= "pay as you go">Pay as you go</option>
						<option value= "not with us">Not with us</option>
						<option value= "off contract">Off contract</option>
					</select><br>
					
					<label for="renewaldate"><small>Contract renewal date</small></label>
					<input id="renewaldate" name="renewaldate" type="date">
					
					<label for="fundedby"><small>Maintenance funded by</small></label>
					<input id="fundedby" name="renewaldate" type="text" required>
					
					<input type="submit" id="submit" value="Save">
					<!--<a href="javascript:%20check_empty()" id="submit">Save</a>-->
					<a onclick="goBack()" id="submit">Cancel</a>
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
?>