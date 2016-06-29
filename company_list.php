<link rel="stylesheet" href="__jquery.tablesorter/themes/blue/style_table.css">
<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$sql = "SELECT * FROM company WHERE lead != 1 ORDER BY name; ";
 
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
		'lead'=>$row[10]
	));
}
//print_r (array_values($result));listing list-view clearfix

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
				<th id = "first-table-column" class = "asset-list"><strong>Company</strong></th>
				<th><strong>Address</strong></th>
				<th><strong>City</strong></th>
				<th><strong>County</strong></th>
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
				<td><a href = "profile.php?customerid=0&companyid=<?php echo $companyid;?> " class="name"><?php echo ucwords($results['name']);?></a></td>
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
					//for getting the date of last contacted 
					$sql3 = "SELECT last_contacted FROM `workers` WHERE workerid IN (SELECT workerid FROM works_with WHERE companyid = '$companyid'); ";
					$res3 = mysqli_query($con,$sql3);
					$result3 = array();

					while($row = mysqli_fetch_array($res3)){
					array_push($result3,
					array('last_contacted'=>$row[0]
					));
					} 
					//print_r (array_values($result3));
					$mostRecent =0;
					foreach ($result3 as $results3){
						  $curDate= $results3['last_contacted'];
						  if ($curDate > $mostRecent) {
							 $mostRecent = $curDate;
							 //$ok = $mostRecent;
							 //echo 'in the if';
						  }
					}
					//$mostRecent = $results['last_contacted'];
					if($mostRecent != 0){
						$mostRecent = date("d/m/Y", strtotime($mostRecent));
					}else{
						$mostRecent = '';
					}
				?>
				
				<td><?php echo $mostRecent; ?></td>
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