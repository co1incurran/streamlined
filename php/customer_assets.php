<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$customerid = $_GET['customerid'];
$customerid = mysqli_real_escape_string($con ,$customerid);
$sql = "SELECT * FROM customer WHERE customerid ='$customerid' ; ";
$res = mysqli_query($con,$sql);
$result = array();


$sql2 = "SELECT * FROM `stock` WHERE stockid IN (SELECT stockid FROM uses WHERE jobid IN 
(SELECT jobid FROM jobs WHERE jobid IN (SELECT jobid FROM customer_requires WHERE customerid = '$customerid'))); ";
$res2 = mysqli_query($con,$sql2);
$result2 = array();
 
while($row = mysqli_fetch_array($res)){
	array_push($result,
		array('customerid'=>$row[0],
		'name_prefix'=>$row[1],
		'first_name'=>$row[2],
		'last_name'=>$row[3],
		'phone_num'=>$row[4],
		'mobile_phone_num'=>$row[5],
		'first_name'=>$row[6],
		'last_name'=>$row[7],
		'address_line1'=>$row[8],
		'address_line2'=>$row[9],
		'address_line3'=>$row[10],
		'address_line4'=>$row[11],
		'county'=>$row[12],
		'country'=>$row[13],
		'last_contacted'=>$row[14],
		'pref_cintact_type'=>$row[15],
		'sage_id'=>$row[16]
	));
}
 print_r (array_values($result));
 //echo '<br>';
while($row = mysqli_fetch_array($res2)){
	array_push($result2,
		array('stockid'=>$row[0],
		'serialid'=>$row[1],
		'name'=>$row[2],
		'model'=>$row[3],
		'manufacturer'=>$row[4],
		'product_description'=>$row[5],
		'installation_date'=>$row[6],
		'inspection_date'=>$row[7],
		'service_date'=>$row[8],
		'location'=>$row[9],
		'contract_renewal_date'=>$row[10],
		'contract_with_us'=>$row[11],
		'funded_by_owner'=>$row[12],
		'last_results'=>$row[13]
	));
} //print_r (array_values($result2));
//echo '<br>';

//used to ensure a proper page reload if details are updated
$url = $_SERVER['REQUEST_URI'];
$url = str_replace('&', '%26', $url);

foreach ($result as $results){
	echo '<div class="main-section">
				
					<div class="container-fluid no-padding">
						<div class="col-md-7 no-padding">
							<div class="main-content panel panel-default no-margin">
								<header class="panel-heading clearfix">

									 <span class="avatar"></span>
									 <hgroup>';
									 
											 echo'<h2>'. ucwords($results['first_name']) . ' ' . ucwords($results['last_name']) .'<br></h2>';
												$ad1 = ucwords($results['address_line1']);
												$ad2 = ucwords($results['address_line2']);
												$ad3 = ucwords($results['address_line3']);
												$ad4 = ucwords($results['address_line4']);
												$county = ucwords($results['county']);
												$country = ucwords($results['country']);
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
												//to count the number of assets 
											 $counter = 0;
											 foreach ($result2 as $results2){
												 $counter ++;
											 }
											 //menu for the business card
											 
											 echo '<h3>Assets: '.$counter.'</h3>
								</hgroup>
								</header>
								<section class="panel-body" style = "width:100%">';
									echo'		 
									<table align="center">
										<th><tr class = "blue-row">
										<td class = "asset-list"></td>
										<td class = "asset-list"><strong>Product</strong></td>
										<td class = "asset-list"><strong>Model</strong></td>
										<td class = "asset-list"><strong>Manufacturer</strong></td>
										<td class = "asset-list"><strong>Install Date</strong></td>
										<td class = "asset-list"><strong>Last Service</strong></td>
										<td class = "asset-list"><strong>Serial Number</strong></td>
										<td class = "asset-list"><strong>Location</strong></td>
										</tr></th>';
										$i = 1;
						foreach ($result2 as $results2){
							if (1 != $i % 2){
								$rowClass = 'blue-row';
							}else{
								$rowClass = 'white-row';
							} 
							echo '<tr class = "' .$rowClass. '">
										<td class = "asset-list"><a id="edit"href="edit_asset.php?url='.$url.'&stockid='.$results2['stockid'].'&name='
										.$results2['name'].'&model='.$results2['model'].'&manufacturer='.$results2['manufacturer'].'&installationdate='.$results2['installation_date'].'&inspectiondate='.$results2['inspection_date'].'&servicedate='.$results2['service_date'].'&location='.$results2['location'].'&contractrenewaldate='.$results2['contract_renewal_date'].'&lastresults='.$results2['last_results'].'&fundedby='.$results2['funded_by_owner'].'&productdescription='.$results2['product_description'].'&serialid='.$results2['serialid'].'"><i class="fa fa-gear"></i></a></td>
										
										<td class = "asset-list">'. ucwords($results2['name']) . '</td>
										<td class = "asset-list">'. ucwords($results2['model']) . '</td>
										<td class = "asset-list">'. ucwords($results2['manufacturer']) . '</td>';
										$date1 = $results2['installation_date'];
										$properDate1 = date("d/m/Y", strtotime($date1));
										echo '<td class = "asset-list">'. ($properDate1) . '</td>';
										$date2 = $results2['service_date'];
										$properDate2 = date("d/m/Y", strtotime($date2));
										echo '<td class = "asset-list">'. ($properDate2) . '</td>
										<td class = "asset-list">'. ($results2['serialid']) . '</td>
										<td class = "asset-list">'. ($results2['location']) . '</td>
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