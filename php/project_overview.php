<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$projectid = mysqli_real_escape_string($con ,$projectid);
//echo $projectid;
$sql = "SELECT * FROM projects WHERE projectid ='$projectid' ; ";
//echo $sql;
$res = mysqli_query($con,$sql);
$result = array();

 
while($row = mysqli_fetch_array($res)){
	array_push($result,
		array('companyid'=>$row[0],
		'planning_number'=>$row[1],
		'est_start_date'=>$row[2],
		'address_line1'=>$row[3],
		'address_line2'=>$row[4],
		'address_line3'=>$row[5],
		'address_line4'=>$row[6],
		'county'=>$row[7],
		'country'=>$row[8],
		'regarding'=>$row[9],
		'notes'=> $row[10],
		'closed'=> $row[11]
	));
}
 //print_r (array_values($result));
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
										/*<a href="documentation/index.html" class="btn btn-default pull-right" rel="#overlay"><i class="fa fa-question-circle"></i></a>';*/
											 echo	'<h2>'. ucwords($results['planning_number']).'</h2>';//.'<a id="edit" href="edit_company_details.php?url='.$url.'&companyid='.$companyid.'&name='.$results['name'].'&address_line1='.$results['address_line1'].'&address_line2='.$results['address_line2'].'&address_line3='.$results['address_line3'].'&address_line4='.$results['address_line4'].'&county='.$results['county'].'&country='.$results['country'].'&sage_id='.$results['sage_id'].'&sector='.$results['sector'].'"><i class="fa fa-gear"></i></a><br><br></h2>';
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
											 
											 echo '</h3>
								</hgroup>
								</header>
								<section class="panel-body" style = "width:100%">';
								echo'<div id="project-notes">' 
										.$results['notes']. 
									'</div>';
						
							echo'
							</section>
							</div>
						</div>';
			echo '</div>
			</div>';
}
mysqli_close($con);
?>