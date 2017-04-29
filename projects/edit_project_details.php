<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$url= $_GET['url'];
$projectid= $_GET['projectid'];
//$userName= $_GET['userName'];
$userName= '';
$planningNumber = $_GET['planningNumber'];
$startDate= $_GET['startDate'];
$address1= $_GET['address1'];
$address2= $_GET['address2'];
$address3 = $_GET['address3'];
$address4= $_GET['address4'];
$county= $_GET['county'];
$country= $_GET['country'];
$regarding = $_GET['regarding'];
$notes= $_GET['notes'];

echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Project details</title>
	<link href="../css/elements.css" rel="stylesheet">
	<script src="../js/popup.js"></script>
	<style>
		#add_task {
			float: right;
		}
	</style>
	</head>
<!-- Body Starts Here -->
	<body>
	<div id="body" style="overflow:hidden;">
		<div id="abc">
			<!-- Popup Div Starts Here -->
			<div id="popupContact">
			<!-- Contact Us Form -->
				<form action="update_project_details.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Project details</h2>
					<small><a href = "delete_project.php?url='.$url.'&projectid='.$projectid.'">Delete project</a></small>
					<small><a id = "add_task" href = "add_activity.php?url=projects.php&projectid='.$projectid.'&userName='.$userName.'">Add task</a></small>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					<input type="hidden" name="projectid" id="projectid" value="'.$projectid.'">
					
					<label for="planningNumber"><small>Planning Number</small></label>
					<input id="planningNumber" name="planningNumber" placeholder = "Planning Number" value ="'.$planningNumber.'" type="text" maxlength = "10" required>
					
					<label for="startDate"><small>Project Start Date</small></label>
					<input id="startDate" name="startDate" value ="'.$startDate.'" type="date" >
					
					<label for="location"><small>Project Location</small></label>
					<input id="location" name="location1" placeholder = "Address Line 1" value ="'.ucwords($address1).'" type="text" maxlength = "45" required>
					<input id="location" name="location2" placeholder = "Address Line 2" value ="'.ucwords($address2).'" type="text" maxlength = "35" required>
					<input id="location" name="location3" placeholder = "Address Line 3 (optional)" value ="'.ucwords($address3).'" type="text" maxlength = "35">
					<input id="location" name="location4" placeholder = "Town/City" value ="'.ucwords($address4).'" type="text" maxlength = "35" required>
					
					
					<select id="location" class="drop_down"  name = "county" class="form-control" required>';
					if(isset ($_GET['county'])){
						echo '<option value="'.$county.'" selected = "selected">'.ucwords($county).'</option>';
					}else{
						echo '<option value="" disabled selected>Select a county</option>';
					}
					
					echo'
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
					
					
					<input id="location" name="country" placeholder = "Country" value ="Ireland" type="text" maxlength = "28" required>
					
					
					<label for="assign"><small>Assign to</small></label>
					<select id="userName"class="drop_down"  name = "userName" class="form-control">';
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
					
					
					<label for="regarding"><small>Regarding</small></label>
					<input id="regarding" name="regarding" placeholder = "e.g New nursing home being built" value ="'.$regarding.'" type="text" required>
					
					<label for="notes"><small>Notes</small></label>
					<textarea maxlength="1000" placeholder = "Max 1000 characters" class ="form-textarea" id="notes" name="notes" type="text">'.$notes.'</textarea>

					<input type="submit" id="submit" value="Update">
					
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