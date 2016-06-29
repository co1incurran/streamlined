<link rel="stylesheet" href="__jquery.tablesorter/themes/blue/style_table.css">
<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$sql = "SELECT * FROM projects ORDER BY name; ";
 
$res = mysqli_query($con,$sql);

$result = array();


 
while($row = mysqli_fetch_array($res)){
	array_push($result,
		array('projectid'=>$row[0],
		'name'=>$row[1],
		'planning_number'=>$row[2],
		'est_start_date'=>$row[3],
		'address1'=>$row[4],
		'address2'=>$row[5],
		'address3'=>$row[6],
		'address4'=>$row[7],
		'county'=>$row[8],
		'country'=>$row[9],
		'regarding'=>$row[10],
		'notes'=>$row[11],
		'closed'=>$row[12]
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
				<th id = "first-table-column" class = "asset-list"><strong>Name</strong></th>
				<th><strong>Details</strong></th>
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
		
	?>
			<tr class = "<?php echo $rowClass;?>">	
				<td><a href = "#" class="name"><?php echo ucwords($results['name']);?></a></td>
				<td>
					<?php echo $results['regarding']; ?>
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
				
				<td><?php echo 'X'; ?></td>
				<td><?php echo 'X'; ?></td>
				
			</tr>
	<?php
			$i++;
		}
	?>
		</tbody>
	</table>