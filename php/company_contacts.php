<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$companyid = $_GET['companyid'];
$companyid = mysqli_real_escape_string($con ,$companyid);

$sql = "SELECT * FROM company WHERE companyid ='$companyid' ; ";
$res = mysqli_query($con,$sql);
$result = array();

$sql3 = "SELECT * FROM `workers` WHERE workerid IN (SELECT workerid FROM works_with WHERE companyid = '$companyid'); ";
$res3 = mysqli_query($con,$sql3);
$result3 = array();


while($row = mysqli_fetch_array($res)){
	array_push($result,
		array('companyid'=>$row[0],
		'name'=>$row[1],
		'address_line1'=>$row[2],
		'address_line2'=>$row[3],
		'address_line3'=>$row[4],
		'address_line4'=>$row[5],
		'county'=>$row[6],
		'country'=>$row[7],
		'sage_id'=>$row[8]
	));
}

while($row = mysqli_fetch_array($res3)){
	array_push($result3,
		array('workerid'=>$row[0],
		'name_prefix'=>$row[1],
		'first_name'=>$row[2],
		'last_name'=>$row[3],
		'phone_num'=>$row[4],
		'mobile_phone_num'=>$row[5],
		'email'=>$row[6],
		'fax'=>$row[7],
		'job_title'=>$row[8],
		'pref_contact_type'=>$row[9],
		'last_contacted'=>$row[10]
	));
} //print_r (array_values($result3));

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
									 
										/*<a href="documentation/index.html" class="btn btn-default pull-right" rel="#overlay"><i class="fa fa-question-circle"></i></a>';*/
											 echo	'<h2>'. ucwords($results['name']).'<br></h2>';
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
											 foreach ($result3 as $results3){
												 $counter ++;
											 }
											 //menu for the business card
											 
											 echo '<h3>Contacts: '.$counter.'</h3>
								</hgroup>
								</header>
								<section class="panel-body" style = "width:100%">
									<table align="center">
										<th><tr class = "blue-row">
										<td class = "asset-list"></td>
										<td class = "asset-list"><strong>Name</strong></td>
										<td class = "asset-list"><strong>Phone</strong></td>
										<td class = "asset-list"><strong>Mobile</strong></td>
										<td class = "asset-list"><strong>Email</strong></td>
										<td class = "asset-list"><strong>Fax</strong></td>
										<td class = "asset-list"><strong>Job Title</strong></td>
										<td class = "asset-list"><strong>Last Contacetd</strong></td>
										</tr></th>';
										$i = 1;
						foreach ($result3 as $results3){
							if (1 != $i % 2){
								$rowClass = 'blue-row';
							}else{
								$rowClass = 'white-row';
							} 
							echo '<tr class = "' .$rowClass. '">
										<td class = "asset-list"><a id="edit" href="edit_company_contact.php?url='.$url.'&worker_number='.$results3['workerid'].'&firstname='
									.$results3['first_name'].'&lastname='.$results3['last_name'].'&email='.$results3['email'].'&phonenumber='.$results3['phone_num'].'&mobilenumber='.$results3['mobile_phone_num'].'&fax='.$results3['fax'].'&jobtitle='.$results3['job_title'].'&lastcontacted='.$results3['last_contacted'].'"><i class="fa fa-gear"></i></a></td>
										<td class = "asset-list">'.ucwords($results3['first_name']).' '.ucwords($results3['last_name']).'</td>
										<td class = "asset-list">'.$results3['phone_num'].'</td>
										<td class = "asset-list">'.$results3['mobile_phone_num'].'</td>
										<td class = "asset-list">'.$results3['email'].'</td>
										<td class = "asset-list">'.$results3['fax'].'</td>
										<td class = "asset-list">'.ucwords($results3['job_title']).'</td>';
										$date1 = $results3['last_contacted'];
										$properDate1 = date("d/m/Y", strtotime($date1));
										echo '<td class = "asset-list">'. ($properDate1) . '</td>
								</tr>';
								
								$i++;
						}
							echo '</table>
							</section>
							</div>
						</div>
					</div>
				</div>';
}
mysqli_close($con);
?>