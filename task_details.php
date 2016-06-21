<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$url= $_POST['url'];
$activityid= $_POST['activityid'];
$complete= $_POST['complete'];

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
					<!-- <small><a href = "jobs.php?history=true&jobid='..'">Job Histroy</a></small> -->
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					<input type="hidden" name="activityid" id="activityid" value="'.$activityid.'">
					
					<label for="date"><small>Due date</small></label>
					<input id="date" name="date" value ="'.$dueDate.'" type="date" required>
					
					<label for="type"><small>Activity type</small></label>
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
					
					if($type === 'quotation'){
						echo'<option selected = "selected" value= "quotation">Quotation</option>';
					}else{
						echo'<option value= "quotation">Quotation</option>';
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
					<textarea maxlength="200" class ="form-textarea" id="description" name="description" type="text">'.$description.'</textarea>
					
					<label for="dueDate"><small>Due date</small></label>
					<input id="dueDate" name="dueDate" value ="'.$dueDate.'" type="date" required>
					
					<label for="time"><small>Time</small></label>
					<input id="time" name="time" value ="'.$time.'" type="time" required>
					
					<label for="result"><small>Result</small></label>
					<select id="result" class="drop_down"  name = "result" class="form-control">';
							
							if($result === 'phone call'){
								echo'<option selected = "selected" value= "phone call">Phone call</option>';
							}else{
								echo'<option value= "phone call">Phone call</option>';
							}
							
							if($result === 'door step'){
								echo'<option selected = "selected" value= "door step">Door step</option>';
							}else{
								echo'<option value= "door step">Door step</option>';
							}
							
							if($result === 'left brochure'){
								echo'<option selected = "selected" value= "left brochure">Left brochure</option>';
							}else{
								echo'<option value= "left brochure">Left brochure</option>';
							}
							
							if($result === 'left business card'){
								echo'<option selected = "selected" value= "left business card">Left business card</option>';
							}else{
								echo'<option value= "left business card">Left business card</option>';
							}
							
							if($result === 'courtesy call'){
								echo'<option selected = "selected" value= "courtesy call">Courtesy call</option>';
							}else{
								echo'<option value= "courtesy call">Courtesy call</option>';
							}
							
							if($result === 'demo'){
								echo'<option selected = "selected" value= "demo">Demo</option>';
							}else{
								echo'<option value= "demo">Demo</option>';
							}
					echo'
							</select><br>
					<label for="job_number"><small>Job number</small></label>
					<input id="job_number" name="job_number"value ="'.$jobNumber.'" type="text" maxlength="20">
					
					<label for="po_number"><small>PO number</small></label>
					<input id="po_number" name="po_number" value ="'.$poNumber.'" type="text"maxlength="30" >
					
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