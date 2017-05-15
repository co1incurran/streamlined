<?php
include'../include/session.php';

define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
//Back URL
$url= $_POST["url"];
$activityid= $_POST["activityid"];
$assign = $_POST['assign'];

//the user that created the task
$userLoggedOn = $_POST['userLoggedOn'];

//check if it is a task for a project or a customer
if(isset ($_POST['projectid'])){
	//clean the project id
	
	$projectid = $_POST["projectid"];
	//echo $projectid;
	$projectid = trim($projectid);
	$filterprojectid = filter_var($projectid, FILTER_VALIDATE_INT);
	$cleanprojectid = mysqli_real_escape_string($con, $filterprojectid);
}
if(isset ($_POST['companyid'])){
	//COMPANYID
	$companyid = $_POST["companyid"];
	//echo 'Company ID:'. $companyid;
	$companyid = trim($companyid);
	$filtercompanyid = filter_var($companyid, FILTER_VALIDATE_INT);
	$cleancompanyid = mysqli_real_escape_string($con, $filtercompanyid);
}
if(isset ($_POST['customerid'])){
	//CUSTOMERID
	$customerid = $_POST["customerid"];
	//echo 'Customer ID:'. $customerid;	
	$customerid = trim($customerid);
	$filtercustomerid = filter_var($customerid, FILTER_SANITIZE_STRING);
	$cleancustomerid= mysqli_real_escape_string($con, $filtercustomerid);
}

//prospecting type
if (isset ($_POST["type"])){
$type = $_POST["type"];
$type = trim($type);
$type = strtolower($type);
$filtertype = filter_var($type, FILTER_SANITIZE_STRING);
$cleantype = mysqli_real_escape_string($con, $filtertype);
}else{
	$cleantype = '';
}

//result
$result = $_POST["result"];
$result = trim($result);
$result = strtolower($result);
$filterresult = filter_var($result, FILTER_SANITIZE_STRING);
$cleanresult = mysqli_real_escape_string($con, $filterresult);

//results description
$description = $_POST["description"];
$description = trim($description);
$filterdescription = filter_var($description, FILTER_SANITIZE_STRING);
$cleandescription = mysqli_real_escape_string($con, $filterdescription);

//next action
$nextaction = $_POST["next_action"];
$nextaction = trim($nextaction);
$filternextaction = filter_var($nextaction, FILTER_SANITIZE_STRING);
$cleannextaction = mysqli_real_escape_string($con, $filternextaction);

//next activity description
$nextActivityDescription = $_POST["nextactivity_description"];
$nextActivityDescription = trim($nextActivityDescription);
$filternextActivityDescription = filter_var($nextActivityDescription, FILTER_SANITIZE_STRING);
$cleannextActivityDescription = mysqli_real_escape_string($con, $filternextActivityDescription);

//due date of next action
$date = $_POST["date"];
$date = trim($date);
$cleandate= mysqli_real_escape_string($con, $date);

//TIME of next action
$time = $_POST["time"];
$time = trim($time);
$cleantime = mysqli_real_escape_string($con, $time);

//get the current date 
$dt = new DateTime();
$creationdate = $dt->format('Y-m-d');
$currentDate = $creationdate;

//put the data into the completed activity row in the activty table
$sql1 = "UPDATE activity SET complete = 1, prospecting_type = '$cleantype', result = '$cleanresult', result_description= '$cleandescription', next_action = '$cleannextaction', complete_date = '$currentDate' WHERE activityid = $activityid;";
$res1 = mysqli_query($con,$sql1);
//echo $sql1.'<br>';
//make a new activity for the next action data
if($cleannextaction != 'no further action'){
	//this changes the strings to be in the same format as new activities
	if($cleannextaction == 'contact again'){
		$cleannextaction = 'prospecting';
	}
	if($cleannextaction == 'schedule qualify meeting'){
		$cleannextaction = 'qualifying';
	}
	if($cleannextaction == 'schedule presentation meeting'){
		$cleannextaction = 'presentation';
	}
	if($cleannextaction == 'generate quote'){
		$cleannextaction = 'generate quote';
	}
	if($cleannextaction == 'deliver quote'){
		$cleannextaction = 'deliver quote';
	}
	if($cleannextaction == 'schedule close meeting'){
		$cleannextaction = 'closing meeting';
	}
	if($cleannextaction == 'followup meeting'){
		$cleannextaction = 'followup meeting';
	}
	if($cleannextaction == 'create job number'){
		$cleannextaction = 'create job number';
	}
	//put the activity into the activty table
	$sql2 = "INSERT INTO activity (type, description, due_date, time, creation_date, created_by) VALUES ('$cleannextaction', '$cleannextActivityDescription', '$cleandate', '$cleantime', '$creationdate', '$userLoggedOn');";
	$res2 = mysqli_query($con,$sql2);
	//echo $sql2.'<br>';

	//get the activityid of the asset
		$sql3 = "SELECT activityid FROM activity ORDER BY activityid DESC LIMIT 1; ";
		$res3 = mysqli_query($con,$sql3);
		$row = mysqli_fetch_assoc($res3);
		$activityid = $row["activityid"];
		//echo $activityid.'<br>';
		
	//add the activity to the assigned activity table
	
	//NEED TO CHANGE THIS
		$sql4 = "INSERT INTO assigned_activity (userid, activityid) VALUES ('$assign', '$activityid');";
		$res4 = mysqli_query($con,$sql4);
		//echo $sql4;
		
		
		if(isset ($_POST['projectid']) && $_POST['projectid'] != '' ){
			$sql4 = "INSERT INTO project_activity (projectid, activityid) VALUES ('$cleanprojectid', '$activityid');";
			//echo $sql4;
		}else{
			if($companyid !=0){
				$sql4 = "INSERT INTO company_activity (companyid, activityid) VALUES ('$cleancompanyid', '$activityid');";
			
			}else{
				$sql4 = "INSERT INTO customer_activity (customerid, activityid) VALUES ('$cleancustomerid', '$activityid');";	
			}
			
		}
		$res4 = mysqli_query($con,$sql4);
}
$today = date("Y/m/d");
if(isset ($_POST['customerid']) || isset ($_POST['companyid'])){
	if($companyid !=0){
		$sql5 = "UPDATE company SET last_contacted = '$today' WHERE companyid = '$cleancompanyid';";

	}elseif($customerid !=0){
		$sql5 = "UPDATE customer SET last_contacted = '$today' WHERE customerid = '$cleancustomerid';";
	}
	$res5 = mysqli_query($con,$sql5);
	//echo $sql5;
}
mysqli_close($con);
echo'<!DOCTYPE html>
<html>
	<head>
	<title>Activity added</title>
	<link href="./css/elements.css" rel="stylesheet">
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