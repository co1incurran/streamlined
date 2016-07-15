<link rel="stylesheet" href="__jquery.tablesorter/themes/blue/style_table.css">
<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");

$url = $_SERVER['REQUEST_URI'];
$url = str_replace('&', '%26', $url);
//get the current date 
$dt = new DateTime();
$currentDate = $dt->format('Y-m-d');
//echo $currentDate.'<br>';
$tomorrow = new DateTime('tomorrow');
$tomorrow = $tomorrow->format('Y-m-d');
//echo $tomorrow->format('Y-m-d');

//getting the date of the start and end of the current week
$monday = date("Y-m-d", strtotime("monday this week"));
$sunday = date("Y-m-d", strtotime("sunday this week"));
//echo '<br>'.$monday;
//echo '<br>'.$sunday.'<br>';

//getting the start and end dates if the current month
// First day of the month.
$startMonth = date('Y-m-01', strtotime($currentDate)).'<br>';

// Last day of the month.
$endMonth = date('Y-m-t', strtotime($currentDate)).'<br>';
$heading = 'Time';
$status = '';
$columnName = 'Contact';

//getting the data from the project
if(isset($_POST['userName'])){
	$userName = $_POST['userName'];
}

if(isset($_POST['projectid'])){
	$projectid = $_POST['projectid'];
	$columnName = 'Planning Number';
}

if(isset($_POST['address1'])){
	$address1 = $_POST['address1'];
}

if(isset($_POST['address2'])){
	$address2 = $_POST['address2'];
}

if(isset($_POST['address3'])){
	$address3 = $_POST['address3'];
}

if(isset($_POST['address4'])){
	$address4 = $_POST['address4'];
}

if(isset($_POST['county'])){
	$county = $_POST['county'];
}

if(isset($_POST['country'])){
	$country = $_POST['country'];
}

if(isset($_POST['type'])){
	$type = $_POST['type'];
}

if($outbox == true){
		$sql = "SELECT * FROM activity WHERE complete = '0' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid != '$userLoggedOn' AND created_by = '$userLoggedOn') ORDER BY creation_date; ";
	}else{

			if(isset($_GET['status'])){
				$status = $_GET['status'];
				//echo $status;
				
				if($status == 'all'){
					$sql = "SELECT * FROM activity WHERE complete = '0' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid = '$userLoggedOn') ORDER BY due_date; ";
				}elseif($status == 'today'){
					$sql = "SELECT * FROM activity WHERE complete = '0' AND due_date = '$currentDate' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid = '$userLoggedOn'); ";
				}elseif($status == 'tomorrow'){
					$sql = "SELECT * FROM activity WHERE complete = '0' AND due_date = '$tomorrow' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid = '$userLoggedOn') ; ";
				}elseif($status == 'week'){
					$sql = "SELECT * FROM activity WHERE complete = '0' AND due_date BETWEEN '$monday' AND '$sunday' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid = '$userLoggedOn') ORDER BY due_date; ";
				}elseif($status == 'month'){
					$sql = "SELECT * FROM activity WHERE complete = '0' AND due_date BETWEEN '$startMonth' AND '$endMonth' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid = '$userLoggedOn') ORDER BY due_date; ";
				}elseif($status == 'overdue'){
					$sql = "SELECT * FROM activity WHERE complete = '0' AND due_date < '$currentDate' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid = '$userLoggedOn') ORDER BY due_date; ";
				}elseif($status == 'completed'){
					$sql = "SELECT * FROM activity WHERE complete = '1' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid = '$userLoggedOn') ORDER BY due_date DESC; ";
					$heading = 'Result';
				}elseif($status == 'project'){
					$sql = "SELECT * FROM activity WHERE activityid IN (SELECT activityid FROM project_activity where projectid = '$projectid') AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid = '$userLoggedOn') ORDER BY activityid DESC LIMIT 1;";
				}else{
					$sql = "SELECT * FROM activity WHERE complete = '0' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid = '$userLoggedOn') ORDER BY due_date; ";
				}
			}else{
					$sql = "SELECT * FROM activity WHERE complete = '0' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid = '$userLoggedOn') ORDER BY due_date; ";
			}
	}

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);


$res = mysqli_query($con,$sql);

$result = array();
 
