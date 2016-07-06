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
															
					<label for="result"><small>Result</small></label><br>
					<select id="result" class="drop_down"  name = "result" class="form-control">
						<option value= "no interest">No interest</option>
						<option value= "on going">On going</option>
						<option value= "wants more info">Wants more info</option>
						<option value= "wants a quote">Wants a quote</option>
						<option value= "wants another visit">Wants another visit</option>
						<option value= "no sale">No sale</option>
						<option value= "sold">Sold</option>
						<option value= "other">Other</option>
					</select>
					
					<label for="description"><small>Description</small></label>
					<textarea maxlength="200" class ="form-textarea" id="description" name="description" type="text"></textarea>
					
					<label for="next_action"><small>Next action</small></label>
					<select id="next_action" class="drop_down"  name = "next_action" class="form-control">
						<option value= "no further action">No further action</option>
						<option value= "contact again">Contact again</option>
						<option value= "qualifying">Schedule qualify meeting</option>
						<option value= "presentation">Schedule presentation meeting</option>
						<option value= "quotation">Schedule quote meeting</option>
						<option value= "close meeting">Schedule close meeting</option>
						<option value= "followup meeting">Followup meeting</option>
						<option value= "create job number">Create job number</option>
					</select><br>
					
					<label for="nextactivity_description"><small>Further details</small></label>
					<textarea maxlength="200" class ="form-textarea" id="nextactivity_description" name="nextactivity_description" type="text"></textarea>
					
					<label for="date"><small>Due date of next action</small></label>
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