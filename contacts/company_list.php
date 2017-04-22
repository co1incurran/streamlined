<link rel="stylesheet" href="../__jquery.tablesorter/themes/blue/style_table.css">
<?php

 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$sql = "SELECT * FROM company WHERE lead != 1 AND project != 1 ORDER BY name; ";
 
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
		'last_contacted'=>$row[14]
	));
}
//print_r (array_values($result));listing list-view clearfix

//Puts all the customer names in a table
//echo '<section class="panel-body">';
?>	 

	
<!-- ... -->
</tbody> 
    </table> 
	
	<table id="companyNames" class="tablesorter filterable">
		<thead>
			<tr class = "blue-row">				
				<!--<th class = "asset-list"></th>-->
				<th id = "first-table-column" class = "asset-list"><strong>Company</strong></th>
				<th><strong>Address</strong></th>
				<th><strong>City</strong></th>
				<th><strong>County</strong></th>
				<th><strong>Phone Number</strong></th>
				<th><strong>Last Contacted</strong></th>
				<th><strong>Sector </strong></th>
				<th><strong>Assets </strong></th>			
			</tr>
		</thead>
		
		<tbody>
	<?php
	$i=1;
		foreach ($result as $results){
			$companyid = $results['companyid'];
			
			//To get the number of assets
			$sql2 = "SELECT stockid FROM `stock` WHERE stockid IN (SELECT stockid FROM uses WHERE jobid IN 
			(SELECT jobid FROM jobs WHERE jobid IN (SELECT jobid FROM company_requires WHERE companyid = '$companyid'))); ";
			$res2 = mysqli_query($con,$sql2);
			$result2 = array();
			$assetCount = 0;
			while($row = mysqli_fetch_array($res2)){
				array_push($result2,
					array('stockid'=>$row[0]
				));
				$assetCount++;
			}
			
			if (1 != $i % 2){
				$rowClass = 'bltttttue-row';
			}else{
				$rowClass = 'whittttte-row';
			}
		
	?>
			<tr class = "<?php echo $rowClass;?>">	
				<td><a href = "../profile/profile.php?customerid=0&companyid=<?php echo $companyid;?> " class="name"><?php echo ucwords($results['name']);?></a></td>
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
					//for getting the number of a contact in the company (preferably a mobile number pf the most recently added worker)
					$sql3 = "SELECT mobile_phone_num FROM `workers` WHERE mobile_phone_num != '' AND workerid IN (SELECT workerid FROM works_with WHERE companyid = '$companyid') ORDER BY workerid DESC LIMIT 1; ";
					$res3 = mysqli_query($con,$sql3);
					if (mysqli_num_rows($res3) != 0) {
						$row3 = mysqli_fetch_assoc($res3);
						$number = $row3["mobile_phone_num"];
					}else{
						$sql4 = "SELECT phone_num FROM `workers` WHERE phone_num != '' AND workerid IN (SELECT workerid FROM works_with WHERE companyid = '$companyid') ORDER BY workerid DESC LIMIT 1; ";
						$res4 = mysqli_query($con,$sql4);
						if (mysqli_num_rows($res4) != 0) {
							$row3 = mysqli_fetch_assoc($res4);
							$number = $row3["phone_num"];
						}else{
							$number = '';
						}
					}
					
					//echo $sql3.'<br>';
					
					
					
					
					$lastContacted = $results['last_contacted'];
					if($lastContacted == NULL){
						$lastContacted = '2000-01-01';
					}
					$lastContacted = date("d/m/Y", strtotime($lastContacted));
				?>
				
				<td><?php echo $number; ?></td>
				<td><?php echo $lastContacted; ?></td>
				<td><?php echo ucwords($results['sector']); ?></td>
				<td><?php echo $assetCount ?></td>
			</tr>
	<?php
			$i++;
		}
		mysqli_close($con);
	?>
		</tbody>
	</table>