<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$url= $_GET['url'];
$customerid= $_GET['customerid'];
$companyid= $_GET['companyid'];
$activityid = $_GET['activityid'];
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
				<form action="save_activity_result.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Result</h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					<input type="hidden" name="customerid" id="customerid" value="'.$customerid.'">
					<input type="hidden" name="companyid" id="companyid" value="'.$companyid.'">
					<input type="hidden" name="activityid" id="activityid" value="'.$activityid.'">
					
					<label for="type"><small>Type</small></label><br>
					<select id="type"class="drop_down"  name = "type" class="form-control">
						<option value= "phone call">Phone call</option>
						<option value= "door step">Door step</option>
						<option value= "left brochure">Left brochure</option>
						<option value= "left business card">Left business card</option>
						<option value= "courtesy call">Courtesy call</option>
						<option value= "demo">Demo</option>
						<option value= "c.p.d">C.P.D</option>
						<option value= "followup meeting">Followup meeting</option>
						<option value= "other">Other</option>
					</select><br>
										
					<label for="result"><small>Result</small></label><br>
					<select id="result" class="drop_down"  name = "result" class="form-control">
						<option value= "no interest">No interest</option>
						<option value= "not available">Not available</option>
						<option value= "got an appointment">Got an appointment</option>
						<option value= "awaiting feedback">Awaiting feedback</option>
						<option value= "other">Other</option>
					</select>
					
					<label for="description"><small>Description</small></label>
					<textarea maxlength="200" class ="form-textarea" id="description" name="description" type="text"></textarea>
					
					<label for="next_action"><small>Next action</small></label>
					<select id="next_action" class="drop_down"  name = "next_action" class="form-control">
						<option value= "no further action">No further action</option>
						<option value= "call again">Call again</option>
						<option value= "schedule qualify meeting">Schedule qualify meeting</option>
						<option value= "schedule presentation meeting">Schedule presentation meeting</option>
						<option value= "schedule quote meeting">Schedule quote meeting</option>
						<option value= "schedule close meeting">Schedule close meeting</option>
					</select><br>
					
					<label for="nextactivity_description"><small>Further details</small></label>
					<textarea maxlength="200" class ="form-textarea" id="nextactivity_description" name="nextactivity_description" type="text"></textarea>
					
					
					<label for="date"><small>Due date</small></label>
					<input id="date" name="date" type="date">
					
					<label for="time"><small>Time</small></label>
					<input id="time" name="time" type="time">
					
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