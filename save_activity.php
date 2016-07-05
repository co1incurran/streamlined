<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
//Back URL
$url= $_POST["url"];

//COMPANYID
if(isset($_POST['companyid'])){
	$companyid = $_POST["companyid"];
	$companyid = trim($companyid);
	$filtercompanyid = filter_var($companyid, FILTER_VALIDATE_INT);
	$cleancompanyid = mysqli_real_escape_string($con, $filtercompanyid);
}

//CUSTOMERID
if(isset($_POST['customerid'])){
	$customerid = $_POST["customerid"];
	$customerid = trim($customerid);
	$filtercustomerid = filter_var($customerid, FILTER_SANITIZE_STRING);
	$cleancustomerid= mysqli_real_escape_string($con, $filtercustomerid);
}

//projectid
if(isset($_POST['projectid'])){
	$projectid = $_POST["projectid"];
	$projectid = trim($projectid);
	$filterprojectid = filter_var($projectid, FILTER_SANITIZE_STRING);
	$cleanprojectid= mysqli_real_escape_string($con, $filterprojectid);
}

//activity type
$activitytype = $_POST["activitytype"];
$activitytype = trim($activitytype);
$activitytype = strtolower($activitytype);
$filteractivitytype = filter_var($activitytype, FILTER_SANITIZE_STRING);
$cleanactivitytype = mysqli_real_escape_string($con, $filteractivitytype);

//activity description
$activitydescription = $_POST["activity_description"];
$activitydescription = trim($activitydescription);
$filteractivitydescription = filter_var($activitydescription, FILTER_SANITIZE_STRING);
$cleanactivitydescription = mysqli_real_escape_string($con, $filteractivitydescription);

//assigned to
$assign = $_POST["assign"];
$assign = trim($assign);
$filterassign = filter_var($assign, FILTER_SANITIZE_STRING);
$cleanassign = mysqli_real_escape_string($con, $filterassign);

//due date
$date = $_POST["date"];
$date = trim($date);
$cleandate= mysqli_real_escape_string($con, $date);

//TIME
$time = $_POST["time"];
$time = trim($time);
$cleantime = mysqli_real_escape_string($con, $time);

//get the current date 
$dt = new DateTime();
$creationdate = $dt->format('Y-m-d');

//put the activity into the activty table
$sql1 = "INSERT INTO activity (type, description, due_date, time, creation_date) VALUES ('$cleanactivitytype', '$cleanactivitydescription', '$cleandate', '$cleantime', '$creationdate');";
$res1 = mysqli_query($con,$sql1);
//echo $sql1;

//get the activityid of the activity
	$sql2 = "SELECT activityid FROM activity ORDER BY activityid DESC LIMIT 1; ";
	$res2 = mysqli_query($con,$sql2);
	$row = mysqli_fetch_assoc($res2);
    $activityid = $row["activityid"];
	//echo '<br>' .$activityid;
	
//add the activity to the assigned activity table
	$sql3 = "INSERT INTO assigned_activity (userid, activityid) VALUES ('$cleanassign', '$activityid');";
	$res3 = mysqli_query($con,$sql3);
	//echo $sql3;
	
	if(isset($_POST['companyid'])){
		if($companyid !=0){
			$sql4 = "INSERT INTO company_activity (companyid, activityid) VALUES ('$cleancompanyid', '$activityid');";
			//echo $sql4;
		}else{
			$sql4 = "INSERT INTO customer_activity (customerid, activityid) VALUES ('$cleancustomerid', '$activityid');";
			//echo $sql4;
		}
	}elseif(isset($_POST['projectid'])){
		$sql4 = "INSERT INTO project_activity (projectid, activityid) VALUES ('$cleanprojectid', '$activityid');";
			//echo $sql4;
	}
	$res4 = mysqli_query($con,$sql4);
mysqli_close($con);
echo'<!DOCTYPE html>
<html>
	<head>
	<title>Task added</title>
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
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Task added</h2>
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