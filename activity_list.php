<link rel="stylesheet" href="__jquery.tablesorter/themes/blue/style_table.css">
<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$sql = "SELECT activityid, type, description, due_date, time FROM activity WHERE complete = 0; ";
 
$res = mysqli_query($con,$sql);

$result = array();
 
while($row = mysqli_fetch_array($res)){
	array_push($result,
		array('activityid'=>$row[0],
		'type'=>$row[1],
		'description'=>$row[2],
		'due_date'=>$row[3],
		'time'=>$row[4]
	));
}
print_r (array_values($result));

//Puts all the customer names in a table
//echo '<section class="panel-body">';
?>	 

	
<!-- ... -->
<table id="privateCustomers" class="tablesorter" align="center">
	<thead>
		<tr class = "blue-row">

			<th id = "first-table-column" class = "asset-list"><strong>Type</strong></th>

			<th class = "asset-list"><strong>Time</strong></th>

			<th class = "asset-list"><strong>Date</strong></th>

			<th class = "asset-list"><strong>Customer</strong></th>
			
		</tr>
	</thead>
<tbody>
	<?php
		foreach ($result as $results){
			$activityid = $results['activityid'];
			
			//To get the company or customer the activity is for
			$sql2 = "SELECT companyid, name FROM company WHERE companyid IN (SELECT companyid FROM company_activity WHERE activityid = '$activityid'); ";
			$res2 = mysqli_query($con,$sql2);
			$setter = 0;
			if(mysqli_num_rows($res2) < 1){
				$setter = 1;
				$sql3 = "SELECT customerid, first_name, last_name FROM customer WHERE customerid IN (SELECT customerid FROM customer_activity WHERE activityid = '$activityid'); ";
				$res3 = mysqli_query($con,$sql3);
				
				$result2 = array();
				$assetCount = 0;
				while($row = mysqli_fetch_array($res3)){
					array_push($result2,
						array('customerid'=>$row[0]
							'first_name'=>$row[1],
							'last_name'=>$row[2]
					));
				}	
			}else{
				$result2 = array();
				$assetCount = 0;
				while($row = mysqli_fetch_array($res2)){
					array_push($result2,
						array('companyid'=>$row[0]
							'name'=>$row[1],
							'address_line1'=>$row[2],
							'address_line2'=>$row[3],
							'address_line3'=>$row[4],
							'address_line4'=>$row[5],
							'city'=>$row[6],
							'county'=>$row[7]
					));
				}	
			}
	?>
			<tr>
				<td><?php echo ucwords($results['type']); ?></td>
				<td><?php echo ucwords($results['time']); ?></td>
				<td><?php echo ucwords($results['date']); ?></td>
				<td><?php echo ucwords($results['description']); ?></td>
				<td><a href = "profile.php?customerid=<?php echo $customerid;?>&companyid=0 " class="name"><?php echo ucwords($results['first_name']).' '.ucwords($results['last_name']);?></a></td>
			</tr>
	<?php
		}
	?>
		</tbody>
	</table>