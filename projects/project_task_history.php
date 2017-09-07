<?php	
//include'../include/session.php';
	
		//BELOW THIS IS FOR ACTIVITIES THAT HAVE BEEN COMPLETED
$sql2 = "SELECT * FROM activity WHERE complete = '1' AND activityid IN (SELECT activityid FROM project_activity WHERE projectid = '$projectid') ORDER BY complete_date DESC;" ;
//echo $sql2.'<br>';
$res9 = mysqli_query($con,$sql2);
//$row = mysqli_fetch_assoc($res);
$result = array();

$url = $_SERVER['REQUEST_URI'];

while($row2 = mysqli_fetch_array($res9)){
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
		'creation_date'=>$row2[11],
		'created_by' =>$row2[12],
		'new' =>$row2[13],
		'complete_date' =>$row2[14],
		'contacted'=>$row2[15],
		'project_ref_num'=>$row2[16],
		'met_with'=>$row2[17]
	));
}
//print_r (array_values($result)); 
	
	//making the table header for the completed tasks
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
								<th class = "asset-list"><strong>Due Date</strong></th>
								<th class = "asset-list"><strong>Complete Date</strong></th>
								<th class = "asset-list"><strong>Met With</strong></th>
								<th class = "asset-list"><strong>Punctuality</strong></th>
								<th class = "asset-list"><strong>Result</strong></th>
								<th class = "asset-list"><strong>Next Action</strong></th>
								<th class = "asset-list"><strong>Assigned to</strong></th>
							</tr>
						</thead>';
							

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
			
			$completeDate = $results['complete_date'];
			$completeDate = date("d/m/Y", strtotime($completeDate));
			$met_with = $results['met_with'];
	//echo $met_with.'<br>';

		$sql2 = "SELECT userid, first_name, last_name FROM users WHERE userid IN (SELECT userid FROM assigned_activity WHERE activityid = '$activityid');";
		$res2 = mysqli_query($con,$sql2);
		$row2 = mysqli_fetch_assoc($res2);
		$userName = $row2['userid'];
		$employee = ucwords($row2['first_name'].' '.$row2['last_name']);
		
		//this is for displaying a unchecked or a checked checkbox 
		 if($results['complete'] == 1){
			$completed = '<a href="../task/incomplete.php?url='.$url.'&activityid='.$activityid.'" ><i class="fa fa-check-square-o"></i></a>';
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
			
			//choosing the icon for the tasks
			if ($results['type'] == 'prospecting'){
				$icon = '<i class="fa fa-binoculars"> </i>';
			}elseif ($results['type'] == 'qualifying'){
				$icon = '<i class="fa fa-spinner"></i>';
			}
			elseif ($results['type'] == 'presentation'){
				$icon = '<i class="fa fa-bar-chart"></i>';
			}
			elseif ($results['type'] == 'deliver quote'){
				$icon = '<i class="fa fa-tag"></i>';
			}
			elseif ($results['type'] == 'generate quote'){
				$icon = '<i class="fa fa-print"></i>';
				echo ' ';
			}
			elseif ($results['type'] == 'closing meeting'){
				$icon = '<i class="fa fa-lock"></i>';
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
			}else{
				$icon = '<i class="fa fa-question"></i>';
			}

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
						<td class = "asset-list">'.$completeDate.'</td>
						<td class = "asset-list">'.$met_with.'</td>';
						//THIS IS WHERE I IMPLEMENT THE Punctuality FEATURE
								$doneDate = strtotime($results['complete_date']);
								$dueDate = strtotime($results['due_date']);
								$difference = $doneDate - $dueDate;
								$days = floor($difference / (60*60*24) );
								$class = '';
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
						
						echo'<td class = "'.$class.'">'.$message.'</td>
						<td class = "asset-list">'.ucwords($result).'</td>
						<td class = "asset-list">'.ucwords($nextAction).'</td>
						<td class = "asset-list">'.$employee.'</td>
				</tr>';
				//$i++;
		}
		echo '</table>';
?>
