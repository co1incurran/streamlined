<?php


$sql = "SELECT * FROM activity WHERE complete = '0' AND activityid IN (SELECT activityid FROM project_activity WHERE projectid = '$projectid') ORDER BY activityid DESC;" ;
//echo $sql;
$res8 = mysqli_query($con,$sql);
//$row = mysqli_fetch_assoc($res);
$result = array();

while($row2 = mysqli_fetch_array($res8)){
	array_push($result,
		array('activityid'=>$row2[0],
		'complete'=>$row2[1],
		'type'=>$row2[2],
		'prospecting_type'=>$row2[3],
		'description'=>$row2[4],
		'due_date'=>$row2[5],
		'time'=>$row2[6],
		'result'=>$row2[7],
		'result_description'=>$row2[8],
		'next_action'=>$row2[9],
		'next_action_description'=>$row2[10],
		'creation_date'=>$row2[11]
	));
}
//print_r (array_values($result));

	$url = $_SERVER['REQUEST_URI'];
	//$url = str_replace('&', '%26', $url);
	//echo $url;

$heading = 'Time';

$incompleteCounter  = 0;
$completeCounter = 0;
$y = 0;
	foreach ($result as $r){
		$complete = $r['complete'];
		if($complete == 0){
			$incompleteCounter ++;
		}elseif($complete == 1){
			$completeCounter ++;
		}
	}
	
	//making the header for the incomplete tasks
	while ($y < 1){
		//echo $y;
			if($incompleteCounter > 0){
				echo'
				</hgroup>
				</header>
				<section class="panel-body" style = "width:100%">
					<table align="center">
						<thead>
							<tr class = "blue-row">
								<td></td>
								<td id = "td-header" class = "asset-list"><i class="fa fa-check"></i></td>
								<th id = "first-table-column" class = "asset-list"><strong>Type</strong></th>
								<th class = "asset-list"><strong>Description</strong></th>
								<th class = "asset-list"><strong>Date</strong></th>
								<th class = "asset-list"><strong>Time</strong></th>
								<th class = "asset-list"><strong>Assigned to</strong></th>
							</tr>
						</thead>';
			
				
			}

		$y ++;
	}
	//$i = 1;	
foreach ($result as $results){
	
		//creating variavles of the activity info
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
	

		$sql2 = "SELECT userid, first_name, last_name FROM users WHERE userid IN (SELECT userid FROM assigned_activity WHERE activityid = '$activityid');";
		$res2 = mysqli_query($con,$sql2);
		$row2 = mysqli_fetch_assoc($res2);
		$userName = $row2['userid'];
		$employee = ucwords($row2['first_name'].' '.$row2['last_name']);
		
		//this is for displaying an unchecked or a checked checkbox 
		 if($results['complete'] == 1){
			$completed = '<i class="fa fa-check-square-o"></i>';
		 }else{
			$completed = '<i class="fa fa-square-o"></i></i>';
		 }	

		//this alternates the row colours
		/*if (1 != $i % 2){
			$rowClass = 'white-row';//'blue-row';
		}else{
			$rowClass = 'white-row';
		} */
			$rowClass = 'white-row';
		
			//formating the date correctly
			$originalDate = $results['due_date'];
			$newDate = date("d/m/Y", strtotime($originalDate));
			
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
							

			echo '<tr class = "' .$rowClass. '">
						
						<td class = "asset-list">';
									if($results['type'] == 'prospecting'){
										echo'<td id= "complete-button"><a href="../task/prospecting_results.php?url='.$url.'&activityid='.$activityid.'&projectid='.$projectid.'&userName = '.$userName.'"><i class="fa fa-square-o"></i></a></td>';
									}elseif ($type == 'create job number'){
										echo'<td id= "complete-button"><a href="../profile/add_job.php?url='.$url.'&activityid='.$activityid.'&projectid='.$projectid.'&userName = '.$userName.'"><i class="fa fa-square-o"></i></a></td>';
									}else{
										echo'<td id= "complete-button"><a href="../task/activity_results.php?url='.$url.'&activityid='.$activityid.'&projectid='.$projectid.'&userName = '.$userName.'"><i class="fa fa-square-o"></i></a></td>';
									} 
						echo			
						'</td>
						<td class = "asset-list">
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
							
							'.$icon.' '.'<input type="submit" id="job-type" value="'.ucwords($results['type']).'">
							
						</form></td>
						<td class = "asset-list">'.$results['description'].'</td>
						<td class = "asset-list">'.$newDate.'</td>
						<td class = "asset-list">'.date('h:ia', strtotime($results['time'])).'</td>
						<td class = "asset-list">'.$employee.'</td>
				</tr>';
				//$i++;

		}

		echo '</table>';
?>