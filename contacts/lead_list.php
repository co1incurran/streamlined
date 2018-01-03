<link rel="stylesheet" href="../__jquery.tablesorter/themes/blue/style_table.css">
<?php

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$sql = "SELECT * FROM company WHERE lead = 1 AND hide != 1 ORDER BY name; ";
 
$res = mysqli_query($con,$sql);

$result = array();

while($row = mysqli_fetch_array($res)){
	array_push($result,
		array('companyid'=>$row[0],
		'name'=>$row[1],
		'address_line1'=>$row[2],
		'address_line2'=>$row[3],
		'address_line3'=>$row[4],
		'address_line4'=>$row[5],
		'county'=>$row[6],
		'country'=>$row[7],
		'sage_id'=>$row[8],
		'sector'=>$row[9],
		'lead'=>$row[10],
		'hide'=>$row[11],
		'project'=>$row[12],
		'projectid'=>$row[13],
		'last_contacted'=>$row[14],
		'creation_date'=>$row[15]
	));
}

$sql2 = "SELECT customerid, first_name, last_name, address_line1, address_line2, address_line3, address_line4, county, last_contacted FROM customer WHERE lead = 1 AND hide != 1 ORDER BY first_name; ";
 
$res2 = mysqli_query($con,$sql2);

$result2 = array();

while($row = mysqli_fetch_array($res2)){
	array_push($result2,
		array('customerid'=>$row[0],
		'first_name'=>$row[1],
		'last_name'=>$row[2],
		'address_line1'=>$row[3],
		'address_line2'=>$row[4],
		'address_line3'=>$row[5],
		'address_line4'=>$row[6],
		'county'=>$row[7],
		'last_contacted'=>$row[8]
	));
}
//print_r (array_values($result2));
//get the rest of the data for here
?>	 

<!-- ... -->
</tbody> 
    </table> 
	
	<table id="companyNames" class="tablesorter filterable">
		<thead>
			<tr class = "blue-row">				
				<!--<th class = "asset-list"></th>-->
				<th id = "first-table-column" class = "asset-list"><strong>Name</strong></th>
				<th><strong>Address</strong></th>
				<th><strong>City</strong></th>
				<th><strong>County</strong></th>
				<th><strong>Last Contacted</strong></th>
			</tr>
		</thead>
		
		<tbody>
	<?php
	$i=1;
		foreach ($result as $results){
			$companyid = $results['companyid'];
			
			if (1 != $i % 2){
				$rowClass = 'bltttttue-row';
			}else{
				$rowClass = 'whittttte-row';
			}
		
	?>
			<tr class = "<?php echo $rowClass;?>">	
				<td><a href = "../profile/profile.php?type=lead&customerid=0&companyid=<?php echo $companyid;?> " class="name"><?php echo ucwords($results['name']);?></a></td>
				<?php
					$ad1 = ucwords($results['address_line1']);
					$ad2 = ucwords($results['address_line2']);
					$ad3 = ucwords($results['address_line3']);
					$ad4 = ucwords($results['address_line4']);
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
				?>
				</td>
				<?php
						if($city === 0){
							$city = '';
						}
				?>
				<td><?php echo $city; ?></td>
				<td>
					<?php 
						if(!empty($county)){ 
							echo $county;
							//echo nl2br("\n");
						}
					?>
				</td>
				<?php
					
					$creationDate = $results['creation_date'];
					//echo $creationDate;
					//convert it to a timestamp
					$creationDate = strtotime($creationDate);
					
					//get the current timestamp
					$now = time();
					
					//Calculate the difference.
					$difference = $now - $creationDate;
					
					$days = floor($difference / (60*60*24) );
					
					
					//this calculates the last contacted date
					$lastContacted = $results['last_contacted'];
					if($lastContacted == NULL){
						$lastContacted = 'N/A';
					}else{
						$lastContacted = date("d/m/Y", strtotime($lastContacted));
					}
				?>
				
				
				<td><?php echo $lastContacted; ?></td>
			</tr>
	<?php
			$i++;
		}
	?>
	
	
	
	
	
	
	
	
	
	
	<?php
	$i=1;
		foreach ($result2 as $r){
			$customerid = $r['customerid'];
			
			if (1 != $i % 2){
				$rowClass = 'bltttttue-row';
			}else{
				$rowClass = 'whittttte-row';
			}
		
	?>
			<tr class = "<?php echo $rowClass;?>">	
				<td><a href = "../profile/profile.php?type=lead&companyid=0&customerid=<?php echo $customerid;?> " class="name"><?php echo ucwords($r['first_name'] .' '.$r['last_name']);?></a></td>
				<?php
					$ad1 = ucwords($r['address_line1']);
					$ad2 = ucwords($r['address_line2']);
					$ad3 = ucwords($r['address_line3']);
					$ad4 = ucwords($r['address_line4']);
					$county = ucwords($r['county']);

					//$country = ucwords($results['country']);
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
				?>
				</td>
				<?php
						if($city === 0){
							$city = '';
						}
				?>
				<td><?php echo $city; ?></td>
				<td>
					<?php 
						if(!empty($county)){ 
							echo $county;
							//echo nl2br("\n");
						}
					?>
				</td>
				<?php
					
					$creationDate = $results['creation_date'];
					//echo $creationDate;
					//convert it to a timestamp
					$creationDate = strtotime($creationDate);
					
					//get the current timestamp
					$now = time();
					
					//Calculate the difference.
					$difference = $now - $creationDate;
					
					$days = floor($difference / (60*60*24) );
					
					
					//this calculates the last contacted date
					$lastContacted = $results['last_contacted'];
					if($lastContacted == NULL){
						$lastContacted = 'N/A';
					}else{
						$lastContacted = date("d/m/Y", strtotime($lastContacted));
					}
				?>
				
			
				<td><?php echo $lastContacted; ?></td>
			</tr>
	<?php
			$i++;
		}
	?>
		</tbody>
	</table>