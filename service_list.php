<link rel="stylesheet" href="__jquery.tablesorter/themes/blue/style_table.css">
<?php

 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$sql = "SELECT stockid, serialid, name, model, installation_date, service_date, next_service FROM stock LIMIT 5; ";
 
$res = mysqli_query($con,$sql);

$result = array();
 
while($row = mysqli_fetch_array($res)){
	array_push($result,
		array('stockid'=>$row[0],
		'serialid'=>$row[1],
		'name'=>$row[2],
		'model'=>$row[3],
		'intallation_date'=>$row[4],
		'service_date'=>$row[5],
		'next_service'=>$row[6]
	));
}
//print_r (array_values($result));

//Puts all the customer names in a table
//echo '<section class="panel-body">';
?>	 

	
<!-- ... -->
<table id="serviceList" class="tablesorter filterable" align="center">
	<thead>
		<tr class = "blue-row">

			<th id = "first-table-column" class = "asset-list"><strong>Type</strong></th>
			<th class = "asset-list"><strong>Model</strong></th>
			<th class = "asset-list"><strong>Serial Number</strong></th>
			<th class = "asset-list"><strong>Installation Date</strong></th>
			<th class = "asset-list"><strong>Last Service</strong></th>
			<th class = "asset-list"><strong>Service Due</strong></th>

		</tr>
	</thead>
<tbody>
	<?php
		foreach ($result as $results){
			$stockid = $results['stockid'];
			
			//To get the number of assets
			$sql2 = "SELECT companyid, name, county FROM company WHERE companyid IN (SELECT companyid FROM company_requires WHERE jobid IN (SELECT jobid FROM uses WHERE stockid = '$stockid');";
			$res2 = mysqli_query($con,$sql2);
			// Return the number of rows in result set
			$rowcount=mysqli_num_rows($res2);
			if($rowcount<1){
				$sql2 = "SELECT customerid, first_name, last_name, county FROM customer WHERE customerid IN (SELECT customerid FROM customer_requires WHERE jobid IN (SELECT jobid FROM uses WHERE stockid = '$stockid');";
				$res2 = mysqli_query($con,$sql2);
				while ($row = mysql_fetch_assoc($res2)) {
					$customerid =  $row["customerid"];
					$customerName = $row["first_name"].' '.$row["last_name"];
					$county =  $row["county"];
				}
			}else{
				while ($row = mysql_fetch_assoc($res2)) {
					$companyid =  $row["companyid"];
					$companyName = $row["name"];
					$county =  $row["county"];
				}
			}
					
	?>
			<tr>	
				<!--<td><a href = "profile.php?customerid=<?php //echo $customerid;?>&companyid=0 " class="name"><?php //echo ucwords($results['first_name']).' '.ucwords($results['last_name']);?></a></td>-->
				<td><?php echo $results['type']?></td>
				<td><?php echo $results['model']?></td>
				<td><?php echo $results['serialid']?></td>
				<td><?php echo $results['installation_date']?></td>
				<td><?php echo $results['service_date']?></td>
				<td><?php echo $results['next_service']?></td>
				
			</tr>
	<?php
		}
		mysqli_close($con);
	?>
		</tbody>
	</table>