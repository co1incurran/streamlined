<link rel="stylesheet" href="../__jquery.tablesorter/themes/blue/style_table.css">
<?php
//set global variable to false
$global = false;

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
$heading2 = 'Due Date';
$heading3 = 'Days Open';
$status = '';
$columnName = 'Contact';

//getting the data from the project
if(isset($_POST['userName'])){
	$userName = $_POST['userName'];
}
$projectInfo = '';
//$projectInfo = "&projectid='.$projectid.'";
if(isset($_POST['projectid']) && $_POST['projectid'] != '' ){
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
		$sql = "SELECT * FROM activity WHERE complete = '0' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid != '$userLoggedOn' AND created_by = '$userLoggedOn') ORDER BY activityid DESC; ";
	}else{
			if(isset($_GET['status'])){
				$status = $_GET['status'];
				//echo $status;
				
				if($status == 'all' || $_GET['status'] == ''){
					//this is how the date picker feature is implemented
					if(isset($_POST['date1']) || isset($_POST['date1'])){
						if($_POST['date1'] != '' || $_POST['date2'] != ''){
							//this checks if the date checker feature is used
							if(isset($_POST['date1']) && $_POST['date1'] != ''){
								$date1  = $_POST['date1'];
								$date2 = date("Y-m-d");
								if(isset($_POST['date2']) && $_POST['date2'] != ''){
								$date2  = $_POST['date2'];
								}
								$sql = "SELECT * FROM activity WHERE complete = '0' AND due_date >='$date1' AND due_date <='$date2' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid = '$userLoggedOn') ORDER BY due_date; ";
								//echo $sql;
							}elseif((!isset($_POST['date1']) || $_POST['date1'] == '' )&& isset($_POST['date2'])){
								$date2  = $_POST['date2'];
									$sql = "SELECT * FROM activity WHERE complete = '0' AND due_date <='$date2' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid = '$userLoggedOn') ORDER BY due_date; ";
								//echo $sql;
							}else{
								$sql = "SELECT * FROM activity WHERE complete = '0' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid = '$userLoggedOn') ORDER BY activityid DESC; ";
							}
						}else{
							$sql = "SELECT * FROM activity WHERE complete = '0' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid = '$userLoggedOn') ORDER BY activityid DESC; ";
						}
					}else{
						$sql = "SELECT * FROM activity WHERE complete = '0' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid = '$userLoggedOn') ORDER BY activityid DESC; ";
					}
					
					
				}elseif($status == 'global' && $admin == true){
					
					//these 2 ifs are to ensure there is a date entered
					if(isset($_POST['date1']) || isset($_POST['date1'])){
						if($_POST['date1'] != '' || $_POST['date2'] != ''){
							//this checks if the date checker feature is used
							if(isset($_POST['date1']) && $_POST['date1'] != ''){
								$date1  = $_POST['date1'];
								$date2 = date("Y-m-d");
								if(isset($_POST['date2']) && $_POST['date2'] != ''){
								$date2  = $_POST['date2'];
								}
								
								
								//AND new ='0'
								$sql = "SELECT * FROM activity WHERE complete = '0' AND new !='1' AND due_date >='$date1' AND due_date <='$date2' ORDER BY due_date ; ";
								//echo $sql;
							}elseif((!isset($_POST['date1']) || $_POST['date1'] == '' )&& isset($_POST['date2'])){
								$date2  = $_POST['date2'];
							$sql = "SELECT * FROM activity WHERE complete = '0' AND new !='1' AND due_date <='$date2' ORDER BY due_date ; ";
								//echo $sql;
							}else{
								$sql = "SELECT * FROM activity WHERE complete = '1' AND new !='1' ORDER BY activityid DESC; ";
							}
						}else{
							$sql = "SELECT * FROM activity WHERE complete = '0' AND new !='1' ORDER BY activityid DESC; ";
						}
					}else{
						$sql = "SELECT * FROM activity WHERE complete = '0' AND NEW !='1' ORDER BY activityid DESC; ";
					}
					
					$global = true;
					
					
				}elseif($status == 'globalcomplete' && $admin == true){
					//these 2 ifs are to ensure there is a date entered
					if(isset($_POST['date1']) || isset($_POST['date1'])){
						if($_POST['date1'] != '' || $_POST['date2'] != ''){
							//this checks if the date checker feature is used
							if(isset($_POST['date1']) && $_POST['date1'] != ''){
								$date1  = $_POST['date1'];
								$date2 = date("Y-m-d");
								if(isset($_POST['date2']) && $_POST['date2'] != ''){
								$date2  = $_POST['date2'];
								}
								$sql = "SELECT * FROM activity WHERE complete = '1' AND new ='0' AND complete_date >='$date1' AND complete_date <='$date2'; ";
								//echo $sql;
							}elseif((!isset($_POST['date1']) || $_POST['date1'] == '' )&& isset($_POST['date2'])){
								$date2  = $_POST['date2'];
								$sql = "SELECT * FROM activity WHERE complete = '1' AND new ='0' AND complete_date <= '$date2'; ";
								//echo $sql;
							}else{
								$sql = "SELECT * FROM activity WHERE complete = '1' AND new ='0'; ";
							}
						}else{
							$sql = "SELECT * FROM activity WHERE complete = '1' AND new ='0'; ";
						}
					}else{
						$sql = "SELECT * FROM activity WHERE complete = '1' AND new ='0'; ";
					}
				
					$global = true;
					$heading = 'Result';
					$heading2 = 'Completion Date';
					$heading3 = 'Punctuality';
					
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
					if(isset($_POST['date1']) || isset($_POST['date1'])){
						if($_POST['date1'] != '' || $_POST['date2'] != ''){
							//this checks if the date checker feature is used
							if(isset($_POST['date1']) && $_POST['date1'] != ''){
								$date1  = $_POST['date1'];
								$date2 = date("Y-m-d");
								if(isset($_POST['date2']) && $_POST['date2'] != ''){
								$date2  = $_POST['date2'];
								}
								$sql = "SELECT * FROM activity WHERE complete = '1' AND complete_date >='$date1' AND complete_date <='$date2' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid = '$userLoggedOn') ORDER BY complete_date DESC; ";
								//echo $sql;
							}elseif((!isset($_POST['date1']) || $_POST['date1'] == '' )&& isset($_POST['date2'])){
								$date2  = $_POST['date2'];
								$sql = "SELECT * FROM activity WHERE complete = '1' AND complete_date <='$date2' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid = '$userLoggedOn') ORDER BY complete_date DESC; ";
								//echo $sql;
							}else{
								$sql = "SELECT * FROM activity WHERE complete = '1' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid = '$userLoggedOn') ORDER BY complete_date DESC; ";
							}
						}else{
							$sql = "SELECT * FROM activity WHERE complete = '1' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid = '$userLoggedOn') ORDER BY complete_date DESC; ";
						}
					}else{
						$sql = "SELECT * FROM activity WHERE complete = '1' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid = '$userLoggedOn') ORDER BY complete_date DESC; ";
						//echo $sql;
					}
					$heading = 'Result';
					$heading2 = 'Completion Date';
					$heading3 = 'Punctuality';
				}elseif($status == 'project'){
					$sql = "SELECT * FROM activity WHERE activityid IN (SELECT activityid FROM project_activity where projectid = '$projectid') AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid = '$userLoggedOn') ORDER BY activityid DESC LIMIT 1;";
				}else{
					$sql = "SELECT * FROM activity WHERE complete = '0' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid = '$userLoggedOn') ORDER BY creation_date DESC; ";
				}
			}else{
					$sql = "SELECT * FROM activity WHERE complete = '0' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid = '$userLoggedOn') ORDER BY activityid DESC; ";
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
		'creation_date'=>$row[11],
		'created_by'=>$row[12],
		'new'=>$row[13],
		'complete_date'=>$row[14]
	));
}
//print_r (array_values($result));
?>	 

	
<!-- ... -->
<table id="activityList" class="tablesorter filterable" align="center">
	<thead>
		<tr class = "blue-row">
		<?php 
			if($outbox == false){
				echo'<td id = "td-header" class = "asset-list"><i class="fa fa-check"></i></td>';
			} 
		?>
			<th id = "first-table-column" class = "asset-list"><strong>Type</strong></th>
			<th class = "asset-list"><strong>Description</strong></th>
			<th class = "asset-list"><strong><?php echo $heading2; ?></strong></th>
			<th class = "asset-list"><strong><?php echo $heading3; ?></strong></th>
			<th class = "asset-list"><strong><?php echo $heading; ?></strong></th>
