<link rel="stylesheet" href="../__jquery.tablesorter/themes/blue/style_table.css">
<?php

 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

//this is for deciding to show ongoing or closed projects
if(isset($_GET['type'])){
	if($type == 'ongoing'){
		$sql = "SELECT * FROM projects WHERE closed = '0' ORDER BY projectid DESC; ";
	}else{
		$sql = "SELECT * FROM projects WHERE closed = '1'; ";
	}
}else{
		$sql = "SELECT * FROM projects WHERE closed = '0' ORDER BY projectid DESC;; ";
}

$res = mysqli_query($con,$sql);

$result = array();


while($row = mysqli_fetch_array($res)){
	array_push($result,
		array('projectid'=>$row[0],
		'planning_number'=>$row[1],
		'est_start_date'=>$row[2],
		'address1'=>$row[3],
		'address2'=>$row[4],
		'address3'=>$row[5],
		'address4'=>$row[6],
		'county'=>$row[7],
		'country'=>$row[8],
		'regarding'=>$row[9],
		'notes'=>$row[10],
		'closed'=>$row[11],
		'removed'=>$row[12],
		'won'=>$row[13],
		'creation_date'=>$row[14]
	));
}
//print_r (array_values($result));

//Puts all the customer names in a table
//echo '<section class="panel-body">'; this is where i type 

