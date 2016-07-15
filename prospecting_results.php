<?php

session_start();
	if(!isset ($_SESSION['username'])){
		header("location:index.html");
	}
	$userLoggedOn = $_SESSION['username'];

define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$url= $_GET['url'];
$customerid= $_GET['customerid'];
$companyid= $_GET['companyid'];
$activityid = $_GET['activityid'];

if(isset($_GET['userName'])){
	$userName = $_GET['userName'];
}

echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Prospecting Result</title>
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
					<h2>Prospecting Result</h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					<input type="hidden" name="customerid" id="customerid" value="'.$customerid.'">
					<input type="hidden" name="companyid" id="companyid" value="'.$companyid.'">
					<input type="hidden" name="activityid" id="activityid" value="'.$activityid.'">
					<input type="hidden" name="userLoggedOn" id="userLoggedOn" value="'.$userLoggedOn.'">
					
					<label for="type"><small>Type</small></label><br>
					<select id="type"class="drop_down"  name = "type" class="form-control">
						<option value="" disabled="disabled" selected="selected">Please select</option>
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
						<option value="" disabled="disabled" selected="selected">Please select</option>
						<option value= "no interest">No interest</option>
						<option value= "not available">Not available to talk</option>
						<option value= "awaiting feedback">Awaiting feedback</option>
						<option value= "continuation">Continuation</option>
						<option value= "advance">Advance</option>
						<option value= "wants quote">Wants quote</option>
						<option value= "sold">Sold</option>
						<option value= "other">Other</option>
					</select><br>
					
					<label for="description"><small>Result description</small></label>
					<textarea maxlength="200" class ="form-textarea" id="description" name="description" type="text"></textarea>
					
					<label for="next_action"><small>Next action</small></label>
					<select id="next_action" class="drop_down"  name = "next_action" class="form-control">
						<option value="" disabled="disabled" selected="selected">Please select</option>
						<option value= "no further action">No further action</option>
						<option value= "contact again">Contact again</option>
						<option value= "qualifying">Schedule qualify meeting</option>
						<option value= "presentation">Schedule presentation meeting</option>
						<option value= "generate quote">Generate quote</option>
						<option value= "quotation">Schedule quote meeting</option>
						<option value= "close meeting">Schedule close meeting</option>
						<option value= "followup meeting">Followup meeting</option>
					</select><br>
					
					<label for="nextactivity_description"><small>Next action description</small></label>
					<textarea maxlength="200" class ="form-textarea" id="nextactivity_description" name="nextactivity_description" type="text"></textarea>
					
					<label for="assign"><small>Assign to</small></label>
					<select id="assign"class="drop_down"  name = "assign" class="form-control">';
						$sql = "SELECT userid FROM users;";
						$res = mysqli_query($con,$sql);

					if (mysqli_num_rows($res) > 0) {
						
						while($row = mysqli_fetch_assoc($res)) {
							if(isset($_GET['userName'])){
								$userName = $_GET['userName'];
								if($row["userid"] == $userName){
									echo'<option selected = "selected" value="'.$row["userid"].'">'.$row["userid"].'</option>';
								}else{
									echo'<option value="'.$row["userid"].'">'.$row["userid"].'</option>';
								}
							}else{
									echo'<option value="'.$row["userid"].'">'.$row["userid"].'</option>';
							}
						}
					}else{
						echo '<option value= "not available">Not available</option>';
					}
					echo'
					</select><br>
					
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