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
	$sql = "SELECT * FROM jobs WHERE  job_number !='' AND jobid IN (SELECT jobid FROM company_requires WHERE companyid = '$companyid') ORDER BY complete; ";
	
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
	$sql = "SELECT * FROM jobs WHERE job_number !='' AND jobid IN (SELECT jobid FROM customer_requires WHERE customerid = '$customerid'); ";
	
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
		'quote_number'=>$row[12]
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
										<th class = "asset-list"></th>
										<th class = "asset-list"><strong>Job Number</strong></th>
										<th class = "asset-list"><strong>Job Type</strong></th>
										<th class = "asset-list"><strong>Status</strong></th>
										<th class = "asset-list"><strong>Completion Date</strong></th>
										<th class = "asset-list"><strong>Job Sheet Reference</strong></th>
										<th class = "asset-list"><strong>PO Number</strong></th>
										</thead>';
										$i = 1;
						foreach ($result as $results){
							if (1 != $i % 2){
								$rowClass = 'blue-row';
							}else{
								$rowClass = 'white-row';
							} 
							$complete = $results['complete'];
							
							echo '<tr class = "' .$rowClass. '">
										<td class = "asset-list"></td>
										<td class = "asset-list">'. ($results['job_number']) . '</td>
										<td class = "asset-list">'. ucwords($results['job_type']) . '</td>';
										if($complete == 1){
											echo '<td class = "asset-list">Complete</td>';
										}else{
											echo '<td class = "asset-list">'. ucwords($results['job_status']) . '</td>';
										}
										
										$date1 = $results['due_date'];
										$properDate1 = date("d/m/Y", strtotime($date1));
										echo '<td class = "asset-list">'. ($properDate1) . '</td>
										<td class = "asset-list">'. ($results['job_number']) . '</td>
										<td class = "asset-list">'. ($results['po_number']) . '</td>
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