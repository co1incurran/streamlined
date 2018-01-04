<?php

 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

if(isset($_GET['companyid'])){
	$companyid = $_GET['companyid'];
	$companyid = mysqli_real_escape_string($con ,$companyid);
}

if(isset($_GET['customerid'])){
	$customerid = $_GET['customerid'];
	$customerid = mysqli_real_escape_string($con ,$customerid);
}
if((isset($_GET['companyid'])) && $companyid != 0){
	$sql = "SELECT * FROM activity WHERE complete ='0' AND activityid IN (SELECT activityid FROM company_activity WHERE companyid = '$companyid') ORDER BY activityid DESC; ";
	
	$sql2 = "SELECT * FROM company WHERE companyid ='$companyid' ; ";
	$res2 = mysqli_query($con,$sql2);
	$result2 = array();
	 
	while($row2 = mysqli_fetch_array($res2)){
	array_push($result2,
		array('companyid'=>$row2[0],
		'name'=>$row2[1],
		'address_line1'=>$row2[2],
		'address_line2'=>$row2[3],
		'address_line3'=>$row2[4],
		'address_line4'=>$row2[5],
		'county'=>$row2[6],
		'country'=>$row2[7],
		'sage_id'=>$row2[8],
		'sector'=>$row2[9]
	));
	}
	$set = false;
	//print_r (array_values($result2));
}else{
	$sql = "SELECT * FROM activity WHERE complete ='0' AND activityid IN (SELECT activityid FROM customer_activity WHERE customerid = '$customerid') ORDER BY activityid DESC; ";
	
	$sql2 = "SELECT * FROM customer WHERE customerid ='$customerid' ; ";
	$res2 = mysqli_query($con,$sql2);
	$result2 = array();
	 
	while($row2 = mysqli_fetch_array($res2)){
	array_push($result2,
		array('customerid'=>$row2[0],
		'name_prefix'=>$row2[1],
		'first_name'=>$row2[2],
		'last_name'=>$row2[3],
		'phone_num'=>$row2[4],
		'mobile_phone_num'=>$row2[5],
		'email'=>$row2[6],
		'fax'=>$row2[7],
		'address_line1'=>$row2[8],
		'address_line2'=>$row2[9],
		'address_line3'=>$row2[10],
		'address_line4'=>$row2[11],
		'county'=>$row2[12],
		'country'=>$row2[13]
	));
	}
	$set = true;
}
//echo $sql;
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
		'complete_date'=>$row[14],
		'contacted'=>$row[15],
		'project_ref_num'=>$row[16],
		'met_with'=>$row[17]
		
		
	));
}
//print_r (array_values($result));
 //echo '<br>';

 


