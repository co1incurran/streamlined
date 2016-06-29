<link rel="stylesheet" href="__jquery.tablesorter/themes/blue/style_table.css">
<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$sql = "SELECT customerid, first_name, last_name, phone_num, mobile_phone_num, address_line1, address_line2, address_line3, address_line4, county, country, last_contacted, sage_id FROM customer WHERE lead != 1 AND hide != 1 ORDER BY first_name; ";
 
$res = mysqli_query($con,$sql);

$result = array();
 
while($row = mysqli_fetch_array($res)){
	array_push($result,
		array('customerid'=>$row[0],
		'first_name'=>$row[1],
		'last_name'=>$row[2],
		'phone_num'=>$row[3],
		'mobile_phone_num'=>$row[4],
		'address_line1'=>$row[5],
		'address_line2'=>$row[6],
		'address_line3'=>$row[7],
		'address_line4'=>$row[8],
		'county'=>$row[9],
		'country'=>$row[10],
		'last_contacted'=>$row[11],
		'sage_id'=>$row[12]
	));
}
//print_r (array_values($result));listing list-view clearfix

//Puts all the customer names in a table
//echo '<section class="panel-body">';
?>	 

	
<!-- ... -->
<table id="privateCustomers" class="tablesorter" align="center">
	<thead>
		<tr class = "blue-row">

			<th id = "first-table-column" class = "asset-list"><strong>Customer</strong></th>

			<th class = "asset-list"><strong>Phone</strong></th>

			<th class = "asset-list"><strong>Mobile</strong></th>

			<th class = "asset-list"><strong>Address</strong></th>
			<th class = "asset-list"><strong>City</strong></th>
			<th class = "asset-list"><strong>County</strong></th>

			<th class = "asset-list"><strong>Last Contacted</strong></th>
			<th class = "asset-list"><strong>Assets</strong></th>

		</tr>
	</thead>
<tbody>
	<?php
		foreach ($result as $results){
			$customerid = $results['customerid'];
			
			//To get the number of assets
			$sql2 = "SELECT stockid FROM `stock` WHERE stockid IN (SELECT stockid FROM uses WHERE jobid IN 
			(SELECT jobid FROM jobs WHERE jobid IN (SELECT jobid FROM customer_requires WHERE customerid = '$customerid'))); ";
			$res2 = mysqli_query($con,$sql2);
			$result2 = array();
			$assetCount = 0;
			while($row = mysqli_fetch_array($res2)){
				array_push($result2,
					array('stockid'=>$row[0]
				));
				$assetCount++;
			}		
	?>
			<tr>	
				<td><a href = "profile.php?customerid=<?php echo $customerid;?>&companyid=0 " class="name"><?php echo ucwords($results['first_name']).' '.ucwords($results['last_name']);?></a></td>
				<td><?php echo $results['phone_num']?></td>
				<td><?php echo $results['mobile_phone_num']?></td>
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
				<td>
					<?php 
						$date = $results['last_contacted'];
						$properDate = date("d/m/Y", strtotime($date));
						echo $properDate; 
					?>
				</td>
				<td><?php echo $assetCount ?></td>
			</tr>
	<?php
		}
		mysqli_close($con);
	?>
		</tbody>
	</table>