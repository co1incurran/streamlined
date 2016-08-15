<link rel="stylesheet" href="__jquery.tablesorter/themes/blue/style_table.css">

<?php


$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

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
		$sql = "SELECT * FROM jobs WHERE complete = '0' ORDER BY due_date; ";
	}elseif($status == 'today'){
		$sql = "SELECT * FROM jobs WHERE complete = '0' AND due_date = '$currentDate'; ";
	}elseif($status == 'tomorrow'){
		$sql = "SELECT * FROM jobs WHERE complete = '0' AND due_date = '$tomorrow'; ";
	}elseif($status == 'week'){
		$sql = "SELECT * FROM jobs WHERE complete = '0' AND due_date BETWEEN '$monday' AND '$sunday' ORDER BY due_date; ";
	}elseif($status == 'month'){
		$sql = "SELECT * FROM jobs WHERE complete = '0' AND due_date BETWEEN '$startMonth' AND '$endMonth' ORDER BY due_date; ";
	}elseif($status == 'overdue'){
		$sql = "SELECT * FROM jobs WHERE complete = '0' AND due_date < '$currentDate' ORDER BY due_date; ";
	}elseif($status == 'completed'){
		$sql = "SELECT * FROM jobs WHERE complete = '1' ORDER BY due_date DESC; ";
	}else{
		$sql = "SELECT * FROM jobs WHERE complete = '0' ORDER BY due_date; ";
	}
}else{
		$sql = "SELECT * FROM jobs WHERE complete = '0' ORDER BY due_date; ";
}




 
$res = mysqli_query($con,$sql);

$result = array();
 
while($row = mysqli_fetch_array($res)){
	array_push($result,
		array('jobid'=>$row[0],
		'complete'=>$row[1],
		'job_type'=>$row[2],
		'job_description'=>$row[3],
		'job_status'=>$row[4],
		'due_date'=>$row[5],
		'creation_date'=>$row[6],
		'sage_reference'=>$row[7],
		'po_number'=>$row[8],
		'job_number'=>$row[9],
		'number_of_assets'=>$row[10],
		'notes'=>$row[11],
		'quote_number'=>$row[12]
	));
}
//print_r (array_values($result));

?>	 

	
<!-- ... -->
<table id="jobList" class="tablesorter filterable" align="center">
	<thead>
		<tr class = "blue-row">
			<td id = "td-header" class = "asset-list"><i class="fa fa-check"></i></td>
			<th class = "asset-list"><strong>Type</strong></th>
			<th class = "asset-list"><strong>Status</strong></th>
			<th class = "asset-list"><strong>Date</strong></th>
			<th class = "asset-list"><strong>Days Open</strong></th>
			<th class = "asset-list"><strong>Assets</strong></th>
			<th class = "asset-list"><strong>Job Number</strong></th>
			<th class = "asset-list"><strong>Customer</strong></th>
			<th class = "asset-list"><strong>County</strong></th>
		</tr>
	</thead>
