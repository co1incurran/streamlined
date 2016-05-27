<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$url= $_GET['url'];
$customerid= $_GET['customerid'];
$companyid= $_GET['companyid'];

echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Add activity</title>
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
				<form action="save_activity.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Add activity</h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					<input type="hidden" name="customerid" id="customerid" value="'.$customerid.'">
					<input type="hidden" name="companyid" id="companyid" value="'.$companyid.'">
					
					<label for="activitytype"><small>Activity type</small></label>
					<select id="activitytype"class="drop_down"  name = "activitytype" class="form-control">
						<option value= "prospecting">Prospecting</option>
						<option value= "qualifying">Qualifying call</option>
						<option value= "presentation">Presentation</option>
						<option value= "quotation">Quotation</option>
						<option value= "closing meeting">Closing meeting</option>
						<option value= "followup meeting">Followup meeting</option>
						<option value= "other">Other</option>
					</select><br>
					
					<label for="activity_description"><small>Activity description</small></label>
					<textarea maxlength="200" class ="form-textarea" id="activity_description" name="activity_description" type="text"></textarea>';
					
						$sql = "SELECT userid FROM users;";
						$res = mysqli_query($con,$sql);
					echo'
					<label for="assign"><small>Assign to</small></label>
					<select id="assign"class="drop_down"  name = "assign" class="form-control">';
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
	<script type = "text/javascript">
		$("#activitytype").on("change", function(){
			console.log($("#activitytype").val());
			$("#activitytype2").html("");
			if($("#activitytype").val()==15){
				$("#activitytype2").append("<option value="19">19</option>");
				$("#activitytype2").append("<option value="20">20</option>");
				$("#activitytype2").append("<option value="21">21</option>");
			}else{
				$("#activitytype2").append("<option value="6">6</option>");
				$("#activitytype2").append("<option value="7">7</option>");
				$("#activitytype2").append("<option value="8">8</option>");
				$("#activitytype2").append("<option value="9">9</option>");
			}
		});
	</script>
	
<!-- Body Ends Here -->
</html>';
mysqli_close($con);
?>