while($row = mysqli_fetch_array($res)){
	array_push($result,
		array('activityid'=>$row[0],
		'complete'=>$row[1],
		'type'=>$row[2],
		'prospecting_type'=>$row[3],
		'description'=>$row[4],
		'due_date'=>$row[5],
		'time'=>$row[6],
		'result'=>$row[7],
		'result_description'=>$row[8],
		'next_action'=>$row[9],
		'next_action_description'=>$row[10],
		'creation_date'=>$row[11]
	));
}
//print_r (array_values($result));
?>	 

	
<!-- ... -->
<table id="activityList" class="tablesorter" align="center">
	<thead>
		<tr class = "blue-row">
		<?php 
			if($outbox == false){
				echo'<td id = "td-header" class = "asset-list"><i class="fa fa-check"></i></td>';
			} 
		?>
			<th id = "first-table-column" class = "asset-list"><strong>Type</strong></th>
			<th class = "asset-list"><strong>Description</strong></th>
			<th class = "asset-list"><strong>Due Date</strong></th>
			<th class = "asset-list"><strong><?php echo $heading; ?></strong></th>
<?php 
	if(!isset($_POST['projectid'])){
		echo'
			<th class = "asset-list"><strong>'.$columnName.'</strong></th>
			
			<th class = "asset-list"><strong>County</strong></th>';
			if($outbox == true){
			echo '<th class = "asset-list"><strong>Assigned to</strong></th>';
			}
			echo'
			<th class = "asset-list"><strong>Creation date</strong></th>';
	}
?>	
		</tr>
	</thead>
