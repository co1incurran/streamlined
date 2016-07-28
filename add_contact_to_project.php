<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");//remember to chanege these when all is working
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
//Back URL
$url= $_POST["url"];

//this is for getting the id and the type of contact to be added to the project
//it splits the 2 parts of the value and assigns the 2 parts to 2 variables
$radioButton = explode("_", $_POST['choose-contact']);
$type = $radioButton[0];
$id = $radioButton[1];
echo $type.'<br>';
echo $id.'<br>';
//now you can use $leave_type to check your conditions by switch or if conditional statements

/*if($type == 'worker') {
  // action on sick leave
} else if($type == 'company') {
 // action on Union leave
}else if($type == 'customer') {
 // action on Union leave
}*/



mysqli_close($con);

/*echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Contact Added</title>
	<link href=".css/elements.css" rel="stylesheet">
	<script src="js/popup.js"></script>
	</head>
<!-- Body Starts Here -->
	<body>
	<div id="body" style="overflow:hidden;">
		<div id="abc">
			<!-- Popup Div Starts Here -->
			<div id="popupContact">
			<!-- Contact Us Form -->
				<form action="" id="form" method="post" name="form">
					<h2>'.$title.'</h2>
					<hr>
					<a href="'.$url.'" id="submit">OK</a>
				</form>
			</div>
		<!-- Popup Div Ends Here -->
		</div>
	</div>
	</body>
	
	<script type="text/javascript">
	function goBack() {
		window.history.go(-2);
	}
	window.onload = div_show();
	</script>
<!-- Body Ends Here -->
</html>';*/
?>