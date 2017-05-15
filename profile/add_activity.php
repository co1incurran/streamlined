<?php
include'../include/session.php'

define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);


echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Add task</title>
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
				<form action="save_activity.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Add task</h2>
					<hr>';
					if(isset($_GET['url'])){
						$url= $_GET['url'];
						echo '<input type="hidden" name="url" id="url" value="'.$url.'">';
					}
					
					if(isset($_GET['companyid'])){
						$companyid= $_GET['companyid'];
						echo '<input type="hidden" name="companyid" id="companyid" value="'.$companyid.'">';
					}
					
					if(isset($_GET['customerid'])){
						$customerid= $_GET['customerid'];
						echo '<input type="hidden" name="customerid" id="customerid" value="'.$customerid.'">';
					}
					
					if(isset($_GET['projectid'])){
						$projectid= $_GET['projectid'];
						echo '<input type="hidden" name="projectid" id="projectid" value="'.$projectid.'">';
					}
					
					echo'
					<input type="hidden" name="userLoggedOn" id="userLoggedOn" value="'.$userLoggedOn.'">
					<label for="activitytype"><small>Activity type</small></label>
					<select id="activitytype"class="drop_down"  name = "activitytype" class="form-control">
						<option value= "prospecting">Prospecting</option>
						<option value= "qualifying">Qualifying</option>
						<option value= "presentation">Presentation</option>
						<option value= "deliver quote">Deliver quote</option>
						<option value= "closing meeting">Closing meeting</option>
						<option value= "followup meeting">Followup meeting</option>
						<option value= "other">Other</option>
					</select><br>
					
					<label for="activity_description"><small>Activity description</small></label>
					<textarea maxlength="80" placeholder = "Max 80 characters" class ="form-textarea" id="activity_description" name="activity_description" type="text"></textarea>';
					
						
					echo'
					<label for="assign"><small>Assign to</small></label>
					<select id="assign"class="drop_down"  name = "assign" class="form-control" required>';
						$sql = "SELECT userid FROM users WHERE active = '1';";
						$res = mysqli_query($con,$sql);

					if (mysqli_num_rows($res) > 0) {
						echo'<option value="" disabled="disabled" selected="selected">Please select</option>';
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
					
					<label for="date"><small>Due date</small></label>
					<input id="date" name="date" type="date" required>
					
					<label for="time"><small>Time</small></label>
					<input id="time" name="time" type="time" required>
					
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