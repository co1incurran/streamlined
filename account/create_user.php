<?php
include'../include/session.php';
include'../include/db_connection.php';
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
	<title>Create User</title>
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
				<form action="save_new_user.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Create User</h2>
					<hr>
					</select><br>
						
						<input placeholder="Username" id="username" name="username" required type="text" maxlenght = "50">
						
						<input id="email" name="email" type="email" maxlenght = "50">

						
						<input id= "user-password" placeholder="Password" required name="user-password" type="password">

						<input id ="retype-password" placeholder="Re-type password"  required name="retype-password" type="password">
					
						<input type="submit" id="submit" value="Save">
						
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