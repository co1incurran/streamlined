<?php
include'../include/session.php';

$url = $_POST['url'];
$projectid = $_POST['projectid'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$mobile = $_POST['mobile'];
$fax = $_POST['fax'];
$jobtitle = $_POST['jobtitle'];

if ($_POST['action'] == 'Create New Company') {
	echo'
	<!DOCTYPE html>
	<html>
		<head>
		<title>Contact details</title>
		<link href="../css/elements.css" rel="stylesheet">
		<script src="../js/popup.js"></script>
		</head>
	<!-- Body Starts Here -->
		<body>
		<div id="body" style="overflow:hidden;">
			<div id="abc">
			<!-- Popup Div Starts Here -->
				<div id="popupContact">	
					<form action="../contacts/save_new_company.php" id="form" method="post" name="form">
						<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
						<h2>Company Details</h2>
						<hr>
						<input type="hidden" name="url" id="url" value="'.$url.'">
						<input type="hidden" name="contactType" id="contactType" value="lead">
						<input type="hidden" name="projectid" id="projectid" value="'.$projectid.'">
						<input type="hidden" name="firstname" id="firstname" value="'.$firstname.'">
						<input type="hidden" name="lastname" id="lastname" value="'.$lastname.'">
						<input type="hidden" name="email" id="email" value="'.$email.'">
						<input type="hidden" name="phone" id="phone" value="'.$phone.'">
						<input type="hidden" name="mobile" id="mobile" value="'.$mobile.'">
						<input type="hidden" name="fax" id="fax" value="'.$fax.'">
						<input type="hidden" name="jobtitle" id="jobtitle" value="'.$jobtitle.'">
						
						<!--<label for="owner"><small>Is this company the owner of the project?</small></label><br><br>
						<label><input type="radio" name="owner" value="Yes"> Yes </label>
						<label><input type="radio" name="owner" value="No" checked="checked"> No</label><br><br>-->

						<label for="companyname"><small>Company Name</small></label>
						<input id="companyname" name="companyname" type="text" placeholder = "Company Name" required maxlength = "70">
						
						<label for="address1"><small>Address</small></label>
						<input id="address1" name="address1" type="text" placeholder="Address line 1" required maxlenght = "45">
						<input id="address2" name="address2" type="text" placeholder="Address line 2" required maxlength = "35">
						<input id="address3" name="address3" type="text" placeholder="Address line 3 (Optional)" maxlength = "35">
						<input id="address4" name="address4" type="text" placeholder="Town/City" required maxlength = "35">
						<input id="county" name="county" type="text" placeholder= "County" maxlength = "20" required>
						<input id="country" name="country" type="text" value="Ireland" maxlength = "28" required>
						
						<label for="sector"><small>Sector</small></label>
						<input id="sector" name="sector" type="text" placeholder= "e.g HSE, education etc"required maxlength = "30">
						
						<label for="sageid"><small>Sage ID</small></label>
						<input id="sageid" name="sageid" type="text" placeholder= "(optional)" maxlength = "20">
						
						<input type="submit" id="submit" value="Next">
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
}


if ($_POST['action'] == 'Choose Existing') {
		define("DB_HOST", "127.0.0.1");
		define("DB_USER", "user");
		define("DB_PASSWORD", "1234");
		define("DB_DATABASE", "database");

		$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

		//get all the company names
		$sql = "SELECT companyid, name FROM company; ";
		//echo $sql;

		$res = mysqli_query($con,$sql);
		$result = array();
		//put all the company names and ids into an array
		while($row = mysqli_fetch_array($res)){
			array_push($result,
				array('companyid'=>$row[0], 
				'name'=>$row[1]
			));
		}
		function compareByName($a, $b) {
		  return strcmp($a["name"], $b["name"]);
		}
		usort($result, 'compareByName');

			echo'
			<!DOCTYPE html>
			<html>
				<head>
				<title>Contact details</title>
				<link href="../css/elements.css" rel="stylesheet">
				<script src="../js/popup.js"></script>
				</head>
			<!-- Body Starts Here -->
				<body>
				<div id="body" style="overflow:hidden;">
					<div id="abc">
					<!-- Popup Div Starts Here -->
						<div id="popupContact">						
							<form action="add_worker_tocompanyandproject.php" id="form" method="post" name="form">
								<h2>What company does this contact work for?</h2>
								<hr>
								<input type="hidden" name="url" id="url" value="'.$url.'">
								<input type="hidden" name="projectid" id="projectid" value="'.$projectid.'">
								<input type="hidden" name="firstname" id="firstname" value="'.$firstname.'">
								<input type="hidden" name="lastname" id="lastname" value="'.$lastname.'">
								<input type="hidden" name="email" id="email" value="'.$email.'">
								<input type="hidden" name="phone" id="phone" value="'.$phone.'">
								<input type="hidden" name="mobile" id="mobile" value="'.$mobile.'">
								<input type="hidden" name="fax" id="fax" value="'.$fax.'">
								<input type="hidden" name="jobtitle" id="jobtitle" value="'.$jobtitle.'">
								
								<div id="users">
								  <input id = "searchbox" class="search" placeholder="Search" />
									<!--<button class="sort" data-sort="name">
									Sort by name
								  </button>-->

								  <ul id="search-list" class="list">';
								  foreach($result as $r){
									//$type = $r['type'];
									$id = $r['companyid'];
									echo'
									<li>
										<label><input type = "radio" id="radio-button" name = "choose-contact" value="'.$id.'" required><p class = "name">'.ucwords($r['name']).'</p><hr></label>
									</li>';
								  }
								  echo'
								  
								  </ul>

								</div>
								
								<input type="submit" id="submit" value="Ok">
								<a onclick="goBack()" id="submit">Back</a>
							</form>
						</div>
					<!-- Popup Div Ends Here -->
					</div>
				</div>
				<script src="../js/list.js"></script>
				</body>
				<script type="text/javascript">
				window.onload = div_show();
				</script>
			<!-- Body Ends Here -->
			</html>
			<script>
		var options = {
		  valueNames: [ "name", "born" ]
		};

		var userList = new List("users", options);
		</script>';
		mysqli_close($con);
}
?>