<?php 
	if(!isset($_POST['projectid'])){
		echo'
			<th class = "asset-list"><strong>'.$columnName.'</strong></th>';
			if($status != 'global' && $status != 'globalcomplete' ){
				echo'
				<th class = "asset-list"><strong>City/Town</strong></th>';
			}
				
			
			echo'
			<th class = "asset-list"><strong>County</strong></th>
			<th class = "asset-list"><strong>Creation date</strong></th>';
			if($outbox == true || $global == true){
			echo '<th class = "asset-list"><strong>Assigned to</strong></th>';
			}
			echo'
			<th class = "asset-list"><strong>Created by</strong></th>';
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
			$createdBy = $results['created_by'];
			$new = $results['new'];
			$completeDate = $results['complete_date'];
			
			$highlight = '';
			$projectid = '';
			//current date
				//$todayDate = new DateTime();
				$todayDate = date('Y-m-d');
			//to check what tasks are overdue and then highlight them in red by setting a class attribute on the row in the table
			if(($todayDate > $dueDate) && $complete == '0'){
				$highlight = 'red-row';
			}
			
			//picking the date to show
			if($status == 'completed' || $status == 'globalcomplete'){
				$date = $completeDate;
			}else{
				$date = $dueDate;
			}
			
			
			//this is the setter for projects or not a project
			$project = false;
			
			//To get the company or customer the activity is for
			$sql2 = "SELECT companyid, name, address_line4, address_line3, address_line2, county FROM company WHERE companyid IN (SELECT companyid FROM company_activity WHERE activityid = '$activityid'); ";
			$res2 = mysqli_query($con,$sql2);
			if(mysqli_num_rows($res2) < 1){
				$sql3 = "SELECT customerid, first_name, last_name, address_line4, address_line3, address_line2, county FROM customer WHERE customerid IN (SELECT customerid FROM customer_activity WHERE activityid = '$activityid'); ";
				$res3 = mysqli_query($con,$sql3);
				if(mysqli_num_rows($res3) < 1 && isset($_POST['projectid'])){
					$sql4 = "SELECT companyid, name, county FROM company WHERE companyid IN (SELECT companyid FROM company_to_project WHERE projectid = '$projectid'); ";
					$res4 = mysqli_query($con,$sql4);
					$row = mysqli_fetch_assoc($res4);
					$companyid = $row["companyid"];
					$address_line4 = $row["address_line4"];
					$address_line3 = $row["address_line3"];
					$address_line2 = $row["address_line2"];
					$county = ucwords($row['county']);
				}elseif(mysqli_num_rows($res3) < 1 && !isset($_POST['projectid'])){
					$project = true;
					$sql4 = "SELECT projectid, planning_number, address4, county FROM projects WHERE projectid IN (SELECT projectid FROM project_activity WHERE activityid = '$activityid');";
					//echo $sql4.'<br>';
					$res4 = mysqli_query($con,$sql4);
					$row = mysqli_fetch_assoc($res4);
					$city = ucwords($row['address4']);
					$county = ucwords($row['county']);
					$projectid = $row['projectid'];
					$planningNumber = $row["planning_number"];
				}else{
					$row = mysqli_fetch_assoc($res3);
					$customerid = $row["customerid"];
					$address_line4 = $row["address_line4"];
					$address_line3 = $row["address_line3"];
					$address_line2 = $row["address_line2"];
					$county = ucwords($row['county']);
				}
			}else{
				$row = mysqli_fetch_assoc($res2);
				$companyid = $row["companyid"];
				$address_line4 = $row["address_line4"];
				$address_line3 = $row["address_line3"];
				$address_line2 = $row["address_line2"];
				$county = ucwords($row['county']);
			}
			
				//to get the employee the task is assigned to
				$sql4 = "SELECT userid, first_name, last_name FROM users WHERE userid IN(SELECT userid FROM assigned_activity WHERE activityid = '$activityid');";
				$res4 = mysqli_query($con,$sql4);
				$user = mysqli_fetch_assoc($res4);
				$userName = $user['userid'];
				$employee = $user["first_name"].' '.$user["last_name"];
				
				//this put a view button for the tasks not yet viewed
			if($new == '1' && $createdBy != $userLoggedOn){
				echo'
				<tr class = "blue-row">
				<td></td>
				<td>
					<div id="view_task" class="btn-group">
						<form action="view_task.php" id="job-list" method="post" name="job-list">
								<input type="hidden" name="activityid" id="activityid" value="'.$activityid.'">
								<input id = view_task class="btn btn-default" data-toggle="tooltip" title="View as a List" type="submit" value=" View ">
						</form>
						
					<!--<a "href="add_contact.php?url='.$url.'" class="btn btn-default" data-toggle="tooltip" title="View as a List" ><i class="fa fa-plus"></i> <strong> View </strong></a>-->
					</div>
				</td>
				<td>'.$description.'</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				</tr>';
			}else{
				
			
					
					echo'
					<tr class = '.$highlight.'>';
						
							if($outbox == false){
								if($status != 'completed' && $status != 'globalcomplete'){
									if($results['type'] == 'prospecting'){
										echo'<td id= "complete-button"><a href="prospecting_results.php?url='.$url.'&activityid='.$activityid.'&customerid='.$customerid.'&companyid='.$companyid.'&userName = '.$userName.'&projectid='.$projectid.'"><i class="fa fa-square-o"></i></a></td>';
									}elseif ($type == 'create job number'){
										echo'<td id= "complete-button"><a href="../profile/add_job.php?url='.$url.'&activityid='.$activityid.'&customerid='.$customerid.'&companyid='.$companyid.'&projectid='.$projectid.'"><i class="fa fa-square-o"></i></a></td>';
									}else{
										echo'<td id= "complete-button"><a href="activity_results.php?url='.$url.'&activityid='.$activityid.'&customerid='.$customerid.'&companyid='.$companyid.'&userName = '.$userName.'&projectid='.$projectid.'" ><i class="fa fa-square-o"></i></a></td>';
									}
								}else{
									echo'<td id= "complete-button"><a href="incomplete.php?url='.$url.'&activityid='.$activityid.'" ><i class="fa fa-check-square-o"></i></a></td>';
								}
							}
					
						
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
							elseif ($results['type'] == 'order parts'){
								$icon = '<i class="fa fa-file-powerpoint-o"></i>';
							}
							elseif ($results['type'] == 'get PO number'){
								$icon = '<i class="fa fa-file-o"></i>';
							}
							elseif ($results['type'] == 'create job number'){
								$icon = '<i class="fa fa-file-text"></i>';
							}
							else {
								$icon = '<i class="fa fa-question"></i>';
							}
						
						
										
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
								<!--'.$icon.' '.'-->
								<td>'.$icon.' <button type="submit" id="job-type" > '.ucwords($results['type']).'</button></td>
							</form>';
						echo'
						
						<td>
								'.$results['description'].'
						</td>
						<td>';
								$originalDate = $results['due_date'];
								$originalDate = date("d/m/Y", strtotime($originalDate));
								
								$completeDate = date("d/m/Y", strtotime($completeDate));
								if($status == 'completed' || $status == 'globalcomplete'){
									echo $completeDate;
								}else{
									echo $originalDate;
								}
								$creationDate = $results['creation_date'];
								$creationDate = date("d/m/Y", strtotime($creationDate));
						echo'
						</td>';
							// this may change to make last days show in red
							$class = '';
							$message ='';
							if($status == 'completed' || ($status == 'globalcomplete' && $admin ==true)){
							//THIS IS WHERE I IMPLEMENT THE Punctuality FEATURE
								$doneDate = strtotime($results['complete_date']);
								$dueDate = strtotime($results['due_date']);
								$difference = $doneDate - $dueDate;
								$days = floor($difference / (60*60*24) );
								if($days < 0){
									$days = $days * -1;
									$word = 'day';
									//to be grammatically correct
									if($days > 1){
										$word = 'days';
									}
									$message = $days.' '.$word.' early';
									
								}elseif($days == 0){
									$message = 'On time';
								}else{
									$word = 'day';
									//to be grammatically correct
									if($days > 1){
										$word = 'days';
									}
									$message = $days.' '.$word.' late';
									$class = 'red';
								}
						echo'
						<td class = '.$class.'>';
						echo $message;
							}else{
								echo '<td>';
									$openDate = $results['creation_date'];
									$openDate = strtotime($openDate);
									
									$closeDate = strtotime($results['complete_date']);
										if($results['complete'] == 0){
										//works out days open 
										
											//get the current date 
											$dt = new DateTime();
											$installdate = $dt->format('Y-m-d');
											
											
											//convert it to a timestamp
											
											//Get the current timestamp.
											$now = time();
											
											//Calculate the difference.
											$difference = $now - $openDate;
											
											
											
										}else{
											
											$difference = $closeDate - $openDate;
										}
										$days = floor($difference / (60*60*24) );
										echo $days;
							}
						echo'
						</td>
						<td>';
								if($heading == 'Result'){
									//this is where i need to make the result of a create job number a hyerlink
									if($type == 'create job number'){
										echo '<a href="../profile/profile.php?customerid='.$customerid.'&companyid='.$companyid.'&page=history" class="name">'.ucwords($result).'</a>';
									}else{
										echo ucwords($result);
									}
								}else{
									echo date('h:ia', strtotime($results['time']));
								}
						echo'
						</td>';

							
							//put in the link to the project details here
							if($project == false){
								echo'<td>';
								echo '<a href = "../profile/profile.php?customerid='.$customerid.'&companyid='.$companyid.'&page=task" class="name">';
								
									if($customerid >= 1){
										echo ucwords($row['first_name']).' '.ucwords($row['last_name']);
									}else{
										echo ucwords($row['name']);
									}
							
								echo'
								</a></td>';
								if($status != 'global' && $status != 'globalcomplete' ){
									echo'<td>';
									
									if(isset ($address_line4)){
										if($address_line4 != ''){
											echo ucwords($address_line4);
										}elseif ($address_line3 != ''){
											echo ucwords($address_line3);
										}else{
											echo ucwords($address_line2);
										}
										echo '</td>
										<td>'.ucwords($row['county']).'</td>';
										
										//if it is for a project
									}else{
										echo $city;
									}
								}
								
							}elseif($project == true){
								echo'<td>';
								echo '<a href = "../projects/project_profile.php?projectid='.$projectid.'&page=taskhistory" class="name">
								Project: '.$planningNumber.'
								</a></td>';
								if($status != 'global' && $status != 'globalcomplete' ){
									echo'
									<td>'.$city.
									'</td>';
								}
							}
							if($project == true){
								echo '<td>'.$county.'</td>';
							}
						
							
							if($outbox == false &&($global ==true)&& ($project == false)){
								echo '<td>'.$county.'</td>';
							}
							echo '<td>'.$creationDate.'</td>';
							//the employee it is assigned to
							if($outbox == true || $global == true){
									echo'<td>'.ucwords($employee).'</td>';
							}
					echo'
					<td>'.ucwords($results['created_by']).'</td>
					</tr>';
			}
		}
		mysqli_close($con);
	?>
		</tbody>
	</table>
</body>
</html>