<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$url= $_POST['url'];
$activityid= $_POST['activityid'];
$complete= $_POST['complete'];

$userName = $_POST['userName'];

$type= $_POST['type'];

if(isset($_POST['prospectingType'])){
	$prospectingType= $_POST['prospectingType'];
}

$description= $_POST['description'];

$dueDate= $_POST['dueDate'];


$time= $_POST['time'];

if(isset($_POST['result'])){
	$result= $_POST['result'];
}

if(isset($_POST['resultDescription'])){
$resultDescription= $_POST['resultDescription'];
}

if(isset($_POST['nextAction'])){
	$nextAction= $_POST['nextAction'];
}

if(isset($_POST['nextActionDescription'])){
	$nextActionDescription= $_POST['nextActionDescription'];

}

echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Task details</title>
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
				<form action="update_task_details.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Task details</h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					<input type="hidden" name="activityid" id="activityid" value="'.$activityid.'">
					
					<label for="type"><small>Task type</small></label>
					<select id="type" class="drop_down" name = "type" class="form-control">';
					
					if($type === 'prospecting'){
						echo'<option selected = "selected "value= "prospecting">Prospecting</option>';
					}else{
						echo'<option value= "prospecting">Prospecting</option>';
					}
					
					if($type === 'qualifying'){
						echo'<option selected = "selected "value= "qualifying">Order Qualifying</option>';
					}else{
						echo'<option value= "qualifying">Qualifying</option>';
					}
					
					if($type === 'presentation'){
						echo'<option selected = "selected" value= "presentation">Presentation</option>';
					}else{
						echo'<option value= "presentation">Presentation</option>';
					}
					
					if($type === 'generate quote'){
						echo'<option selected = "selected" value= "generate quote">Generate quote</option>';
					}else{
						echo'<option value= "generate quote">Generate quote</option>';
					}
					
					if($type === 'deliver quote'){
						echo'<option selected = "selected" value= "deliver quote">Deliver quote</option>';
					}else{
						echo'<option value= "deliver quote">Deliver quote</option>';
					}
					
					if($type === 'closing meeting'){
						echo'<option selected = "selected" value = "closing meeting">Closing meeting</option>';
					}else{
						echo'<option value= "closing meeting">Closing meeting</option>';
					}
					
					if($type === 'followup meeting'){
						echo'<option selected = "selected" value = "followup meeting">Followup meeting</option>';
					}else{
						echo'<option value= "followup meeting">Followup meeting</option>';
					}
					
					if($type === 'other'){
						echo'<option selected = "selected" value = "other">Other</option>';
					}else{
						echo'<option value= "other">Other</option>';
					}
						
					echo'
					</select><br>';
					
					if(isset($_POST['prospectingType'])){
						$prospectingType= $_POST['prospectingType'];
						if($prospectingType != '' && $prospectingType != NULL){
							echo'
							<label for="prospectingType"><small>Prospecting type</small></label>
							<select id="prospectingType" class="drop_down"  name = "prospectingType" class="form-control">';
							
							if($prospectingType === 'phone call'){
								echo'<option selected = "selected" value= "phone call">Phone call</option>';
							}else{
								echo'<option value= "phone call">Phone call</option>';
							}
							
							if($prospectingType === 'door step'){
								echo'<option selected = "selected" value= "door step">Door step</option>';
							}else{
								echo'<option value= "door step">Door step</option>';
							}
							
							if($prospectingType === 'left brochure'){
								echo'<option selected = "selected" value= "left brochure">Left brochure</option>';
							}else{
								echo'<option value= "left brochure">Left brochure</option>';
							}
							
							if($prospectingType === 'left business card'){
								echo'<option selected = "selected" value= "left business card">Left business card</option>';
							}else{
								echo'<option value= "left business card">Left business card</option>';
							}
							
							if($prospectingType === 'courtesy call'){
								echo'<option selected = "selected" value= "courtesy call">Courtesy call</option>';
							}else{
								echo'<option value= "courtesy call">Courtesy call</option>';
							}
							
							if($prospectingType === 'demo'){
								echo'<option selected = "selected" value= "demo">Demo</option>';
							}else{
								echo'<option value= "demo">Demo</option>';
							}
							
							if($prospectingType === 'c.p.d'){
								echo'<option selected = "selected" value= "c.p.d">C.P.D</option>';
							}else{
								echo'<option value= "c.p.d">C.P.D</option>';
							}
							
							if($prospectingType === 'followup meeting'){
								echo'<option selected = "selected" value= "followup meeting">Followup meeting</option>';
							}else{
								echo'<option value= "followup meeting">Followup meeting</option>';
							}
							
							if($prospectingType === 'other'){
								echo'<option selected = "selected" value= "other">Other</option>';
							}else{
								echo'<option value= "other">Other</option>';
							}
							
							echo'
							</select><br>';
						}
					}
					
					echo'
					<label for="description"><small>Task description</small></label>
					<textarea maxlength="80" class ="form-textarea" id="description" name="description" type="text">'.$description.'</textarea>
					
					
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
					
					
					<label for="dueDate"><small>Due date</small></label>
					<input id="dueDate" name="dueDate" value ="'.$dueDate.'" type="date" required>
					
					<label for="time"><small>Time</small></label>
					<input id="time" name="time" value ="'.$time.'" type="time" required>';
					
					if(isset($_POST['result'])){
						$result= $_POST['result'];
						if($result != '' && $result != NULL){
							echo'
							<label for="result"><small>Result</small></label><br>
							<select id="result" class="drop_down"  name = "result" class="form-control">';
									
									if($result === 'no interest'){
										echo'<option selected = "selected" value= "no interest">No interest</option>';
									}else{
										echo'<option value= "no interest">No interest</option>';
									}
									
									if($result === 'not available to talk'){
										echo'<option selected = "selected" value= "not available to talk">Not available to talk</option>';
									}else{
										echo'<option value= "not available to talk">Not available to talk</option>';
									}
									
									if($result === 'awaiting feedback'){
										echo'<option selected = "selected" value= "awaiting feedback">Awaiting feedback</option>';
									}else{
										echo'<option value= "awaiting feedback">Awaiting feedback</option>';
									}
									if($result === 'wants more info'){
										echo'<option selected = "selected" value= "wants more info">Wants more info</option>';
									}else{
										echo'<option value= "wants more info">Wants more info</option>';
									}
									if($result === 'wants a quote'){
										echo'<option selected = "selected" value= "wants a quote">Wants a quote</option>';
									}else{
										echo'<option value= "wants a quote">Wants a quote</option>';
									}
									if($result === 'wants another visit'){
										echo'<option selected = "selected" value= "wants another visit">Wants another visit</option>';
									}else{
										echo'<option value= "wants another visit">Wants another visit</option>';
									}
									
									if($result === 'sold'){
										echo'<option selected = "selected" value= "sold">Sold</option>';
									}else{
										echo'<option value= "sold">Sold</option>';
									}
									
									if($result === 'other'){
										echo'<option selected = "selected" value= "other">Other</option>';
									}else{
										echo'<option value= "other">Other</option>';
									}
									
									if($result === 'on going'){
										echo'<option selected = "selected" value= "on going">On going</option>';
									}else{
										echo'<option value= "on going">On going</option>';
									}
									
									if($result === 'no sale'){
										echo'<option selected = "selected" value= "no sale">No sale</option>';
									}else{
										echo'<option value= "no sale">No sale</option>';
									}
						
					
							
							
							echo'
									</select><br>';
							if(isset($_POST['resultDescription'])){
								$resultDescription= $_POST['resultDescription'];
							}else{
								$resultDescription= '';
							}	
									echo'
									<label for="resultDescription"><small>Result description</small></label>
									<textarea maxlength="200" class ="form-textarea" id="resultDescription" name="resultDescription" type="text">'.$resultDescription.'</textarea>';
						}
					}	
					echo'					
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