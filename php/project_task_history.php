<?php
$sql = "SELECT * FROM activity WHERE activityid IN (SELECT activityid FROM project_activity WHERE projectid = '$projectid') ORDER BY due_date;" ;
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
	foreach ($result as $r){
		$complete = $r['complete'];
		if($complete == 0){
			$incompleteCounter ++;
		}elseif($complete == 1){
			$completeCounter ++;
		}
	}
	

 echo'
			</hgroup>
			</header>
			<section class="panel-body" style = "width:100%">';
			if($incompleteCounter > 0){
				echo'
				<table align="center">
					<thead>
						<tr><strong>TO DO</strong></tr>
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

			

	$i = 1;	
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
	
	 if($results['complete'] == 1){
		$completed = '<i class="fa fa-check-square-o"></i>';
	 }else{
		$completed = '<i class="fa fa-square-o"></i></i>';
	 }				 
		if (1 != $i % 2){
			$rowClass = 'blue-row';
		}else{
			$rowClass = 'white-row';
		} 

			//formating the date correctly
			$originalDate = $results['due_date'];
			$newDate = date("d/m/Y", strtotime($originalDate));
			
			//choosing the icon for the tasks
			if ($results['type'] == 'prospecting'){
						$icon = '<i class="fa fa-binoculars"> </i>';
					}
					if ($results['type'] == 'qualifying'){
						$icon = '<i class="fa fa-spinner"></i>';
					}
					if ($results['type'] == 'presentation'){
						$icon = '<i class="fa fa-bar-chart"></i>';
					}
					if ($results['type'] == 'quotation'){
						$icon = '<i class="fa fa-tag"></i>';
					}
					if ($results['type'] == 'closing meeting'){
						$icon = '<i class="fa fa-lock"></i>';
						echo ' ';
					}
					if ($results['type'] == 'followup meeting'){
						$icon = '<i class="fa fa-coffee"></i>';
					}
					if ($results['type'] == 'other'){
						$icon = '<i class="fa fa-question"></i>';
					}
					if ($results['type'] == 'create job number'){
						$icon = '<i class="fa fa-file-text"></i>';
					}
		if($complete == 0 ){
			echo '<tr class = "' .$rowClass. '">
						<td class = "asset-list"></td>
						<td class = "asset-list">'.$completed.'</td>
						<td class = "asset-list">
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
							
						</form></td>
						<td class = "asset-list">'.$results['description'].'</td>
						<td class = "asset-list">'.$newDate.'</td>
						<td class = "asset-list">'.date('h:ia', strtotime($results['time'])).'</td>
						<td class = "asset-list">'.$employee.'</td>
				</tr>';
				$i++;

		}
		
		if($completeCounter > 0){
			echo'
				<table align="center">
					<thead>
						<tr><strong>TO DO</strong></tr>
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
			
			
	}
		echo '</table>';
		
	
?>