<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$userName = $_POST['username'];
$url= $_POST['url'];
$jobid= $_POST['jobid'];
$complete= $_POST['complete'];

$jobType= $_POST['jobType'];
$jobDescription= $_POST['jobDescription'];
$jobStatus= $_POST['jobStatus'];

$dueDate= $_POST['dueDate'];
$sageReference= $_POST['sageReference'];
$poNumber= $_POST['poNumber'];

$jobNumber= $_POST['jobNumber'];
$numberOfAssets= $_POST['numberOfAssets'];
$notes= $_POST['notes'];

$quoteNumber = $_POST['quote_number'];

echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Job details</title>
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
				<form action="update_job_details.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Job details</h2>
					<small><a href = "jobs.php?history=true&jobid='.$jobid.'">Job Histroy</a></small>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					<input type="hidden" name="jobid" id="jobid" value="'.$jobid.'">
					
					<label for="date"><small>Due date</small></label>
					<input id="date" name="date" value ="'.$dueDate.'" type="date" required>
					
					<label for="status"><small>Job status</small></label>
					<select id="status" class="drop_down" name = "status" class="form-control">';
					
					if($jobStatus === 'pending'){
						echo'<option selected = "selected "value= "pending">Pending</option>';
					}else{
						echo'<option value= "pending">Pending</option>';
					}
					
					if($jobStatus === 'order stock'){
						echo'<option selected = "selected "value= "order stock">Order Stock</option>';
					}else{
						echo'<option value= "order stock">Order Stock</option>';
					}
					
					if($jobStatus === 'goods on order'){
						echo'<option selected = "selected" value= "goods on order">Goods on order</option>';
					}else{
						echo'<option value= "goods on order">Goods on order</option>';
					}
					
					if($jobStatus === 'shipping to site'){
						echo'<option selected = "selected" value= "shipping to site">Shipping to site</option>';
					}else{
						echo'<option value= "shipping to site">Shipping to site</option>';
					}
					
					if($jobStatus === 'ready to start'){
						echo'<option selected = "selected" value = "ready to start">Ready to start</option>';
					}else{
						echo'<option value= "ready to start">Ready to start</option>';
					}
						
					echo'
					</select><br>
					
					<label for="jobType"><small>Job type</small></label>
					<select id="jobType"class="drop_down"  name = "jobType" class="form-control">';
					
					if($jobType === 'installation'){
						echo'<option selected = "selected" value= "installation">Installation</option>';
					}else{
						echo'<option value= "installation">Installation</option>';
					}
					
					if($jobType === 'inspection'){
						echo'<option selected = "selected" value= "inspection">Inspection</option>';
					}else{
						echo'<option value= "inspection">Inspection</option>';
					}
					
					if($jobType === 'service'){
						echo'<option selected = "selected" value= "service">Service</option>';
					}else{
						echo'<option value= "service">Service</option>';
					}
					
					if($jobType === 'repair'){
						echo'<option selected = "selected" value= "repair">Repair</option>';
					}else{
						echo'<option value= "repair">Repair</option>';
					}
					
					if($jobType === 'delivery'){
						echo'<option selected = "selected" value= "delivery">Delivery</option>';
					}else{
						echo'<option value= "delivery">Delivery</option>';
					}
					
					if($jobType === 'collection'){
						echo'<option selected = "selected" value= "collection">Collection</option>';
					}else{
						echo'<option value= "collection">Collection</option>';
					}
					
					if($jobType === 'training'){
						echo'<option selected = "selected" value= "training">Training</option>';
					}else{
						echo'<option value= "training">Training</option>';
					}
					
					if($jobType === 'take out of service'){
						echo'<option selected = "selected" value= "take out of service">Take out of service</option>';
					}else{
						echo'<option value= "take out of service">Take out of service</option>';
					}
					
					if($jobType === 'other'){
						echo'<option selected = "selected" value= "other">Other</option>';
					}else{
						echo'<option value= "other">Other</option>';
					}
					
					echo'
					</select><br>
					
					<label for="number_of_assets"><small>Number of assets involved</small></label>
					<input id="number_of_assets" name="number_of_assets" value ="'.$numberOfAssets.'" type="number" max="9999999999" min ="1" required>
					
					<label for="assign"><small>Assign to</small></label>
					<select id="assign"class="drop_down"  name = "assign" class="form-control">';
						$sql = "SELECT userid FROM users;";
						$res = mysqli_query($con,$sql);

						if (mysqli_num_rows($res) > 0) {
						while($row = mysqli_fetch_assoc($res)) {
							if($row["userid"] == $userName){
								echo'<option selected = "selected" value="'.$row["userid"].'">'.$row["userid"].'</option>';
							}else{
								echo'<option value="'.$row["userid"].'">'.$row["userid"].'</option>';
							}
						}
					}else{
						echo '<option value= "not available">Not available</option>';
					}
					echo'
					</select><br>
					
					<label for="job_description"><small>Job description</small></label>
					<textarea maxlength="70" class ="form-textarea" id="job_description" name="job_description" type="text">'.$jobDescription.'</textarea>
					
					<label for="notes"><small>Notes</small></label>
					<textarea maxlength="200" class ="form-textarea" id="notes" name="notes" type="text">'.$notes.'</textarea>
					
					<label for="job_number"><small>Job number</small></label>
					<input id="job_number" name="job_number"value ="'.$jobNumber.'" type="text" maxlength="20">
					
					<label for="po_number"><small>PO number</small></label>
					<input id="po_number" name="po_number" value ="'.$poNumber.'" type="text"maxlength="30" >
					
					<label for="quote_number"><small>Quote number</small></label>
					<input id="quote_number" name="quote_number" value ="'.$quoteNumber.'" type="text"maxlength="30" >
					
					<label for="sage_reference"><small>Sage reference</small></label>
					<input id="sage_reference" name="sage_reference" value ="'.$sageReference.'" type="text" maxlength="20">
					
					<input type="submit" id="submit" value="Update">
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