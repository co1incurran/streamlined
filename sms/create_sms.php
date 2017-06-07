<?php
include'../include/session.php';
include'../include/db_connection.php';
$url = $_POST['url'];

//this is for getting the id and the type of contact to be sent a message
//it splits the 2 parts of the value and assigns the 2 parts to 2 variables

if(isset($_POST['checkbox'])){
echo'
	<!DOCTYPE html>
	<html>
		<head>
		<title>No contacts were selected</title>
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
					<form action="#" id="form" method="post" name="form">
						<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
						<h2>No contacts were selected</h2>
						<hr>';
		foreach($_POST['checkbox'] as $contact) {
		//this is for getting the id and the type of contact to be sent a message
		//it splits the 2 parts of the value and assigns the 2 parts to 2 variables
		$values = explode("-", $contact);
		$type = $values[0];
		$id = $values[1];
		$number = $values[2];
		echo $type.' - '.$id.' - '.$number.'</br>';
		
		}
		echo'
			<a href="'.$url.'" id="submit">Back</a>
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
}else{
	echo'
	<!DOCTYPE html>
	<html>
		<head>
		<title>No contacts were selected</title>
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
					<form action="#" id="form" method="post" name="form">
						<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
						<h2>No contacts were selected</h2>
						<hr>
						<a href="'.$url.'" id="submit">Back</a>
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
?>