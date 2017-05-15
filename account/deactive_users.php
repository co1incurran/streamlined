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

$sql2 = "SELECT userid, first_name, last_name FROM users WHERE active = 0 ORDER BY first_name, last_name; ";
$res2 = mysqli_query($con,$sql2);
$num_rows = mysqli_num_rows($res2);
//echo $num_rows;
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
	<title>Deactivated Users</title>
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
				<form action="set_users_active.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Deactivated Users</h2>
					<small><a href = "#">Create user</a></small>
					<hr>
					</select><br>';
					if($num_rows<1){
						echo 'There is currently no deactivated user accounts.';
					}else{
						foreach ($users as $u){
							$user = ucwords($u['first_name']).' '. ucwords($u['last_name']);
							echo'<label><input type="checkbox" name="checkbox[]" value="'.$u['userid'].'" id="checkbox">'.ucwords($u['first_name']).' '. ucwords($u['last_name']).'</label> <br>';
							//echo '<li>'.$user.'</li>';
						}
					}
					if(!($num_rows<1)){
						echo' 					
						<input type="submit" id="submit" value="Activate">
						<!--<a href="javascript:%20check_empty()" id="submit">Save</a>-->';
					}
					/*if(!isset ($_GET['showall'])){
						echo '<a href = "deactive_users.php"id="submit">Show deactive users</a>';
					}*/
					echo'
					<a onclick="goBack()" id="submit">Back</a>
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