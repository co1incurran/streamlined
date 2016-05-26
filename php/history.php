<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

if(isset($_GET['companyid'])){
	$companyid = $_GET['companyid'];
	$companyid = mysqli_real_escape_string($con ,$companyid);
}

if(isset($_GET['customerid'])){
	$customerid = $_GET['customerid'];
	$customerid = mysqli_real_escape_string($con ,$customerid);
}
if($companyid != 0){
	$sql = "SELECT job_type, job_status, due_date, creation_date, job_sheet_number, po_number, job_number FROM jobs WHERE job_number <> 'not available' AND jobid IN (SELECT companyid FROM company_requires WHERE companyid = '$companyid'); ";
	
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
		'sage_id'=>$row2[8]
	));
	}
	//print_r (array_values($result2));
}else{
	$sql = "SELECT * FROM jobs WHERE jobid IN (SELECT customerid FROM customer_requires WHERE customerid = '$customerid'); ";
}
$res = mysqli_query($con,$sql);
$result = array();

 
while($row = mysqli_fetch_array($res)){
	array_push($result,
		array('job_type'=>$row[0],
		'job_status'=>$row[1],
		'due_date'=>$row[2],
		'creation_date'=>$row[3],
		'job_sheet_number'=>$row[4],
		'po_number'=>$row[5],
		'job_number'=>$row[6]
	));
}
 //print_r (array_values($result));
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
									 <hgroup>
												<h2>'. ucwords($results2['name']).'<br></h2>';
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
										<th class = "asset-list"><strong>Due Date</strong></th>
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
							/*<td class = "asset-list"><a id="edit"href="edit_asset.php?url='.$url.'&stockid='.$results2['stockid'].'&name='	.$results2['name'].'&model='.$results2['model'].'&manufacturer='.$results2['manufacturer'].'&installationdate='.$results2['installation_date'].'&inspectiondate='.$results2['inspection_date'].'&servicedate='.$results2['service_date'].'&location='.$results2['location'].'&contractrenewaldate='.$results2['contract_renewal_date'].'&lastresults='.$results2['last_results'].'&fundedby='.$results2['funded_by_owner'].'&productdescription='.$results2['product_description'].'&serialid='.$results2['serialid'].'"><i class="fa fa-gear"></i></a></td>*/
							echo '<tr class = "' .$rowClass. '">
										<td class = "asset-list"></td>
										<td class = "asset-list">'. ucwords($results['job_number']) . '</td>
										<td class = "asset-list">'. ucwords($results['job_type']) . '</td>
										<td class = "asset-list">'. ucwords($results['job_status']) . '</td>';
										$date1 = $results['due_date'];
										$properDate1 = date("d/m/Y", strtotime($date1));
										echo '<td class = "asset-list">'. ($properDate1) . '</td>
										<td class = "asset-list">'. ($results['job_sheet_number']) . '</td>
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