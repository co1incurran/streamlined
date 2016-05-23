<?php
$url= $_GET['url'];
$customerid= $_GET['customerid'];
$companyid= $_GET['companyid'];

echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Edit contact form</title>
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
				<form action="update_asset.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Edit Asset</h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					<input type="hidden" name="customerid" id="customerid" value="'.$customerid.'">
					<input type="hidden" name="companyid" id="companyid" value="'.$companyid.'">
					<label for="name"><small>Due date</small></label>
					<input id="date" name="date" type="date">
					
					<label for="name"><small>Time</small></label>
					<input id="time" name="time" type="time">
					
					<label for="name"><small>Job type</small></label>
					<select id="jobType" class="form-control">
						<option value= "2">Installation</option>
						<option value= "3">Inspection</option>
						<option value= "4">Service</option>
						<option value= "5">Repair</option>
						<option value= "6">Delivery</option>
						<option value= "7">Collection</option>
						<option value= "8">Training</option>
						<option value= "9">Meeting</option>
						<option value= "10">Phone call</option>
						<option value= "11">Presentation</option>
					</select>
					
					<label for="lastresults"><small>Job description</small></label>
					<textarea maxlength="300" class ="form-textarea" id="job_description" name="job_description" type="text"></textarea>
					
					<label for="name"><small>Job number</small></label>
					<input id="job_number" name="job_number" type="text">
					
					<label for="name"><small>PO number</small></label>
					<input id="job_number" name="job_number" type="text">
					
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