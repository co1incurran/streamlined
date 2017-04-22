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
if(isset ($_GET ['customerid'])){
	$customerid= $_GET['customerid'];
}

if(isset ($_GET ['companyid'])){
	$companyid= $_GET['companyid'];
}
$activityid = $_GET['activityid'];
echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Task Result</title>
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
				<form action="save_activity_result.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Result</h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">';
					if(isset ($_GET['projectid'])&& $_GET['projectid'] != ''){
						//echo 'hello';
						$projectid = $_GET['projectid'];
						echo '<input type="hidden" name="projectid" id="projectid" value="'.$projectid.'">';
					}else{
						//echo 'no';
						echo'
						<input type="hidden" name="customerid" id="customerid" value="'.$customerid.'">
						<input type="hidden" name="companyid" id="companyid" value="'.$companyid.'">';
					}
					echo'
					<input type="hidden" name="activityid" id="activityid" value="'.$activityid.'">
					<input type="hidden" name="userLoggedOn" id="userLoggedOn" value="'.$userLoggedOn.'">
															
					<label for="result"><small>Result</small></label><br>
					<select id="result" class="drop_down"  name = "result" class="form-control" required>
						<option value= "no interest">No interest</option>
						<option value= "continuation">Continuation</option>
						<option value= "advance">Advance</option>
						<option value= "wants more info">Wants more info</option>
						<option value= "wants a quote">Wants a quote</option>
						<option value= "wants another visit">Wants another visit</option>
						<option value= "no sale">No sale</option>
						<option value= "sold">Sold</option>
						<option value= "other">Other</option>
					</select>
					
					<label for="description"><small>Description</small></label>
					<textarea maxlength="200" class ="form-textarea" id="description" placeholder = "Description" name="description" type="text"></textarea>
					
					<label for="next_action"><small>Next action</small></label>
					<select id="next_action" class="drop_down"  name = "next_action" class="form-control">
						<option value= "no further action">No further action</option>
						<option value= "contact again">Contact again</option>
						<option value= "qualifying">Schedule qualify meeting</option>
						<option value= "presentation">Schedule presentation meeting</option>
						<option value= "generate quote">Generate quote</option>
						<option value= "deliver quote">Deliver quote</option>
						<option value= "closing meeting">Schedule close meeting</option>
						<option value= "followup meeting">Followup meeting</option>
						<option value= "create job number">Create job number</option>
					</select><br>
					
					<label for="nextactivity_description"><small>Next action description</small></label>
					<textarea maxlength="200" class ="form-textarea" id="nextactivity_description" name="nextactivity_description" type="text"></textarea>
					
					<select id="assign"class="drop_down"  name = "assign" class="form-control">';
						$sql = "SELECT userid FROM users;";
						$res = mysqli_query($con,$sql);

					if (mysqli_num_rows($res) > 0) {
						
						while($row = mysqli_fetch_assoc($res)) {
							if($row["userid"] == $userLoggedOn){
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