<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$activityid = $_GET['activityid'];
$activityid = mysqli_real_escape_string($con ,$activityid);
$sql = "SELECT * FROM activity WHERE activityid = $activityid; ";
 
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
//print_r (array_values($result));

?>	 

	
<!-- ... -->
<table id="activityList" class="tablesorter" align="center">
	<thead>
		<tr class = "blue-row">

			<th id = "first-table-column" class = "asset-list"><strong>Type</strong></th>

			<th class = "asset-list"><strong>Date</strong></th>
			<th class = "asset-list"><strong>Time</strong></th>

			<th class = "asset-list"><strong>Customer</strong></th>
			
			<th class = "asset-list"><strong>County</strong></th>
			
		</tr>
	</thead>
<tbody>
	<?php
		foreach ($result as $results){
			$companyid = 0;
			$customerid = 0;
			$activityid = $results['activityid'];
			
			//To get the company or customer the activity is for
			$sql2 = "SELECT companyid, name, county FROM company WHERE companyid IN (SELECT companyid FROM company_activity WHERE activityid = '$activityid'); ";
			$res2 = mysqli_query($con,$sql2);
			if(mysqli_num_rows($res2) < 1){
				$sql3 = "SELECT customerid, first_name, last_name, county FROM customer WHERE customerid IN (SELECT customerid FROM customer_activity WHERE activityid = '$activityid'); ";
				$res3 = mysqli_query($con,$sql3);
				$row = mysqli_fetch_assoc($res3);
				$customerid = $row["customerid"];
			}else{
				$row = mysqli_fetch_assoc($res2);
				$companyid = $row["companyid"];
			}
	?>
			<tr>
				<td><a href = "tasks.php?details=true&activityid=<?php echo $results['activityid'] ?>" class="name"><?php echo ucwords($results['type']); ?></td>
				<td>
					<?php $originalDate = $results['due_date'];
						$newDate = date("d.m.Y", strtotime($originalDate));
						echo $newDate;
					?>
				</td>
				<td>
					<?php echo date('h:ia', strtotime($results['time']));?>
				</td>
				<td><a href = "profile.php?customerid=<?php echo $customerid.'&companyid='.$companyid?>" class="name">
				<?php
					if($customerid >= 1){
						echo ucwords($row['first_name']).' '.ucwords($row['last_name']);
					}else{
						echo ucwords($row['name']);
					}
				?>
				</a></td>
				<td><?php echo ucwords($row['county']); ?></td>
				
			</tr>
	<?php
		}
	?>
		</tbody>
	</table>
</body>
</html>