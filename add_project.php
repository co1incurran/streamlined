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
				<form action="add_project_contact.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Add Project</h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					
					<label for="planningNumber"><small>Planning number</small></label>
					<input id="planningNumber" placeholder = "Planning number" name="planningNumber" type="text" required maxlength = "10">
					
					<label for="regarding"><small>Regarding </small></label>
					<textarea maxlength="80" placeholder = "E.g new nursing home"class ="form-textarea" id="regarding" name="regarding" type="text"></textarea>
					
					<label for="startDate"><small>Estimated start date</small></label>
					<input id="startDate" name="startDate" type="date" required>
					
					<label for="location"><small>Location of project</small></label>
					<input id="location" name="location1" placeholder= "Address Line 1" type="text" required maxlength = "45">
					
					<input id="location" name="location2" placeholder= "Address Line 2"  type="text" required maxlength = "35">
					
					<input id="location" name="location3" placeholder= "Address Line 3 (optional)"  type="text" maxlength = "35">
					
					<input id="location" name="location4" placeholder = "Town/City" type="text" required maxlength = "35">
					
					<select id="location" class="drop_down"  name = "locationCounty" class="form-control" required>
						<option value="" disabled selected>Select a county</option>
						<option value= "antrim">Antrim</option>
						<option value= "armagh">Armagh</option>
						<option value= "carlow">Carlow</option>
						<option value= "cavan">Cavan</option>
						<option value= "clare">Clare</option>
						<option value= "cork">Cork</option>
						<option value= "derry">Derry</option>
						<option value= "donegal">Donegal</option>
						<option value= "down">Down</option>
						<option value= "dublin">Dublin</option>
						<option value= "fermanagh">Fermanagh</option>
						<option value= "galway">Galway</option>
						<option value= "kerry">Kerry</option>
						<option value= "kildare">Kildare</option>
						<option value= "kilkenny">Kilkenny</option>
						<option value= "laois">Laois</option>
						<option value= "leitrim">Leitrim</option>
						<option value= "limerick">Limerick</option>
						<option value= "longford">Longford</option>
						<option value= "louth">Louth</option>
						<option value= "mayo">Moyo</option>
						<option value= "meath">Meath</option>
						<option value= "monaghan">Monaghan</option>
						<option value= "offaly">Offaly</option>
						<option value= "roscommon">Roscommon</option>
						<option value= "sligo">Sligo</option>
						<option value= "tipperary">Tipperary</option>
						<option value= "tyrone">Tyrone</option>
						<option value= "waterford">Waterford</option>
						<option value= "westmeath">Westmeath</option>
						<option value= "wexford">Wexford</option>
						<option value= "wicklow">Wicklow</option>
					</select>
					
					<input id="location" name="locationCountry" placeholder = "Country" value = "Ireland" type="text" required maxlength = "28" required>
					
					<label for="assign"><small>Assign to</small></label>
					<select id="assign" class="drop_down"  name = "assign" class="form-control" required>
					<option value="" disabled selected>Select a user</option>';
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
					<textarea maxlength="1000" placeholder = "1000 character limit"class ="form-textarea" id="notes" name="notes" type="text"></textarea>
					
					<input type="submit" id="submit" value="Next">
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