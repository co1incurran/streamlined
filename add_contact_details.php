<?php
$url= $_POST['url'];
$contactType = $_POST['contact'];
//echo $url.'<br>'.$contactType;
if($contactType == 'private customer'){
echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Add job</title>
	<link href="css/elements.css" rel="stylesheet">
	<script src="js/popup.js"></script>
	</head>
<!-- Body Starts Here -->
	<body>
	<div id="body" style="overflow:hidden;">
		<div id="abc">
			<!-- Popup Div Starts Here -->
			<div id="popupContact">
			<!-- Contact Us Form -->
				<form action="save_job.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Add job</h2>
					<hr>
					<input type="hidden" name="url" id="url" value="'.$url.'">
					<input type="hidden" name="contactType" id="contactType" value="'.$contactType.'">
					
					<label for="firstname"><small>First Name</small></label>
					<input id="firstname" name="firstname" type="text" required maxlength = "20">
					
					<label for="lastname"><small>Last Name</small></label>
					<input id="lastname" name="lastname" type="text" required maxlength = "30">
					
					<label for="email"><small>Email</small></label>
					<input id="email" name="email" type="email" required maxlenght = "50">
					
					<label for="phone"><small>Phone Number</small></label>
					<input id="phone" name="phone" type="number" required>
					
					<label for="mobile"><small>Mobile Number</small></label>
					<input id="mobile" name="mobile" type="number" required>
					
					<label for="fax"><small>Fax</small></label>
					<input id="fax" name="fax" type="number" required>

					
					<input type="submit" id="submit" value="Save">
					<!--<a href="javascript:%20check_empty()" id="submit">Save</a>-->
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
}else{
	
}
?>