?>	 

	
<!-- ... -->
</tbody> 
    </table> 
	
	<table id="table1" cellspacing="0" class="tablesorter mytable filterable">
		<thead>
			<tr class = "blue-row">				
				<!--<th class = "asset-list"></th>-->
				<td id = "td-header" class = "asset-list"><i class="fa fa-check"></i></td>
				<th id = "first-table-column" class = "asset-list"><strong>Planning Number</strong></th>
				<th><strong>Details</strong></th>
				<th><strong>Stage<strong></th>
				<th><strong>Start Date</strong></th>
				<th><strong>Days Open</strong></th>
				<th><strong>Location</strong></th>
				<!--<th><strong>Contact</strong></th>-->
				<th><strong>Assigned to</strong></th>
				<th><strong>Last Contacted</strong></th>
			</tr>
		</thead>
		
		<tbody>
	<?php
	$i=1;
		foreach ($result as $results){
			$projectid = $results['projectid'];
			$closed = $results['closed'];
			$sql2 = "SELECT * FROM activity WHERE activityid IN(SELECT activityid FROM project_activity WHERE projectid = '$projectid');";
			//echo $sql2;
			$res2 = mysqli_query($con,$sql2);
			$activity = array();


			while($row = mysqli_fetch_array($res2)){
				array_push($activity,
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
					
					//this is to look for over due tasks in the projects
					$rowClass = '';
					foreach($activity as $a){
						$complete = $a['complete'];
						$dueDate = $a['due_date'];
						$currentDate = date("Y-m-d");
						
						if($complete == 0 && ($currentDate > $dueDate)){
							
							$rowClass = "red-row";
						}
					}
			
			
			/*if (1 != $i % 2){
				$rowClass = 'bltttttue-row';
			}else{
				$rowClass = 'whittttte-row';
			}*/
			 
			/*this makes the contact a link to the contacts profile
			$sql2 = "SELECT companyid, name FROM company WHERE companyid IN (SELECT companyid FROM company_to_project WHERE projectid = '$projectid');" ;
			$res2 = mysqli_query($con,$sql2);
			$row = mysqli_fetch_assoc($res2);*/
			
			
			$sql3 = "SELECT userid, first_name, last_name FROM users WHERE userid IN (SELECT userid FROM managed_by WHERE projectid = '$projectid');" ;
			$res3 = mysqli_query($con,$sql3);
			$row3 = mysqli_fetch_assoc($res3);
			$userName = $row3['userid'];
			
			//this is the variable to store the value which indicates whether a project is closed or not
			$closed = $results['closed'];
			
			
	?>
			<tr class = "<?php echo $rowClass;?>">	
			<?php
					if($closed != '1'){
							echo'<td id= "complete-button"><a href="close_project.php?url='.$url.'&projectid='.$projectid.'"><i class="fa fa-square-o"></i></a></td>';
					}else{
						echo'<td id= "complete-button"><a href="reopen_project.php?url='.$url.'&projectid='.$projectid.'"><i class="fa fa-check-square-o"></i></a></td>';
					}
					?>
				
				<?php
					//this is where i will put the check box to mark the project done
					/*if($closed == 0){
							echo'<td id= "complete-button"><i class="fa fa-square-o"></i></a></td>';
					}else{
						echo'<td id= "complete-button"><i class="fa fa-check-square-o"></i></a></td>';
					}*/
				?>
				
			
				<td>
				<?php			
					$planningNumber = $results['planning_number'];
					$startDate = $results['est_start_date'];
					$address1 = $results['address1'];
					$address2 = $results['address2'];
					$address3 = $results['address3'];
					$address4 = $results['address4'];
					$county = $results['county'];
					$country = $results['country'];
					$regarding = $results['regarding'];
					$notes = $results['notes'];
					echo'
					<form action="project_profile.php" id="job-lis" method="post" name="job-lis">
						<input type="hidden" name="url" id="url" value="projects.php">
						<input type="hidden" name="userName" id="userName" value="'.$userName.'">
						<input type="hidden" name="projectid" id="projectid" value="'.$projectid.'">
						
						<input type="hidden" name="planningNumber" id="planningNumber" value="'.$planningNumber.'">
						<input type="hidden" name="startDate" id="startDate" value="'.$startDate.'">
						
						<input type="hidden" name="address1" id="address1" value="'.$address1.'">
						
						<input type="hidden" name="address2" id="address2" value="'.$address2.'">
						<input type="hidden" name="address3" id="address3" value="'.$address3.'">
						
						<input type="hidden" name="address4" id="address4" value="'.$address4.'">
						<input type="hidden" name="county" id="county" value="'.$county.'">
						
						<input type="hidden" name="country" id="country" value="'.$country.'">
						<input type="hidden" name="regarding" id="regarding" value="'.$regarding.'">
						<input type="hidden" name="notes" id="notes" value="'.$notes.'">
						<input type="submit" id="job-type" value="'.ucwords($results['planning_number']).'">
					</form>';
				?>
				<!--<a href = "#" class="name"><?php //echo ucwords($results['name']);?></a>-->
				</td>
				<td>
					<?php echo $results['regarding']; ?>
				</td>
				<!-- put the project stage here -->
				<td>
					<?php
						$typeQuery = "SELECT type FROM activity WHERE activityid IN (SELECT activityid FROM project_activity where projectid = '$projectid') ORDER BY activityid DESC LIMIT 1; ";
						$resQuery = mysqli_query($con,$typeQuery);
						if (mysqli_num_rows($resQuery) > 0) {
							$rowType = mysqli_fetch_assoc($resQuery);
							$type = ucwords($rowType["type"]);
							
							echo
							$type;
							
						}else{
							echo '';
						}
					?>
				</td>
				<td>
					<?php echo date("d/m/Y", strtotime($results['est_start_date'])); ?>
				</td>
				<?php
					$ad1 = ucwords($results['address1']);
					$ad2 = ucwords($results['address2']);
					$ad3 = ucwords($results['address3']);
					$ad4 = ucwords($results['address4']);
					$county = ucwords($results['county']);
					$country = ucwords($results['country']);
					$city=0; 
				?>
				<td>
				<?php
					//works out days open 
					
						//get the current date 
						$dt = new DateTime();
						$installdate = $dt->format('Y-m-d');
						$openDate = $results['creation_date'];
						
						//convert it to a timestamp
						$openDate = strtotime($openDate);
						//Get the current timestamp.
						$now = time();
						
						//Calculate the difference.
						$difference = $now - $openDate;
						
						$days = floor($difference / (60*60*24) );
						echo $days;
				?>
				</td>
				<td>
				<?php
						if(!empty($ad1)){ 
							echo $ad1;
							//echo nl2br("\n");
						}
						
						if(!empty($ad2) && $ad2 != $ad1){
							if(!empty($ad3)&& $ad3 != $ad2 && $ad3 != $ad1){
								if(!empty($ad1)){
									echo', ';
								}
								echo $ad2;
							}elseif(!empty($ad4)&& $ad4 != $ad3 && $ad4 != $ad2 && $ad4 != $ad1){
								if(!empty($ad1)){
									echo', ';
								}
								echo $ad2;
							}else{
								$city = $ad2;
							}
						}
						if($city < 1){
							if(!empty($ad3)&& $ad3 != $ad2 && $ad3 != $ad1){ 
								if(!empty($ad4)&& $ad4 != $ad3 && $ad4 != $ad2 && $ad4 != $ad1){
									if(!empty($ad1) || !empty($ad2)){
										echo', ';
									}
									echo $ad3;
								}else{
									$city = $ad3;
								}
							}
							if($city < 1){
								if(!empty($ad4)&& $ad4 != $ad3 && $ad4 != $ad2 && $ad4 != $ad1){ 
									$city = $ad4;
								}
							}	
								
						}
						if($city === 0){
							$city = '';
						}
						echo ', '.$city;
						echo ', '.ucwords($results['county']);
						echo ', '.ucwords($results['country']);
				?>
				</td>
				<?php 
					/*/this makes the contact a link to the contacts profile
					$sql2 = "SELECT companyid, name FROM company WHERE companyid IN (SELECT companyid FROM company_to_project WHERE projectid = '$projectid');" ;
					$res2 = mysqli_query($con,$sql2);
					$row = mysqli_fetch_assoc($res2);
					echo '<td><a href = "profile.php?companyid='.$row['companyid'].'" class="name">';
					echo ucwords($row['name']);
					echo '</a></td>';
					
					$sql3 = "SELECT first_name, last_name FROM users WHERE userid IN (SELECT userid FROM managed_by WHERE projectid = '$projectid');" ;
					$res3 = mysqli_query($con,$sql3);
					$row3 = mysqli_fetch_assoc($res3);*/
					
					//this is for getting the "last contacted" date for the project
					$sql4 = "SELECT complete_date FROM activity WHERE activityid IN (SELECT activityid FROM project_activity WHERE projectid = '$projectid') ORDER BY complete_date DESC;" ;
					
					$res4 = mysqli_query($con,$sql4);
					$row4 = mysqli_fetch_assoc($res4);
					$lastContacted = $row4['complete_date'];

				?>
				
				<td><?php echo ucwords($row3['first_name']).' '. ucwords($row3['last_name']); ?></td>
				
				<td>
					<?php
					//this displays the last contacted date 
						if($lastContacted != ""){
							echo date("d/m/Y", strtotime($lastContacted)); 
						}else{
							echo "Not Contacted";
						}
					?>
				</td>
				
			</tr>
	<?php
			$i++;
		}
	?>
		</tbody>
	</table>