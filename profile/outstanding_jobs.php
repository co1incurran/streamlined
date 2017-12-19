 <?php

 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

if(isset($_GET['companyid'])){
	$companyid = $_GET['companyid'];
	$companyid = mysqli_real_escape_string($con ,$companyid);
}

if(isset($_GET['customerid'])){
	$customerid = $_GET['customerid'];
	$customerid = mysqli_real_escape_string($con ,$customerid);
}
if((isset($_GET['companyid'])) && $companyid != 0){
	$sql = "SELECT * FROM jobs WHERE  complete ='0' AND jobid IN (SELECT jobid FROM company_requires WHERE companyid = '$companyid') ORDER BY jobid DESC; ";
	
	$sql2 = "SELECT * FROM company WHERE companyid ='$companyid' ; ";
	$res2 = mysqli_query($con,$sql2);
	$result2 = array();
	 
	while($row2 = mysqli_fetch_array($res2)){
	array_push($result2,
		array('companyid'=>$row2[0],
		'name'=>$row2[1],
		'address_line1'=>$row2[2],
		'address_line2'=>$row2[3],
		'address_line3'=>$row2[4],
		'address_line4'=>$row2[5],
		'county'=>$row2[6],
		'country'=>$row2[7],
		'sage_id'=>$row2[8],
		'sector'=>$row2[9]
	));
	}
	$set = false;
	//print_r (array_values($result2));
}else{
	$sql = "SELECT * FROM jobs WHERE complete ='0' AND jobid IN (SELECT jobid FROM customer_requires WHERE customerid = '$customerid') ORDER BY jobid DESC; ";
	
	$sql2 = "SELECT * FROM customer WHERE customerid ='$customerid' ; ";
	$res2 = mysqli_query($con,$sql2);
	$result2 = array();
	 
	while($row2 = mysqli_fetch_array($res2)){
	array_push($result2,
		array('customerid'=>$row2[0],
		'name_prefix'=>$row2[1],
		'first_name'=>$row2[2],
		'last_name'=>$row2[3],
		'phone_num'=>$row2[4],
		'mobile_phone_num'=>$row2[5],
		'email'=>$row2[6],
		'fax'=>$row2[7],
		'address_line1'=>$row2[8],
		'address_line2'=>$row2[9],
		'address_line3'=>$row2[10],
		'address_line4'=>$row2[11],
		'county'=>$row2[12],
		'country'=>$row2[13]
	));
	}
	$set = true;
}
//echo $sql;
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
		'result' =>$row[13],
		'result_description'=>$row[14],
		'next_action'=>$row[15],
		'next_action_description'=>$row[16],
		'complete_date'=>$row[17],
		'add_asset'=>$row[18],
		'invoice_number' =>$row[19]
	));
}
// print_r (array_values($result));
 //echo '<br>';

 


