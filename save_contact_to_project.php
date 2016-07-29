<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");//remember to chanege these when all is working
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
//Back URL
$url= $_POST["url"];
$projectid = $_POST['projectid'];
$projectid = trim($projectid);
$projectid = strtolower($projectid);
$filterprojectid = filter_var($projectid, FILTER_SANITIZE_STRING);
$cleanprojectid = mysqli_real_escape_string($con, $filterprojectid);

//this is for getting the id and the type of contact to be added to the project
//it splits the 2 parts of the value and assigns the 2 parts to 2 variables
$radioButton = explode("_", $_POST['choose-contact']);
$type = $radioButton[0];
$id = $radioButton[1];
//echo $type.'<br>';
//echo $id.'<br>';
//now you can use $leave_type to check your conditions by switch or if conditional statements

if($type == 'worker') {
	$sql = "SELECT companyid FROM company WHERE companyid IN (SELECT companyid FROM works_with WHERE workerid = '$id');";
	$res = mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($res);
	$companyid = $row['companyid'];
	//echo $companyid;
	//put the worker into the worker_to_project table
	$sql2 = "INSERT INTO worker_to_project (workerid, projectid) VALUES ('$id', '$projectid');";
	//echo $sql2.'<br>';
	$res2 = mysqli_query($con,$sql2);
	//put the company into the company_to_project table
	$sql3 = "INSERT INTO company_to_project (companyid, projectid) VALUES ('$companyid', '$projectid');";
	//echo $sql3.'<br>';
	$res3 = mysqli_query($con,$sql3);
} else if($type == 'company') {
	$sql4 = "INSERT INTO company_to_project (companyid, projectid) VALUES ('$id', '$projectid');";
	// $sql4.'<br>';
	$res4 = mysqli_query($con,$sql4);
}else if($type == 'customer') {
 // action on Union leave
}



mysqli_close($con);

echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Contact Added</title>
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
				<form action="" id="form" method="post" name="form">
					<h2>Contact Added</h2>
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
</html>';
?>