$url = $_SERVER['REQUEST_URI'];
$url = str_replace('&', '%26', $url);
foreach($result2 as $results2){
	echo '<div class="main-section">
				
					<div class="container-fluid no-padding">
						<div class="col-md-7 no-padding">
							<div class="main-content panel panel-default no-margin">
								<header class="panel-heading clearfix">

									 <span class="avatar"></span>
									 <hgroup>';
									 if($set == true){
										 echo '<h2>'. ucwords($results2['first_name']).' '.ucwords($results2['last_name']).'<a id="add_contact" href = "add_activity.php?url='.$url.'&customerid='.$customerid.'&companyid='.$companyid.'" class="btn btn-default profile_button" data-toggle="tooltip" title="View as a List"><i class="fa fa-plus"></i><strong> Add Task </strong></a><br></h2>';
									 }else{
										 echo '<h2>'. ucwords($results2['name']).'<a id="edit" href="edit_company_details.php?url='.$url.'&companyid='.$companyid.'&name='.$results2['name'].'&address_line1='.$results2['address_line1'].'&address_line2='.$results2['address_line2'].'&address_line3='.$results2['address_line3'].'&address_line4='.$results2['address_line4'].'&county='.$results2['county'].'&country='.$results2['country'].'&sage_id='.$results2['sage_id'].'&sector='.$results2['sector'].'"><i class="fa fa-gear"></i></a><a id="add_contact" href = "add_activity.php?url='.$url.'&customerid='.$customerid.'&companyid='.$companyid.'" class="btn btn-default profile_button" data-toggle="tooltip" title="View as a List"><i class="fa fa-plus"></i><strong> Add Task </strong></a><br></h2>';
									 }
												
												$ad1 = ucwords($results2['address_line1']);
												$ad2 = ucwords($results2['address_line2']);
												$ad3 = ucwords($results2['address_line3']);
												$ad4 = ucwords($results2['address_line4']);
												$county = ucwords($results2['county']);
												$country = ucwords($results2['country']);
												if(!empty($ad1)){ 
													echo $ad1.', ';
													//echo nl2br("\n");
												}
												if(!empty($ad2) && $ad2 != $ad1){ 
													echo $ad2.', ';
													//echo nl2br("\n");
												}
												if(!empty($ad3)&& $ad3 != $ad2 && $ad3 != $ad1){ 
													echo $ad3.', ';
													//echo nl2br("\n");
												}
												if(!empty($ad4)&& $ad4 != $ad3 && $ad4 != $ad2 && $ad4 != $ad1){ 
													echo $ad4.', ';
													//echo nl2br("\n");
												}
												if(!empty($county)&& $county != $ad4 && $county != $ad3){ 
													echo $county.', ';
													//echo nl2br("\n");
												}
												if(!empty($country)){ 
													echo $country;
												}
											 echo '</h3>
								</hgroup>
								</header>
								<section class="panel-body" style = "width:100%">';
									echo'		 
									<table align="center">
										<thead class = "blue-row">
										<th class = "asset-list"></th>
										<th id = "td-header" class = "asset-list"><i class="fa fa-check"></i></th>
										<th class = "asset-list"><strong>Type</strong></th>
										<th class = "asset-list"><strong>Description</strong></th>
										<th class = "asset-list"><strong>Due Date</strong></th>
										<th class = "asset-list"><strong>Days open</strong></th>
										<th class = "asset-list"><strong>Time</strong></th>
										<th class = "asset-list"><strong>Creation Date</strong></th>
										<th class = "asset-list"><strong>Assigned to</strong></th>
										<th class = "asset-list"><strong>Created by</strong></th>
										</thead>';
										$i = 1;
						foreach ($result as $results){
							
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
							
			
			
							$activityid = $results['activityid'];
							$sql3 = "SELECT userid FROM assigned_activity WHERE activityid = '$activityid'; ";
							//echo $sql3;
							//echo $sql2.'<br>';
							$res3 = mysqli_query($con,$sql3);
							$row3 = mysqli_fetch_assoc($res3);
							$userName = $row3["userid"];
							
							if (1 != $i % 2){
								$rowClass = 'blue-row';
							}else{
								$rowClass = 'white-row';
							} 
							$complete = $results['complete'];
							$activityid = $results['activityid'];
							//echo $activityid.'<br>';
							echo '<tr class = "' .$rowClass. '">
										<td class = "asset-list"></td>';
										$type = $results['type'];
										if($type == 'prospecting'){
											echo'<td id= "complete-button"><a href="../task/prospecting_results.php?url='.$url.'&activityid='.$activityid.'&customerid='.$customerid.'&companyid='.$companyid.'&userName = '.$userName.'"><i class="fa fa-square-o"></i></a></td>';
										}elseif ($type == 'create job number'){
											echo'<td id= "complete-button"><a href="../profile/add_job.php?url='.$url.'&activityid='.$activityid.'&customerid='.$customerid.'&companyid='.$companyid.'"><i class="fa fa-square-o"></i></a></td>';
										}else{
											echo'<td id= "complete-button"><a href="../task/activity_results.php?url='.$url.'&activityid='.$activityid.'&customerid='.$customerid.'&companyid='.$companyid.'&userName = '.$userName.'" ><i class="fa fa-square-o"></i></a></td>';
										}
										
										echo'
						
											<form action="../task/task_details.php" id="job-list" method="post" name="job-list">
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
											</form>
											
										<td class = "asset-list">'. ucwords($results['description']) . '</td>';
										$dueDate = $results['due_date'];
										$dueDate = date("d/m/Y", strtotime($dueDate));
										
										echo '<td class = "asset-list">'. ($dueDate) . '</td>
										<td>';
										$openDate = $results['creation_date'];
										$openDate = strtotime($openDate);
										
										//get the current date 
										$dt = new DateTime();
										$installdate = $dt->format('Y-m-d');
										
										
										//convert it to a timestamp
										
										//Get the current timestamp.
										$now = time();
										
										//Calculate the difference.
										$difference = $now - $openDate;
											$days = floor($difference / (60*60*24) );
											echo $days;
								
										echo'
										</td>
										<td class = "asset-list">'.date('h:ia', strtotime($results['time'])). '</td>
										<td>'.date("d/m/Y", strtotime($results['creation_date'])).'</td>';
										
										$sql_project_ref = "SELECT planning_number FROM projects WHERE projectid IN (SELECT projectid FROM project_activity WHERE activityid = $activityid);";
										$res = mysqli_query($con,$sql_project_ref);
										if(mysqli_num_rows($res)>0){
											
											while($row = mysqli_fetch_array($res)) {
												echo '<td class = "asset-list">'.$row['planning_number'].'</td>';
											}
											
										}else{
										//to get the employee the task is assigned to
										$sql4 = "SELECT userid, first_name, last_name FROM users WHERE userid IN(SELECT userid FROM assigned_activity WHERE activityid = '$activityid');";
										$res4 = mysqli_query($con,$sql4);
										$user = mysqli_fetch_assoc($res4);
										$userName = $user['userid'];
										$employee = ucwords($user["first_name"]).' '.ucwords($user["last_name"]);
										//todo get the name of the person here
											echo '<td class = "asset-list">'.$employee.'</td>';
										}
										
										echo'
										<td class = "asset-list">'. ucwords($results['created_by']) . '</td>
								</tr>';
								$i++;
						}
							echo '</table>
							</section>
							</div>
						</div>';
			echo '</div>
			</div>';
}

mysqli_close($con);
?>