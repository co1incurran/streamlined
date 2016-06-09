<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$activityid = $_GET['activityid'];
//echo $activityid;
$activityid = mysqli_real_escape_string($con ,$activityid);
$sql = "SELECT * FROM activity WHERE activityid = $activityid; ";
$res = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($res);

$complete = $row["complete"];
$type = ucwords($row["type"]);
$prospectingType = ucwords($row["prospecting_type"]);
$description = $row["description"];
$dueDate = $row["due_date"];
$dueDate = date("d.m.Y", strtotime($dueDate));
$time = $row["time"];
$time = date('h:ia', strtotime($time));
$result = ucwords($row["result"]);
$resultDescription = $row["result_description"];
$creationDate = $row["creation_date"];
$creationDate = date("d.m.Y", strtotime($creationDate));
//echo $creationDate;
echo ' 
<table class = "work-details">
	<tbody>';
	if(!empty($complete)|| !$complete ==''){
		if($complete == 0){
			$complete = 'Incomplete';
		}else{
			$complete = 'Complete';
		}
		echo'<tr><td><strong>Status:</strong></td><td>'.$complete.'</td></tr>';
	}
	if(!empty($type)|| !$type ==''){
		echo'<tr><td><strong>Type:</strong></td><td>'.$type.'</td></tr>';
	}
	if(!empty($prospectingType)|| !$prospectingType ==''){
		echo'<tr><td><strong>Prospecting type:</strong></td><td>'.$prospectingType.'</td></tr>';
	}
	if(!empty($description)|| !$description ==''){
		echo'<tr><td><strong>Description:</strong></td><td>'.$description.'</td></tr>';
	}
	if(!empty($dueDate)|| !$dueDate ==''){
		echo'<tr><td><strong>Due date:</strong></td><td>'.$dueDate.'</td></tr>';
	}
	if(!empty($time)|| !$time ==''){
		echo'<tr><td><strong>Time:</strong></td><td>'.$time.'</td></tr>';
	}
	if(!empty($result)|| !$result ==''){
		echo'<tr><td><strong>Type:</strong></td><td>'.$result.'</td></tr>';
	}
	if(!empty($resultDescription)|| !$resultDescription ==''){
		echo'<tr><td><strong>Result description:</strong></td><td>'.$resultDescription.'</td></tr>';
	}
	if(!empty($creationDate)|| !$creationDate ==''){
		echo'<tr><td><strong>Creation date:</strong></td><td>'.$creationDate.'</td></tr>';
	}
		echo'
	<tbody>
<table>';
		mysqli_close($con);
	?>
		</tbody>
	</table>
</body>
</html>