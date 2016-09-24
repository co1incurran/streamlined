<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$url= $_GET['url'];
if(isset($_GET['customerid'])){
	$customerid= $_GET['customerid'];
}
if(isset($_GET['customerid'])){
	$companyid= $_GET['companyid'];
}
if (isset($_GET['task'])){
	$task = true;
	$activityid = $_GET['activityid'];
}else{
	$task = false;
}
if(isset($_GET['activityid'])){
	$activityid = $_GET['activityid'];
}else{
	$activityid = false;
}

echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Add job</title>
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
				<form action="save_job.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Add job</h2>
					<hr>';
					//echo $activityid;
					if(isset ($_GET['activityid'])){
						echo'<input type="hidden" name="activityid" id="activityid" value="'.$activityid.'">';
					}
					echo'
					<input type="hidden" name="url" id="url" value="'.$url.'">';
					if(isset($_GET['customerid'])){
						echo'<input type="hidden" name="customerid" id="customerid" value="'.$customerid.'">';
					}
					
					if(isset($_GET['companyid'])){
						echo'<input type="hidden" name="companyid" id="companyid" value="'.$companyid.'">';
					}
					if(isset($_GET['projectid'])){
						$projectid = $_GET['projectid'];
						echo'<input type="hidden" name="projectid" id="projectid" value="'.$projectid.'">';
					}
					echo'
					<label for="date"><small>Due date</small></label>
					<input id="date" name="date" type="date" required>
					
					<label for="status"><small>Job status</small></label>
					<select id="status" class="drop_down" name = "status" class="form-control">
						<option value= "pending">Pending</option>
						<option value= "order stock">Order Stock</option>
						<option value= "goods on order">Goods on order</option>
						<option value= "shipping to site">Shipping to site</option>
						<option value= "ready to start">Ready to start</option>
					</select><br>
					
					<label for="jobType"><small>Job type</small></label>
					<select id="jobType"class="drop_down"  name = "jobType" class="form-control">
						<option value= "installation">Installation</option>
						<option value= "inspection">Inspection</option>
						<option value= "service">Service</option>
						<option value= "repair">Repair</option>
						<option value= "delivery">Delivery</option>
						<option value= "collection">Collection</option>
						<option value= "training">Training</option>
						<option value= "other">Other</option>
					</select><br>
					
					<label for="number_of_assets"><small>Number of assets involved</small></label>
					<input id="number_of_assets" name="number_of_assets" type="number" max="9999999999" min ="1" required>
					
					<label for="assign"><small>Assign to</small></label>
					<select id="assign"class="drop_down"  name = "assign" class="form-control" required>
					<option value= "" disable>Please Choose</option>';
						$sql = "SELECT userid FROM users;";
						$res = mysqli_query($con,$sql);

						if (mysqli_num_rows($res) > 0) {
						while($row = mysqli_fetch_assoc($res)) {
							if(!empty($row["userid"])){
								echo'<option value="'.$row["userid"].'">'.$row["userid"].'</option>';
							}
						}
					}else{
						echo '<option value= "not available">Not available</option>';
					}
					echo'
					</select><br>
					
					<label for="job_description"><small>Job description</small></label>
					<textarea maxlength="200" placeholder = "Job description (please include the value of the quote where possible)" class ="form-textarea" id="job_description" name="job_description" type="text"></textarea>
					
					<label for="notes"><small>Notes</small></label>
					<textarea maxlength="200" class ="form-textarea" id="notes" name="notes" type="text"></textarea>
					
					<label for="job_number"><small>Job number</small></label>
					<input id="job_number" name="job_number" type="text" maxlength="20">
					
					<label for="po_number"><small>PO number</small></label>
					<input id="po_number" name="po_number" type="text" maxlength="30" >
					
					<label for="quote_number"><small>Quote number</small></label>
					<input id="quote_number" name="quote_number" type="text" maxlength="30" >
					
					
					<label for="sage_reference"><small>Sage reference</small></label>
					<input id="sage_reference" name="sage_reference" type="text" maxlength="20">
					
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
mysqli_close($con);
?>