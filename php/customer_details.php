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

$sql2 = "SELECT * FROM `stock` WHERE stockid IN (SELECT jobid FROM uses WHERE jobid IN 
(SELECT jobid FROM jobs WHERE jobid IN (SELECT customerid FROM customer_requires WHERE customerid = '$customerid'))); ";
 
$res2 = mysqli_query($con,$sql2);
 
$result2 = array();
 
while($row = mysqli_fetch_array($res)){
	array_push($result,
		array('customer id'=>$row[0],
		'name_prefix'=>$row[1],
		'first_name'=>$row[2],
		'last_name'=>$row[3],
		'phone_num'=>$row[4],
		'mobile_phone_num'=>$row[5],
		'email'=>$row[6],
		'fax'=>$row[7],
		'address_line1'=>$row[8],
		'address_line2'=>$row[9],
		'address_line3'=>$row[10],
		'address_line4'=>$row[11],
		'county'=>$row[12],
		'country'=>$row[13],
		'last_contacted'=>$row[14],
		'pref_contact_type'=>$row[15],
		'sage_id'=>$row[16]
	));
}
 
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
}

foreach ($result as $results){
echo '<div class="main-section">
				
					<div class="container-fluid no-padding">
						<div class="col-md-7 no-padding">
							<div class="main-content panel panel-default no-margin">
								<header class="panel-heading clearfix">

									 <span class="avatar"></span>
									 <hgroup>
										 <a href="documentation/index.html" class="btn btn-default pull-right" rel="#overlay"><i class="fa fa-question-circle"></i></a>';
											 echo	'<h2>'. ucwords($results['first_name']) . ' ' . ucwords($results['last_name']) .'<br></h2>';
											 echo '<h3>Assets</h3>';
								echo	'</hgroup>
								</header>
								<section class="panel-body" style = "width:100%">
									
									<table align="center">
										<th><tr class = "blue-row">
										<td class = "asset-list"><strong>Product</strong></td>
										<td class = "asset-list"><strong>Model</strong></td>
										<td class = "asset-list"><strong>Manufacturer</strong></td>
										<td class = "asset-list"><strong>Install Date</strong></td>
										<td class = "asset-list"><strong>Last Service</strong></td>
										<td class = "asset-list"><strong>Serial Number</strong></td>
										</tr></th>';
										$i = 1;
						foreach ($result2 as $results2){
							if (1 != $i % 2){
								$rowClass = 'blue-row';
							}else{
								$rowClass = 'white-row';
							} 
							echo '<tr class = "' .$rowClass. '">
										<td class = "asset-list">'. ucwords($results2['name']) . '</td>
										<td class = "asset-list">'. ucwords($results2['model']) . '</td>
										<td class = "asset-list">'. ucwords($results2['manufacturer']) . '</td>
										<td class = "asset-list">'. ($results2['installation_date']) . '</td>
										<td class = "asset-list">'. ($results2['service_date']) . '</td>
										<td class = "asset-list">'. ($results2['serialid']) . '</td>
								</tr>';
								$i++;
						}
							echo '</table>
							</section>
							</div>
						</div>

						<div class="preview-pane col-md-5">
							<div class="content">
						  <h3>Details</h3>
								<ul class="fa-ul">';
									echo '<li id = "details"><i class="fa-li fa fa-envelope"></i><small class="pull-right text-muted">Email</small>'. ($results['email']) .'<br></li>';
									echo '<li id = "details"><i class="fa-li fa fa-phone"></i><small class="pull-right text-muted">Phone</small>'. ($results['phone_num']) .'<br></li>';
									echo '<li id = "details"><i class="fa-li fa fa-mobile"></i><small class="pull-right text-muted">Mobile</small>'. ($results['mobile_phone_num']) .'<br></li>';
									echo '<li id = "details"><i class="fa-li fa fa-fax"></i><small class="pull-right text-muted">Fax</small>'. ($results['fax']) .'<br></li>';
									echo '<li id = "details"><i class="fa-li fa fa-home"></i><small class="pull-right text-muted">Address</small>';
									$ad1 = ucwords($results['address_line1']);
									$ad2 = ucwords($results['address_line2']);
									$ad3 = ucwords($results['address_line3']);
									$ad4 = ucwords($results['address_line4']);
									$county = ucwords($results['county']);
									$country = ucwords($results['country']);
									if(!empty($ad1)){ 
										echo $ad1.',';
										echo nl2br("\n");
									}
									if(!empty($ad2)){ 
										echo $ad2.',';
										echo nl2br("\n");
									}
									if(!empty($ad3)){ 
										echo $ad3.',';
										echo nl2br("\n");
									}
									if(!empty($ad4)){ 
										echo $ad4.',';
										echo nl2br("\n");
									}
									if(!empty($county)&& $county != $ad4 && $county != $ad3){ 
										echo $county.',';
										echo nl2br("\n");
									}
									if(!empty($country)){ 
										echo $country;
									}
									$date = $results['last_contacted'];
									$properDate = date("d-m-Y", strtotime($date));
									echo '</li>
								</ul>
								<div>';
								echo'<h4 style = "padding-top:8px">Additional info</h4>
								<ul class="fa-ul">
									<li id = "details"><i class="fa-li fa fa-calendar"></i><small class="pull-right text-muted">Last Contacted</small>'. ($properDate) .'<br></li>
									<li id = "details"><i class="fa-li fa fa-clipboard"></i><small class="pull-right text-muted">Sage ID</small>'. ($results['sage_id']) . '<br></li>
								</ul>
								</div>
							</div>
						</div>
					</div>
				</div>';
}
mysqli_close($con);
 
?>