<?php
$sql = "SELECT * FROM activity WHERE activityid IN (SELECT activityid FROM project_activity WHERE projectid = '$projectid');" ;
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
$heading = 'Time';
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
							<th class = "asset-list"><strong>'.$heading.'</strong></th>
							<th class = "asset-list"><strong>Assigned to</strong></th>
						</tr>
					</thead>';
	$i = 1;
foreach ($result as $results){
	//getting the person the task was assigned to
	$activityid = $results['activityid'];
	$sql2 =
	 if($results['complete'] == 1){
		$complete = '<i class="fa fa-check-square-o"></i>';
	 }else{
		$complete = '<i class="fa fa-square-o"></i></i>';
	 }				 
		if (1 != $i % 2){
			$rowClass = 'blue-row';
		}else{
			$rowClass = 'white-row';
		} 

		//<td class = "asset-list"><a id="edit" href="edit_company_contact.php?url='.$url.'&worker_number='.$results2['workerid'].'&firstname='
					//.$results2['first_name'].'&lastname='.$results2['last_name'].'&email='.$results2['email'].'&phonenumber='.$results2['phone_num'].'&mobilenumber='.$results2['mobile_phone_num'].'&fax='.$results2['fax'].'&jobtitle='.$results2['job_title'].'&lastcontacted='.$results2['last_contacted'].'"><i class="fa fa-gear"></i></a></td>
		echo '<tr class = "' .$rowClass. '">
					<td class = "asset-list"></td>
					<td class = "asset-list">'.$complete.'</td>
					<td class = "asset-list">'.ucwords($results['type']).'</td>
					<td class = "asset-list">'.$results['description'].'</td>
					<td class = "asset-list">'.$results['due_date'].'</td>
					<td class = "asset-list">'.$results['time'].'</td>
					<td class = "asset-list">------</td>
			</tr>';
			
			$i++;
	}
		echo '</table>';
		
	
?>