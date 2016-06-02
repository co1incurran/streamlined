<link rel="stylesheet" href="__jquery.tablesorter/themes/blue/style_table.css">
<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");

$url = $_SERVER['REQUEST_URI'];
$url = str_replace('&', '%26', $url);
//get the current date 
$dt = new DateTime();
$currentDate = $dt->format('Y-m-d');
//echo $currentDate.'<br>';
$tomorrow = new DateTime('tomorrow');
$tomorrow = $tomorrow->format('Y-m-d');
//echo $tomorrow->format('Y-m-d');

//getting the date of the start and end of the current week
$monday = date("Y-m-d", strtotime("monday this week"));
$sunday = date("Y-m-d", strtotime("sunday this week"));
//echo '<br>'.$monday;
//echo '<br>'.$sunday.'<br>';

//getting the start and end dates if the current month
// First day of the month.
$startMonth = date('Y-m-01', strtotime($currentDate)).'<br>';

// Last day of the month.
$endMonth = date('Y-m-t', strtotime($currentDate)).'<br>';

$status = '';
if(isset($_GET['status'])){
	$status = $_GET['status'];
	//echo $status;
	
	if($status == 'all'){
		$sql = "SELECT jobid, job_type, job_status, due_date, time, job_number FROM jobs WHERE complete = '0' ORDER BY due_date; ";
	}elseif($status == 'today'){
		$sql = "SELECT jobid, job_type, job_status, due_date, time, job_number FROM jobs WHERE complete = '0' AND due_date = '$currentDate'; ";
	}elseif($status == 'tomorrow'){
		$sql = "SELECT jobid, job_type, job_status, due_date, time, job_number FROM jobs WHERE complete = '0' AND due_date = '$tomorrow'; ";
	}elseif($status == 'week'){
		$sql = "SELECT jobid, job_type, job_status, due_date, time, job_number FROM jobs WHERE complete = '0' AND due_date BETWEEN '$monday' AND '$sunday' ORDER BY due_date; ";
	}elseif($status == 'month'){
		$sql = "SELECT jobid, job_type, job_status, due_date, time, job_number FROM jobs WHERE complete = '0' AND due_date BETWEEN '$startMonth' AND '$endMonth' ORDER BY due_date; ";
	}elseif($status == 'overdue'){
		$sql = "SELECT jobid, job_type, job_status, due_date, time, job_number FROM jobs WHERE complete = '0' AND due_date < '$currentDate' ORDER BY due_date; ";
	}elseif($status == 'completed'){
		$sql = "SELECT jobid, job_type, job_status, due_date, time, job_number FROM jobs WHERE complete = '1' ORDER BY due_date DESC; ";
	}else{
		$sql = "SELECT jobid, job_type, job_status, due_date, time, job_number FROM jobs WHERE complete = '0' ORDER BY due_date; ";
	}
}else{
		$sql = "SELECT jobid, job_type, job_status, due_date, time, job_number FROM jobs WHERE complete = '0' ORDER BY due_date; ";
}

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);


 
$res = mysqli_query($con,$sql);

$result = array();
 
while($row = mysqli_fetch_array($res)){
	array_push($result,
		array('jobid'=>$row[0],
		'job_type'=>$row[1],
		'job_status'=>$row[2],
		'due_date'=>$row[3],
		'time'=>$row[4],
		'job_number'=>$row[5]
	));
}
//print_r (array_values($result));
?>	 

	
<!-- ... -->
<table id="jobList" class="tablesorter" align="center">
	<thead>
		<tr class = "blue-row">

			<th id = "first-table-column" class = "asset-list"><strong>Type</strong></th>

			<th class = "asset-list"><strong>Status</strong></th>
			<th class = "asset-list"><strong>Date</strong></th>

			<th class = "asset-list"><strong>Time</strong></th>
			
			<th class = "asset-list"><strong>Job Number</strong></th>
			<th class = "asset-list"><strong>Customer</strong></th>
			<th class = "asset-list"><strong>County</strong></th>
			<td id = "td-header" class = "asset-list"></td>
		</tr>
	</thead>
<tbody>
	<?php
		foreach ($result as $results){
			$companyid = 0;
			$customerid = 0;
			$jobid = $results['jobid'];
			
			//To get the company or customer the activity is for
			$sql2 = "SELECT companyid, name, county FROM company WHERE companyid IN (SELECT companyid FROM company_requires WHERE jobid = '$jobid'); ";
			$res2 = mysqli_query($con,$sql2);
			if(mysqli_num_rows($res2) < 1){
				$sql3 = "SELECT customerid, first_name, last_name, county FROM customer WHERE customerid IN (SELECT customerid FROM customer_requires WHERE jobid = '$jobid'); ";
				$res3 = mysqli_query($con,$sql3);
				$row = mysqli_fetch_assoc($res3);
				$customerid = $row["customerid"];
			}else{
				$row = mysqli_fetch_assoc($res2);
				$companyid = $row["companyid"];
			}
	?>
			<tr>
				<td>
				<?php 
					if ($results['job_type'] == 'installation'){
						echo '<i class="fa fa-sign-in"> </i>';
					}elseif ($results['job_type'] == 'inspection'){
						echo '<i class="fa fa-search"></i>';
					}elseif ($results['job_type'] == 'service'){
						echo '<i class="fa fa-check-square-o"></i>';
					}elseif ($results['job_type'] == 'repair'){
						echo '<i class="fa fa-medkit"></i>';
					}elseif ($results['job_type'] == 'delivery'){
						echo '<i class="fa fa-truck"></i>';
					}elseif ($results['job_type'] == 'collection'){
						echo '<i class="fa fa-bus"></i>';
					}elseif ($results['job_type'] == 'training'){
						echo '<i class="fa fa-male"></i>';
					}elseif ($results['job_type'] == 'other'){
						echo '<i class="fa fa-question"></i>';
					}else{
						echo '<i class="fa fa-question"></i>';
					}
				?>
				<a href = "tasks.php?details=true&activityid=<?php echo $results['jobid'] ?>" class="name">
				<?php
					echo ucwords($results['job_type']);
				?>
				</td>
				<td>
					<?php
						echo ucwords($results['job_status']);
					?>
				</td>
				<td>
					<?php $originalDate = $results['due_date'];
						$newDate = date("d.m.Y", strtotime($originalDate));
						echo $newDate;
					?>
				</td>
				<td>
					<?php echo date('h:ia', strtotime($results['time']));?>
				</td>
				<td>
					<?php echo $results['job_number'];?>
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
				<?php
				if($status != 'completed'){
						echo'<td id= "complete-button"><a href="job_results.php?url='.$url.'&activityid='.$jobid.'&customerid='.$customerid.'&companyid='.$companyid.'" id="submit">Complete</a></td>';
				}else{
					echo'<td id= "complete-button"><a href="incomplete_job.php?url='.$url.'&activityid='.$jobid.'" id="submit">Incomplete</a></td>';
				}
				?>
			</tr>
	<?php
		}
		mysqli_close($con);
	?>
		</tbody>
	</table>
</body>
</html>