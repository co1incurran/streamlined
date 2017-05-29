<?php
include'../include/session.php';

$url = $_GET['url'];
$id =  $_GET['id'];
if (isset($_GET['name'])){
	$line1 = 'placeholder="e.g Service Reminder" value="'.$_GET['name'].'"';
}else{
	$line1 = 'placeholder="e.g Service Reminder"';
}

if (isset($_GET['message'])){
	$line2 = $_GET['message'];
}else{
	$line2 = '';
}
echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Edit Template</title>
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
				<form action="update_template.php" id="form" method="post" name="form">
					<h2>Edit Template</h2>
					<small><a href = "delete_template.php?url='.$url.'&id='.$id.'">Delete Template</a></small>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					
					<input type="hidden" name="id" id="id" value="'.$id.'">
					
					<label for="name"><small>Name of template:</small></label>
					<input id="name" name="name" type="text" '.$line1.' required maxlength = "50">
					
					<label for="message"><small>Message:</small></label>
					<textarea maxlength="480" placeholder="Message (max 480 characters)" class ="form-textarea" id="message" name="message" type="text">'.$line2.'</textarea>
					
					<input type="submit" id="submit" value="Save">
					<a onclick="goBack()" id="submit">Cancel</a>
				</form>
			</div>
		<!-- Popup Div Ends Here -->
		</div>
	</div>
	</body>
	
	<script type="text/javascript">
	function goBack() {
		window.history.go(-1);
	}
	window.onload = div_show();
	</script>
<!-- Body Ends Here -->
</html>';
?>