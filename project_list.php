<link rel="stylesheet" href="__jquery.tablesorter/themes/blue/style_table.css">
<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$sql = "SELECT * FROM projects; ";
 
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
		'closed'=>$row[11]
	));
}
//print_r (array_values($result));

//Puts all the customer names in a table
//echo '<section class="panel-body">';
?>	 

	
<!-- ... -->
</tbody> 
    </table> 
	
	<table id="companyNames" class="tablesorter">
		<thead>
			<tr class = "blue-row">				
				<!--<th class = "asset-list"></th>-->
				<td id = "td-header" class = "asset-list"><i class="fa fa-check"></i></td>
				<th id = "first-table-column" class = "asset-list"><strong>Planning Number</strong></th>
				<th><strong>Details</strong></th>
				<th><strong>Stage<strong></th>
				<th><strong>Start Date</strong></th>
				<th><strong>Location</strong></th>
				<th><strong>Contact</strong></th>
				<th><strong>Assigned to</strong></th>
			</tr>
		</thead>
		
		<tbody>
	<?php
	$i=1;
		foreach ($result as $results){
			$projectid = $results['projectid'];
			
			
			if (1 != $i % 2){
				$rowClass = 'bltttttue-row';
			}else{
				$rowClass = 'whittttte-row';
			}
			 
			//this makes the contact a link to the contacts profile
			$sql2 = "SELECT companyid, name FROM company WHERE companyid IN (SELECT companyid FROM company_to_project WHERE projectid = '$projectid');" ;
			$res2 = mysqli_query($con,$sql2);
			$row = mysqli_fetch_assoc($res2);
			
			
			$sql3 = "SELECT userid, first_name, last_name FROM users WHERE userid IN (SELECT userid FROM managed_by WHERE projectid = '$projectid');" ;
			$res3 = mysqli_query($con,$sql3);
			$row3 = mysqli_fetch_assoc($res3);
			$userName = $row3['userid'];
			
			//this is the variable to store the value which indicates whether a project is closed or not
			$closed = $results['closed'];
			
			
	?>
			<tr class = "<?php echo $rowClass;?>">	
				
				<?php
					//this is where i will put the check box to mark the project done
					if($closed == 0){
							echo'<td id= "complete-button"><i class="fa fa-square-o"></i></a></td>';
					}else{
						echo'<td id= "complete-button"><i class="fa fa-check-square-o"></i></a></td>';
					}
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
							$type = $rowType["type"];
							
							echo'
							<form action="tasks.php?status=project" id="job-list" method="post" name="job-list">
								<input type="hidden" name="userName" id="userName" value="'.$userName.'">
								<input type="hidden" name="projectid" id="projectid" value="'.$projectid.'">
								<input type="hidden" name="address1" id="address1" value="'.$address1.'">
								<input type="hidden" name="address2" id="address2" value="'.$address2.'">
								<input type="hidden" name="address3" id="address3" value="'.$address3.'">
								<input type="hidden" name="address4" id="address4" value="'.$address4.'">
								<input type="hidden" name="county" id="county" value="'.$county.'">
								<input type="hidden" name="country" id="country" value="'.$country.'">
								<input type="hidden" name="type" id="type" value="'.$type.'">
								<input type="submit" id="job-type" value="'.ucwords($type).'">
							</form>';
							
						}else{
							echo 'Not Started';
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
					//this makes the contact a link to the contacts profile
					$sql2 = "SELECT companyid, name FROM company WHERE companyid IN (SELECT companyid FROM company_to_project WHERE projectid = '$projectid');" ;
					$res2 = mysqli_query($con,$sql2);
					$row = mysqli_fetch_assoc($res2);
					echo '<td><a href = "profile.php?companyid='.$row['companyid'].'" class="name">';
					echo ucwords($row['name']);
					echo '</a></td>';
					
					$sql3 = "SELECT first_name, last_name FROM users WHERE userid IN (SELECT userid FROM managed_by WHERE projectid = '$projectid');" ;
					$res3 = mysqli_query($con,$sql3);
					$row3 = mysqli_fetch_assoc($res3);
				?>
				
				<td><?php echo ucwords($row3['first_name']).' '. ucwords($row3['last_name']); ?></td>
				
			</tr>
	<?php
			$i++;
		}
	?>
		</tbody>
	</table>