<tbody>
	<?php
		foreach ($result as $results){
			$companyid = 0;
			$customerid = 0;
			$activityid = $results['activityid'];
			$complete = $results['complete'];
			$type = $results['type'];
			$prospectingType = $results['prospecting_type'];
			$description = $results['description'];
			$dueDate = $results['due_date'];
			$time = $results['time'];
			$result = $results['result'];
			$resultDescription = $results['result_description'];
			$nextAction = $results['next_action'];
			$nextActionDescription = $results['next_action_description'];
			$creationDate = $results['creation_date'];
			
			
			//To get the company or customer the activity is for
			$sql2 = "SELECT companyid, name, county FROM company WHERE companyid IN (SELECT companyid FROM company_activity WHERE activityid = '$activityid'); ";
			$res2 = mysqli_query($con,$sql2);
			if(mysqli_num_rows($res2) < 1){
				$sql3 = "SELECT customerid, first_name, last_name, county FROM customer WHERE customerid IN (SELECT customerid FROM customer_activity WHERE activityid = '$activityid'); ";
				$res3 = mysqli_query($con,$sql3);
				if(mysqli_num_rows($res3) < 1 && isset($_POST['projectid'])){
					$sql4 = "SELECT companyid, name, county FROM company WHERE companyid IN (SELECT companyid FROM company_to_project WHERE projectid = '$projectid'); ";
					$res4 = mysqli_query($con,$sql4);
					$row = mysqli_fetch_assoc($res4);
					$companyid = $row["companyid"];
				}else{
					$row = mysqli_fetch_assoc($res3);
					$customerid = $row["customerid"];
				}
			}else{
				$row = mysqli_fetch_assoc($res2);
				$companyid = $row["companyid"];
			}
			
				//to get the employee the task is assigned to
				$sql4 = "SELECT userid, first_name, last_name FROM users WHERE userid IN(SELECT userid FROM assigned_activity WHERE activityid = '$activityid');";
				$res4 = mysqli_query($con,$sql4);
				$user = mysqli_fetch_assoc($res4);
				$userName = $user['userid'];
				$employee = $user["first_name"].' '.$user["last_name"];
			
	?>
			<tr>
				<?php
					if($outbox == false){
						if($status != 'completed'){
							if($results['type'] == 'prospecting'){
								echo'<td id= "complete-button"><a href="prospecting_results.php?url='.$url.'&activityid='.$activityid.'&customerid='.$customerid.'&companyid='.$companyid.'&userName = '.$userName.'"><i class="fa fa-square-o"></i></a></td>';
							}elseif ($type == 'create job number'){
								echo'<td id= "complete-button"><a href="add_job.php?url='.$url.'&activityid='.$activityid.'&customerid='.$customerid.'&companyid='.$companyid.'"><i class="fa fa-square-o"></i></a></td>';
							}else{
								echo'<td id= "complete-button"><a href="activity_results.php?url='.$url.'&activityid='.$activityid.'&customerid='.$customerid.'&companyid='.$companyid.'&userName = '.$userName.'" ><i class="fa fa-square-o"></i></a></td>';
							}
						}else{
							echo'<td id= "complete-button"><a href="incomplete.php?url='.$url.'&activityid='.$activityid.'" ><i class="fa fa-check-square-o"></i></a></td>';
						}
					}
				?>
				<td>
				<?php 
				//this picks which icon to put next to the task type
					if ($results['type'] == 'prospecting'){
						$icon = '<i class="fa fa-binoculars"> </i>';
					}
					elseif ($results['type'] == 'qualifying'){
						$icon = '<i class="fa fa-spinner"></i>';
					}
					elseif ($results['type'] == 'presentation'){
						$icon = '<i class="fa fa-bar-chart"></i>';
					}
					elseif ($results['type'] == 'deliver quote'){
						$icon = '<i class="fa fa-tag"></i>';
					}
					elseif ($results['type'] == 'closing meeting'){
						$icon = '<i class="fa fa-lock"></i>';
						echo ' ';
					}
					elseif ($results['type'] == 'generate quote'){
						$icon = '<i class="fa fa-print"></i>';
						echo ' ';
					}
					elseif ($results['type'] == 'followup meeting'){
						$icon = '<i class="fa fa-coffee"></i>';
					}
					elseif ($results['type'] == 'other'){
						$icon = '<i class="fa fa-question"></i>';
					}
					elseif ($results['type'] == 'create job number'){
						$icon = '<i class="fa fa-file-text"></i>';
					}else {
						$icon = '<i class="fa fa-question"></i>';
					}
				?>
				<?php
								
					echo'
					<form action="task_details.php" id="job-list" method="post" name="job-list">
						<input type="hidden" name="url" id="url" value="'.$url.'">
						<input type="hidden" name="userName" id="userName" value="'.$userName.'">
						<input type="hidden" name="activityid" id="activityid" value="'.$activityid.'">
						
						<input type="hidden" name="complete" id="complete" value="'.$complete.'">
						<input type="hidden" name="type" id="type" value="'.$type.'">
						
						<input type="hidden" name="prospectingType" id="prospectingType" value="'.$prospectingType.'">
						<input type="hidden" name="description" id="description" value="'.$description.'">
						
						<input type="hidden" name="dueDate" id="dueDate" value="'.$dueDate.'">
						<input type="hidden" name="time" id="time" value="'.$time.'">
						
						<input type="hidden" name="result" id="result" value="'.$result.'">
						<input type="hidden" name="resultDescription" id="resultDescription" value="'.$resultDescription.'">
						
						<input type="hidden" name="nextAction" id="nextAction" value="'.$nextAction.'">
						<input type="hidden" name="nextActionDescription" id="nextActionDescription" value="'.$nextActionDescription.'">
						'.$icon.' '.'<input type="submit" id="job-type" value="'.ucwords($results['type']).'">
					</form>';
				?>
				</td>
				<td>
					<?php 
						echo $results['description'];
					?>
				</td>
				<td>
					<?php $originalDate = $results['due_date'];
						$newDate = date("d/m/Y", strtotime($originalDate));
						echo $newDate;
						$creationDate = $results['creation_date'];
						$creationDate = date("d/m/Y", strtotime($creationDate));
					?>
				</td>
				<td>
					<?php 
						if($heading == 'Result'){
							echo ucwords($result);
						}else{
							echo date('h:ia', strtotime($results['time']));
						}
					?>
				</td>
				
				<?php
				
					
					//put in the link to the project details here
					if(!isset ($_POST['projectid'])){
						echo'<td>';
						echo '<a href = "profile.php?customerid='.$customerid.'&companyid='.$companyid.'" class="name">';
						
							if($customerid >= 1){
								echo ucwords($row['first_name']).' '.ucwords($row['last_name']);
							}else{
								echo ucwords($row['name']);
							}
					
						echo'
						</a></td>
						<td>'.ucwords($row['county']).'</td>';
						if($outbox == true){
							echo'<td>'.ucwords($employee).'</td>';
						}
						echo '<td>'.$creationDate.'</td>';
					}
				?>
			</tr>
	<?php
		}
		mysqli_close($con);
	?>
		</tbody>
	</table>
</body>
</html>