<?php
include'../include/session.php'

define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");//remember to chanege these when all is working
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
//$url= $_GET['url'];
//$customerid= $_GET['customerid'];
//$companyid= $_GET['companyid'];

//this is for getting the list of manufacturers
$sql = "SELECT name FROM manufacturers ORDER BY name; ";
$res = mysqli_query($con,$sql);
$manufacturers = array();
//store them in an array
while($row = mysqli_fetch_array($res)){
	array_push($manufacturers,
		array('name'=>$row[0]
	));
}

$sql2 = "SELECT userid, first_name, last_name FROM users WHERE active = 1 ORDER BY first_name, last_name; ";
$res2 = mysqli_query($con,$sql2);
$users = array();

while($row = mysqli_fetch_array($res2)){
	array_push($users,
		array('userid'=>$row[0],
			'first_name'=>$row[1],
			'last_name'=>$row[2]
	));
}
//print_r (array_values($users));
mysqli_close($con);

echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Edit Users</title>
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
				<form action="set_users_deactive.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Edit Users</h2>
					<small><a href = "#">Create user</a></small>
					<hr>
					</select><br>';
					foreach ($users as $u){
						$user = ucwords($u['first_name']).' '. ucwords($u['last_name']);
						echo'<label><input type="checkbox" name="checkbox[]" value="'.$u['userid'].'" id="checkbox">'.ucwords($u['first_name']).' '. ucwords($u['last_name']).'</label> <br>';
						//echo '<li>'.$user.'</li>';
					}
					echo' 					
					<input type="submit" id="submit" value="Deactivate">
					<!--<a href="javascript:%20check_empty()" id="submit">Save</a>-->';
					if(!isset ($_GET['showall'])){
						echo '<a href = "deactive_users.php"id="submit">Show deactive users</a>';
					}
					echo'
					<a href = "../contacts/contacts.php"id="submit">Cancel</a>
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
?>