<tbody>
	<?php
		foreach ($result as $results){
			$companyid = 0;
			$customerid = 0;
			$jobid = $results['jobid'];
			$complete = $results['complete'];
			$jobType = $results['job_type'];
			$jobDescription = $results['job_description'];
			$jobStatus = $results['job_status'];
			$dueDate = $results['due_date'];
			//$time = $results['time'];
			//$creationDate = $results['creation_date'];
			$sageReference = $results['sage_reference'];
			$poNumber = $results['po_number'];
			$jobNumber = $results['job_number'];
			$numberOfAssets = $results['number_of_assets'];
			$notes = $results['notes'];
			$quoteNumber = $results['quote_number'];
			
			//To get the company or customer the activity is for
			$sql2 = "SELECT companyid, name, county, lead FROM company WHERE companyid IN (SELECT companyid FROM company_requires WHERE jobid = '$jobid'); ";
			$res2 = mysqli_query($con,$sql2);
			if(mysqli_num_rows($res2) < 1){
				$sql3 = "SELECT customerid, first_name, last_name, county, lead FROM customer WHERE customerid IN (SELECT customerid FROM customer_requires WHERE jobid = '$jobid'); ";
				$res3 = mysqli_query($con,$sql3);
				$row = mysqli_fetch_assoc($res3);
				$customerid = $row["customerid"];
			}else{
				$row = mysqli_fetch_assoc($res2);
				$companyid = $row["companyid"];
			}
			
			if ($results['job_type'] == 'installation'){
						$icon = '<i class="fa fa-sign-in"> </i>';
			}elseif ($results['job_type'] == 'inspection'){
				$icon = '<i class="fa fa-search"></i>';
			}elseif ($results['job_type'] == 'service'){
				$icon = '<i class="fa fa-check-square-o"></i>';
			}elseif ($results['job_type'] == 'repair'){
				$icon = '<i class="fa fa-medkit"></i>';
			}elseif ($results['job_type'] == 'delivery'){
				$icon = '<i class="fa fa-truck"></i>';
			}elseif ($results['job_type'] == 'collection'){
				$icon = '<i class="fa fa-bus"></i>';
			}elseif ($results['job_type'] == 'training'){
				$icon = '<i class="fa fa-male"></i>';
			}elseif ($results['job_type'] == 'other'){
				$icon = '<i class="fa fa-question"></i>';
			}else{
				$icon =  '<i class="fa fa-question"></i>';
			}
	?>
			<tr>
					<?php
					if($status != 'completed'){
						if($results['job_type'] == 'installation'){
							echo'<td id= "complete-button"><a href="installation_number.php?url='.$url.'&jobid='.$jobid.'&customerid='.$customerid.'&companyid='.$companyid.'&numberOfAssets='.$numberOfAssets.'"><i class="fa fa-square-o"></i></a></td>';
						}else{
							echo'<td id= "complete-button"><a href="activity_results.php?url='.$url.'&activityid='.$jobid.'&customerid='.$customerid.'&companyid='.$companyid.'"><i class="fa fa-square-o"></i></a></td>';
						}
					}else{
						echo'<td id= "complete-button"><a href="incomplete_job.php?url='.$url.'&activityid='.$jobid.'"><i class="fa fa-check-square-o"></i></a></td>';
					}
					?>
				
				<td>
				<?php 					
					echo'
					<form action="job_details.php" id="job-list" method="post" name="job-list">
						<input type="hidden" name="url" id="url" value="'.$url.'">
						<input type="hidden" name="jobid" id="jobid" value="'.$jobid.'">
						
						<input type="hidden" name="complete" id="complete" value="'.$complete.'">
						<input type="hidden" name="jobType" id="jobType" value="'.$jobType.'">
						
						<input type="hidden" name="jobDescription" id="jobDescription" value="'.$jobDescription.'">
						<input type="hidden" name="jobStatus" id="jobStatus" value="'.$jobStatus.'">
						
						<input type="hidden" name="dueDate" id="dueDate" value="'.$dueDate.'">
						<input type="hidden" name="sageReference" id="sageReference" value="'.$sageReference.'">
						
						<input type="hidden" name="quote_number" id="quote_number" value="'.$quoteNumber.'">
						<input type="hidden" name="poNumber" id="poNumber" value="'.$poNumber.'">
						<input type="hidden" name="jobNumber" id="jobNumber" value="'.$jobNumber.'">
						
						<input type="hidden" name="numberOfAssets" id="numberOfAssets" value="'.$numberOfAssets.'">
						<input type="hidden" name="notes" id="notes" value="'.$notes.'">
						'.$icon.' '.'<input type="submit" id="job-type" value="'.ucwords($results['job_type']).'">
					</form>';
				?>
				</td>
				
				<td>
					<?php
						if($results['complete'] == 0){
							echo ucwords($results['job_status']);
						}else{
							echo 'Complete';
						}
					?>
				</td>
				<td>
					<?php $originalDate = $results['due_date'];
						$newDate = date("d/m/Y", strtotime($originalDate));
						echo $newDate;
					?>
				</td>
				<td>
				<?php
					if($results['complete'] == 0){
					//works out days open 
					
						//get the current date 
						$dt = new DateTime();
						$installdate = $dt->format('Y-m-d');
						$openDate = $results['creation_date'];
						
						//convert it to a timestamp
						$openDate = strtotime($openDate);
						//Get the current timestamp.
						$now = time();
						
						//Calculate the difference.
						$difference = $now - $openDate;
						
						$days = floor($difference / (60*60*24) );
						echo $days;
					}else{
						echo 'Closed';
					}
				?>
				</td>
				<td>
					<?php
						echo ucwords($results['number_of_assets']);
					?>
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
			</tr>
	<?php
		}
		mysqli_close($con);
	?>
		</tbody>
	</table>
	
</body>
</html>