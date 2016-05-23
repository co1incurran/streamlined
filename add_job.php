<?php
$url= $_GET['url'];
$customerid= $_GET['customerid'];
$companyid= $_GET['companyid'];

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
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					<input type="hidden" name="customerid" id="customerid" value="'.$customerid.'">
					<input type="hidden" name="companyid" id="companyid" value="'.$companyid.'">
					<label for="name"><small>Due date</small></label>
					<input id="date" name="date" type="date">
					
					<label for="name"><small>Time</small></label>
					<input id="time" name="time" type="time">
					
					<label for="status"><small>Job status</small></label>
					<select id="status" class="drop_down" name = "status" class="form-control">
						<option value= "pending">Pending</option>
						<option value= "order stock">Order Stock</option>
						<option value= "goods on order">Goods on order</option>
						<option value= "shipping to site">Shipping to site</option>
						<option value= "ready to start">Ready to start</option>
						<option value= "ongoing">Ongoing</option>
						<option value= "complete">Complete</option>
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
						<option value= "meeting">Meeting</option>
						<option value= "phone call">Phone call</option>
						<option value= "presentation">Presentation</option>
						<option value= "other">Other</option>
					</select><br>
					
					<label for="job_description"><small>Job description</small></label>
					<textarea maxlength="200" class ="form-textarea" id="job_description" name="job_description" type="text"></textarea>
					
					<label for="name"><small>Job number</small></label>
					<input id="job_number" name="job_number" type="text">
					
					<label for="po_number"><small>PO number</small></label>
					<input id="po_number" name="po_number" type="text">
					
					<label for="sage_reference"><small>Sage reference</small></label>
					<input id="sage_reference" name="sage_reference" type="text">
					
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