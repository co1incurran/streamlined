<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$url = $_POST['url'];
$projectid = $_POST['projectid'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$mobile = $_POST['mobile'];
$fax = $_POST['fax'];
$jobtitle = $_POST['jobtitle'];

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
		<link href="css/elements.css" rel="stylesheet">
		<script src="js/popup.js"></script>
		</head>
	<!-- Body Starts Here -->
		<body>
		<div id="body" style="overflow:hidden;">
			<div id="abc">
			<!-- Popup Div Starts Here -->
				<div id="popupContact">						
					<form action="" id="form" method="post" name="form">
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
		<script src="js/list.js"></script>
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
?>