$url = $_SERVER['REQUEST_URI'];
$url = str_replace('&', '%26', $url);
foreach($result2 as $results2){
	echo '<div class="main-section">
				
					<div class="container-fluid no-padding">
						<div class="col-md-7 no-padding">
							<div class="main-content panel panel-default no-margin">
								<header class="panel-heading clearfix">

									 <span class="avatar"></span>
									 <hgroup>';
									 //echo	
									 if($set == true){
										 echo '<h2>'. ucwords($results2['first_name']).' '.ucwords($results2['last_name']).'<a id="add_contact" href="add_job.php?url='.$url.'&customerid='.$customerid.'&companyid='.$companyid.'" class="btn btn-default profile_button" data-toggle="tooltip" title="View as a List"><i class="fa fa-plus"></i><strong> Add Job </strong></a><br></h2>';
									 }else{
										 echo '<h2>'. ucwords($results2['name']).'<a id="edit" href="edit_company_details.php?url='.$url.'&companyid='.$companyid.'&name='.$results2['name'].'&address_line1='.$results2['address_line1'].'&address_line2='.$results2['address_line2'].'&address_line3='.$results2['address_line3'].'&address_line4='.$results2['address_line4'].'&county='.$results2['county'].'&country='.$results2['country'].'&sage_id='.$results2['sage_id'].'&sector='.$results2['sector'].'"><i class="fa fa-gear"></i></a><a id="add_contact" href="add_job.php?url='.$url.'&customerid='.$customerid.'&companyid='.$companyid.'" class="btn btn-default profile_button" data-toggle="tooltip" title="View as a List"><i class="fa fa-plus"></i><strong> Add Job </strong></a><br></h2>';
									 }
												
												$ad1 = ucwords($results2['address_line1']);
												$ad2 = ucwords($results2['address_line2']);
												$ad3 = ucwords($results2['address_line3']);
												$ad4 = ucwords($results2['address_line4']);
												$county = ucwords($results2['county']);
												$country = ucwords($results2['country']);
												if(!empty($ad1)){ 
													echo $ad1.', ';
													//echo nl2br("\n");
												}
												if(!empty($ad2) && $ad2 != $ad1){ 
													echo $ad2.', ';
													//echo nl2br("\n");
												}
												if(!empty($ad3)&& $ad3 != $ad2 && $ad3 != $ad1){ 
													echo $ad3.', ';
													//echo nl2br("\n");
												}
												if(!empty($ad4)&& $ad4 != $ad3 && $ad4 != $ad2 && $ad4 != $ad1){ 
													echo $ad4.', ';
													//echo nl2br("\n");
												}
												if(!empty($county)&& $county != $ad4 && $county != $ad3){ 
													echo $county.', ';
													//echo nl2br("\n");
												}
												if(!empty($country)){ 
													echo $country;
												}
											 echo '</h3>
								</hgroup>
								</header>
								<section class="panel-body" style = "width:100%">';
									echo'		 
									<table align="center">
										<thead class = "blue-row">
											<tr class = "blue-row">
												<th></th>
												<th id = "td-header" class = "asset-list"><i class="fa fa-check"></i></th>
												<th class = "asset-list"><strong>Job Number</strong></th>
												<th class = "asset-list"><strong>Type</strong></th>
												<th class = "asset-list"><strong>Details</strong></th>
												
												<th class = "asset-list"><strong>Due Date</strong></th>
												<th class = "asset-list"><strong>Days Open</strong></th>
												<th class = "asset-list"><strong>Assets</strong></th>
											</tr>
										</thead>';
										$i = 1;
						foreach ($result as $results){
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
			
							if (1 != $i % 2){
								$rowClass = 'blue-row';
							}else{
								$rowClass = 'white-row';
							} 
							$complete = $results['complete'];
							
							echo '<tr class = "' .$rowClass. '">
										<td class = "asset-list">';
											if($results['job_type'] == 'installation'){
											echo'<td id= "complete-button"><a href="../jobs/installation_number.php?url='.$url.'&jobid='.$jobid.'&customerid='.$customerid.'&companyid='.$companyid.'&numberOfAssets='.$numberOfAssets.'"><i class="fa fa-square-o"></i></a></td>';
											}else{
												echo'<td id= "complete-button"><a href="../jobs/complete_job.php?url='.$url.'&jobid='.$jobid.'&customerid='.$customerid.'&companyid='.$companyid.'"><i class="fa fa-square-o"></i></a></td>';
											}
										echo
										'</td>
										<td class = "asset-list">'. ($results['job_number']) . '</td>
										<td class = "asset-list">
											<form action="../jobs/job_details.php" id="job-list" method="post" name="job-list">
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
											</form>
										</td>';
										if($complete == 1){
											echo '<td class = "asset-list">Complete</td>';
										}else{
											echo '<td class = "asset-list">'. ucwords($results['job_status']) . '</td>';
										}
										
										$openDate = $results['creation_date'];
										$openDate = strtotime($openDate);
										//Get the current timestamp.
										$now = time();
										
										//Calculate the difference.
										$difference = $now - $openDate;
											$days = floor($difference / (60*60*24) );
											//echo $days;
								
										
										$date1 = $results['due_date'];
										$properDate1 = date("d/m/Y", strtotime($date1));
										echo '<td class = "asset-list">'. ($properDate1) . '</td>
										<td class = "asset-list">'. $days . '</td>
										<td class = "asset-list">'. ($results['number_of_assets']) . '</td>
								</tr>';
								$i++;
						}
							echo '</table>
							</section>
							</div>
						</div>';
			echo '</div>
			</div>';
}
mysqli_close($con);
?>