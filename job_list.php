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
//this is for setting the header of the date column, it changes id you are looking a the completed jobs
$dateType = 'Date';
//this is for choosing to show the due date or the completed date, it changes to the completed date if you are looking at the completed tasks 
$datePicker = 'due_date';

$status = '';
if(isset($_GET['status'])){
	$status = $_GET['status'];
	//echo $status;
	
	if($status == 'all'){
		$sql = "SELECT * FROM jobs WHERE complete = '0' AND add_asset != '1' ORDER BY jobid DESC; ";
	}elseif($status == 'today'){
		$sql = "SELECT * FROM jobs WHERE complete = '0' AND add_asset != '1' AND due_date = '$currentDate'; ";
	}elseif($status == 'tomorrow'){
		$sql = "SELECT * FROM jobs WHERE complete = '0' AND add_asset != '1' AND due_date = '$tomorrow'; ";
	}elseif($status == 'week'){
		$sql = "SELECT * FROM jobs WHERE complete = '0' AND add_asset != '1' AND due_date BETWEEN '$monday' AND '$sunday' ORDER BY jobid DESC; ";
	}elseif($status == 'month'){
		$sql = "SELECT * FROM jobs WHERE complete = '0' AND add_asset != '1' AND due_date BETWEEN '$startMonth' AND '$endMonth' ORDER BY jobid DESC; ";
	}elseif($status == 'overdue'){
		$sql = "SELECT * FROM jobs WHERE complete = '0' AND add_asset != '1' AND due_date < '$currentDate' ORDER BY jobid DESC; ";
	}elseif($status == 'completed'){
		$sql = "SELECT * FROM jobs WHERE complete = '1' AND add_asset != '1' ORDER BY complete_date DESC; ";
		//this changes the variable which is previously set about 20 lines above
		$dateType = 'Complete Date';
		//this is used to set the dagte to the complete date
		$datePicker = 'complete_date';
	}else{
		$sql = "SELECT * FROM jobs WHERE complete = '0' AND add_asset != '1' ORDER BY jobid DESC; ";
	}
}else{
		$sql = "SELECT * FROM jobs WHERE complete = '0' AND add_asset != '1' ORDER BY jobid DESC; ";
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
		'quote_number'=>$row[12],
		'result'=>$row[13],
		'result_description'=>$row[14],
		'next_action'=>$row[15],
		'next_action_description'=>$row[16],
		'complete_date'=>$row[17],
		'add_asset'=>$row[18],
		'invoice_number'=>$row[19]
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
			<th class = "asset-list"><strong>Details</strong></th>
			<?php
				if($status =='completed' ){
					echo'<th class = "asset-list"><strong>Invoice</strong></th>';
				}else{
					echo'<th class = "asset-list"><strong>Status</strong></th>';
				}
			?>
			
			<th class = "asset-list"><strong><?php echo $dateType; ?></strong></th>
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
			$invoiceNumber = $results['invoice_number'];
			
			//To get the company or customer the activity is for
			$sql2 = "SELECT companyid, name, county, lead FROM company WHERE companyid IN (SELECT companyid FROM company_requires WHERE jobid = '$jobid'); ";
			//echo $sql2.'<br>';
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
			
			//this gets the user who is assigned the job
			$sql3 = "SELECT userid FROM assigned WHERE jobid = '$jobid'; ";
			//echo $sql3;
			//echo $sql2.'<br>';
			$res3 = mysqli_query($con,$sql3);
			$row3 = mysqli_fetch_assoc($res3);
			$userName = $row3["userid"];
			
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
			}elseif ($results['job_type'] == 'take out of service'){
				$icon = '<i class="fa fa-reply"></i>';
			}
			else{
				$icon =  '<i class="fa fa-question"></i>';
			}
	?>
			<tr>
					<?php
					if($status != 'completed'){
						if($results['job_type'] == 'installation'){
							echo'<td id= "complete-button"><a href="installation_number.php?url='.$url.'&jobid='.$jobid.'&customerid='.$customerid.'&companyid='.$companyid.'&numberOfAssets='.$numberOfAssets.'"><i class="fa fa-square-o"></i></a></td>';
						}else{
							echo'<td id= "complete-button"><a href="complete_job.php?url='.$url.'&jobid='.$jobid.'&customerid='.$customerid.'&companyid='.$companyid.'"><i class="fa fa-square-o"></i></a></td>';
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
						<input type="hidden" name="username" id="username" value="'.$userName.'">
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
						<input type="hidden" name="invoiceNumber" id="invoiceNumber" value="'.$invoiceNumber.'">
						'.$icon.' '.'<input type="submit" id="job-type" value="'.ucwords($results['job_type']).'">
					</form>';
				?>
				</td>
				<td><?php echo $jobDescription; ?></td>
				<td>
					<?php
						if($results['complete'] == 0){
							echo ucwords($results['job_status']);
						}else{
							//this shows the invoice number of completed jobs
							echo $results['invoice_number'];
						}
					?>
				</td>
				<td>
					<?php 
					//this shows either the due date or the completed date 
					$originalDate = $results[$datePicker];
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
						$openDate = $results['creation_date'];
						
						//convert it to a timestamp
						$openDate = strtotime($openDate);
						
						$closeDate = $results['complete_date'];
						
						//convert it to a timestamp
						$closeDate = strtotime($closeDate);
						
						//Calculate the difference.
						$difference = $closeDate - $openDate;
						
						$days = floor($difference / (60*60*24) );
						echo $days;
						//echo 'Closed';
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