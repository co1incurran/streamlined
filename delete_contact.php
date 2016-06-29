<?php

define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

if(isset($_POST['delete'])){
	if(isset($_POST['companyid'])){
		$companyid = $_POST['companyid'];
		$sql = "UPDATE company SET hide = 1 WHERE companyid = '$companyid'; ";
	}elseif(isset($_POST['customerid'])){
		$customerid = $_POST['customerid'];
		$sql = "UPDATE customer SET hide = 1 WHERE customerid = '$customerid'; ";
	}
	$res = mysqli_query($con,$sql);
	echo $sql;
	
	echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Contact deleted</title>
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
				<form action="delete_contact.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Contact has been deleted</h2>
					<a href="contacts.php" id="submit">OK</a>
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


echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Delete contact</title>
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
				<form action="delete_contact.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h1>WARNING!</h1>
					<h2>You are about to perminantly delete this contact! Do you wish to proceeed?</h2>
					<hr>
					<input type="hidden" name="delete" id="delete" value="delete">';
					if(isset($_GET['customerid'])){
						$customerid = $_GET['customerid'];
						echo '<input type="hidden" name="customerid" id="customerid" value="'.$customerid.'">';
					}
					if(isset($_GET['companyid'])){
						$companyid = $_GET['companyid'];
						echo '<input type="hidden" name="companyid" id="companyid" value="'.$companyid.'">';
					}
					echo'
					<input type="submit" id="submit" value="Yes, delete contact">
					<a onclick="goBack()" id="submit">No</a>
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
mysqli_close($con);
?>