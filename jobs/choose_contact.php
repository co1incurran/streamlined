<?php
include'../include/session.php';

define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$url = $_GET['url'];
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
//print_r (array_values($result));

////////////////////////////////////////////////////////////////////////////

//get all the private customers names
$sql2 = "SELECT customerid, first_name, last_name FROM customer; ";
//echo $sql;

$res2 = mysqli_query($con,$sql2);
$result2 = array();
//put all the customer names and ids into an array
while($row2 = mysqli_fetch_array($res2)){
	array_push($result2,
		array('customerid'=>$row2[0],
		'first_name'=>$row2[1],
		'last_name'=>$row2[2]
	));
}
//print_r (array_values($result2));

/////////////////////////////////////////////////////////////////////////////

//this is where i put all the contents of the above arrays into one large array
$bigArray = array();
//putting in the companies
foreach ($result as $r1){
	$type = 'company';
	$id = $r1['companyid'];
	$name = $r1['name'];
	array_push($bigArray,
		array('type' => $type,
		'id' => $id,
		'name' => $name
	));
}
//putting in the private customers
foreach($result2 as $r2){
	$type = 'privatecustomer';
	$id = $r2['customerid'];
	$name = $r2['first_name'].' '.$r2['last_name'];
	array_push($bigArray,
		array('type' => $type,
		'id' => $id,
		'name' => $name
	));
}
//arrange the names alphabetically
function compareByName($a, $b) {
  return strcmp($a["name"], $b["name"]);
}
usort($bigArray, 'compareByName');

echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Who is the job for?</title>
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
				<form action="../profile/add_job.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Who is the job for?</h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">;
						<div id="users">
						  <input id = "searchbox" class="search" placeholder="Search" />
							<!--<button class="sort" data-sort="name">
							Sort by name
						  </button>-->

						  <ul id="search-list" class="list">';
						  foreach($bigArray as $bigA){
							$type = $bigA['type'];
							$id = $bigA['id'];
							echo'
							<li>
								<label><input type = "radio" id="radio-button" name = "choose-contact" value="'.$type.'_'.$id.'" required><p class = "name">'.ucwords($bigA['name']).'</p><hr></label>
							</li>';
						  }
						  echo'
						  
						  </ul>

						</div>
						
						<input type="submit" id="submit" value="Select Contact">
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
?>