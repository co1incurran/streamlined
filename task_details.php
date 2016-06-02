<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$activityid = $_GET['activityid'];
//echo $activityid;
$activityid = mysqli_real_escape_string($con ,$activityid);
$sql = "SELECT * FROM activity WHERE activityid = $activityid; ";
$res = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($res);

$complete = $row["complete"];
$type = ucwords($row["type"]);
$prospectingType = ucwords($row["prospecting_type"]);
$description = $row["description"];
$dueDate = $row["due_date"];
$dueDate = date("d.m.Y", strtotime($dueDate));
$time = $row["time"];
$time = date('h:ia', strtotime($time));
$result = ucwords($row["result"]);
$resultDescription = $row["result_description"];
$creationDate = $row["creation_date"];
$creationDate = date("d.m.Y", strtotime($creationDate));
//echo $creationDate;
echo ' 
<table class = "work-details">
	<tbody>';
	if(!empty($complete)|| !$complete ==''){
		if($complete == 0){
			$complete = 'Incomplete';
		}else{
			$complete = 'Complete';
		}
		echo'<tr><td><strong>Status:</strong></td><td>'.$complete.'</td></tr>';
	}
	if(!empty($type)|| !$type ==''){
		echo'<tr><td><strong>Type:</strong></td><td>'.$type.'</td></tr>';
	}
	if(!empty($prospectingType)|| !$prospectingType ==''){
		echo'<tr><td><strong>Prospecting type:</strong></td><td>'.$prospectingType.'</td></tr>';
	}
	if(!empty($description)|| !$description ==''){
		echo'<tr><td><strong>Description:</strong></td><td>'.$description.'</td></tr>';
	}
	if(!empty($dueDate)|| !$dueDate ==''){
		echo'<tr><td><strong>Due date:</strong></td><td>'.$dueDate.'</td></tr>';
	}
	if(!empty($time)|| !$time ==''){
		echo'<tr><td><strong>Time:</strong></td><td>'.$time.'</td></tr>';
	}
	if(!empty($result)|| !$result ==''){
		echo'<tr><td><strong>Type:</strong></td><td>'.$result.'</td></tr>';
	}
	if(!empty($resultDescription)|| !$resultDescription ==''){
		echo'<tr><td><strong>Result description:</strong></td><td>'.$resultDescription.'</td></tr>';
	}
	if(!empty($creationDate)|| !$creationDate ==''){
		echo'<tr><td><strong>Creation date:</strong></td><td>'.$creationDate.'</td></tr>';
	}
		echo'
	<tbody>
<table>';
		/*
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
				
			</tr>*/
	//<?php
		//}
		mysqli_close($con);
	?>
		</tbody>
	</table>
</body>
</html>