<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$url= $_GET['url'];
echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Add project</title>
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
					<h2>Add Project</h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">

					<label for="name"><small>Project name</small></label>
					<input id="name" name="name" type="text" required maxlength = "50">
					
					<label for="regarding"><small>Regarding </small></label>
					<textarea maxlength="80" placeholder = "E.g new nursing home"class ="form-textarea" id="regarding" name="regarding" type="text"></textarea>
					
					<label for="planningNumber"><small>Planning number</small></label>
					<input id="planningNumber" name="planningNumber" type="text" required maxlength = "30">
					
					<label for="startDate"><small>Estimated start date</small></label>
					<input id="startDate" name="startDate" type="date">
					
					<label for="address"><small>Location of project</small></label>
					<input id="address" name="address1" placeholder= "Address Line 1" type="text" required maxlength = "45">
					
					<input id="address" name="address2" placeholder= "Address Line 2"  type="text" required maxlength = "35">
					
					<input id="address" name="address3" placeholder= "Address Line 3 (optional)"  type="text" maxlength = "35">
					
					<input id="address" name="address4" placeholder = "Town/City" type="text" required maxlength = "35">
					
					<input id="address" name="county" placeholder = "County" type="text" required maxlength = "20">
					
					<input id="address" name="country" placeholder = "Country" value = "Ireland" type="text" required maxlength = "28">
					
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
					
					<label for="notes"><small>Project notes</small></label>
					<textarea maxlength="1000" class ="form-textarea" id="notes" name="notes" type="text"></textarea>
					
					<label for="job_number"><small>Job number</small></label>
					<input id="job_number" name="job_number" type="text" maxlength="20">
					
					<label for="po_number"><small>PO number</small></label>
					<input id="po_number" name="po_number" type="text" maxlength="30" >
					
					<label for="quote_number"><small>Quote number</small></label>
					<input id="quote_number" name="quote_number" type="text" maxlength="30" >
					
					
					<label for="sage_reference"><small>Sage reference</small></label>
					<input id="sage_reference" name="sage_reference" type="text" maxlength="20">
					
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