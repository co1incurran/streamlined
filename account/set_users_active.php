<?php
include'../include/session.php';
include'../include/db_connection.php';

//I need to get the id of the user and change the active value to false in the table
foreach($_POST['checkbox'] as $userid) {
	$sql = "UPDATE users SET active = 1 WHERE userid = '$userid';";
	$res = mysqli_query($con,$sql);
	//echo $sql.'<br>';
//	echo $userid.'<br>';
}
//also go back and adda  activate button to  the form before this to reactivate a user 
mysqli_close($con);
echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Users activated</title>
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
					<h2>Activated</h2>
							
					<a href = "users.php"id="submit">Ok</a>
					<!--<a href="javascript:%20check_empty()" id="submit">Save</a>-->';
					if(!isset ($_GET['showall'])){
						echo '<a href = "deactive_users.php"id="submit">Show deactive users</a>';
					}
					echo'
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