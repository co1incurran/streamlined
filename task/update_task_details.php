<?php
include'../include/session.php';
include'../include/db_connection.php';
//Back URL
$url= $_POST["url"];

//the id of the task to be updated
$activityid = $_POST["activityid"];


//prospectign type
if(isset($_POST['prospectingType'])){
	$prospectingType = $_POST["prospectingType"];
	$prospectingType = trim($prospectingType);
	$prospectingType = strtolower($prospectingType);
	$filterProspectingType = filter_var($prospectingType, FILTER_SANITIZE_STRING);
	$cleanProspectingType = mysqli_real_escape_string($con, $filterProspectingType);
}else{
	$cleanProspectingType = '';
}

//result
if(isset($_POST['result'])){
	$result = $_POST["result"];
	$result = trim($result);
	$result = strtolower($result);
	$filterResult = filter_var($result, FILTER_SANITIZE_STRING);
	$cleanResult = mysqli_real_escape_string($con, $filterResult);
}else{
	$cleanResult = '';
}

//result description
if(isset($_POST['resultDescription'])){
	$resultDescription = $_POST["resultDescription"];
	$resultDescription = trim($resultDescription);
	$resultDescription = strtolower($resultDescription);
	$filterResultDescription = filter_var($resultDescription, FILTER_SANITIZE_STRING);
	$cleanResultDescription = mysqli_real_escape_string($con, $filterResultDescription);
}else{
	$cleanResultDescription = '';
}

//activity type
$activitytype = $_POST["type"];
$activitytype = trim($activitytype);
$activitytype = strtolower($activitytype);
$filteractivitytype = filter_var($activitytype, FILTER_SANITIZE_STRING);
$cleanactivitytype = mysqli_real_escape_string($con, $filteractivitytype);

//activity description
$activitydescription = $_POST["description"];
$activitydescription = trim($activitydescription);
$filteractivitydescription = filter_var($activitydescription, FILTER_SANITIZE_STRING);
$cleanactivitydescription = mysqli_real_escape_string($con, $filteractivitydescription);

//assigned to
$assign = $_POST["assign"];
$assign = trim($assign);
$filterassign = filter_var($assign, FILTER_SANITIZE_STRING);
$cleanassign = mysqli_real_escape_string($con, $filterassign);

//due date
$date = $_POST["dueDate"];
$date = trim($date);
$cleandate= mysqli_real_escape_string($con, $date);

//TIME
$time = $_POST["time"];
$time = trim($time);
$cleantime = mysqli_real_escape_string($con, $time);

//this checks to make sure an actual change was made. if not it does not update the task
$sql1 = "SELECT * FROM activity WHERE activityid = '$activityid';";
$res1 = mysqli_query($con,$sql1);
$row = mysqli_fetch_assoc($res1);


$currentProspectingType = $row["prospecting_type"];
$currentResult = $row["result"];
$currentResultDescription = $row["result_description"];


$currentActivityType = $row["type"];
$currentActivityDescription = $row["description"];
$currentDueDate = $row["due_date"];
$currentTime = $row["time"];

$sql2 = "SELECT userid FROM users WHERE userid IN (SELECT activityid FROM assigned_activity WHERE activityid = '$activityid');";
$res2 = mysqli_query($con,$sql2);
$row2 = mysqli_fetch_assoc($res2);
$currentUserid = $row2["userid"];


if($cleanProspectingType != $currentProspectingType || $cleanResult != $currentResult || $cleanResultDescription != $currentResultDescription || $cleanactivitytype != $currentActivityType || $cleanactivitydescription != $currentActivityDescription || $cleandate != $currentDueDate || $cleantime != $currentTime || $assign != $currentUserid ){

$sql3 = "UPDATE activity SET type = '$cleanactivitytype', prospecting_type = '$cleanProspectingType', description = '$cleanactivitydescription', due_date = '$cleandate', time = '$cleantime', result = '$cleanResult', result_description = '$cleanResultDescription' WHERE activityid = $activityid;";

$res3 = mysqli_query($con,$sql3);
//echo $sql3;


$sql4 = "UPDATE assigned_activity SET userid = '$assign' WHERE activityid = $activityid;";

$res4 = mysqli_query($con,$sql4);
//echo $sql4;

$text = 'Task updated';
}else{
	$text = 'No changes were made';
}

mysqli_close($con);
echo'<!DOCTYPE html>
<html>
	<head>
	<title>'.$text.'</title>
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
				<form action="" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>'.$text.'</h2>
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