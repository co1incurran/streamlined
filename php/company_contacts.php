<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$companyid = $_GET['companyid'];
$companyid = mysqli_real_escape_string($con ,$companyid);

$sql3 = "SELECT * FROM `workers` WHERE workerid IN (SELECT workerid FROM works_with WHERE companyid = '$companyid'); ";
$res3 = mysqli_query($con,$sql3);
$result3 = array();


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
									echo'									 
											 <ul id="business-card-menu">
											 <li><a href>Assets</a></li>
											 <li class= "current-tab"><a>Contacts</a></li>
											 <li><a>History</a></li>
											 <li><a>Notes</a></li>
											 </ul>
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
										<td class = "asset-list"><a id="edit" href="edit_company_contact.php?worker_number='.$results3['workerid'].'&firstname='
									.$results3['first_name'].'&lastname='.$results3['last_name'].'&email='.$results3['email'].'&phonenumber='.$results3['phone_num'].'&mobilenumber='.$results3['mobile_phone_num'].'&fax='.$results3['fax'].'&jobtitle='.$results3['job_title'].'&lastcontacted='.$results3['last_contacted'].'"><i class="fa fa-gear"></i></a></td>
										<td class = "asset-list">'.ucwords($results3['first_name']).' '.ucwords($results3['last_name']).'</td>
										<td class = "asset-list">'.$results3['phone_num'].'</td>
										<td class = "asset-list">'.$results3['mobile_phone_num'].'</td>
										<td class = "asset-list">'.$results3['email'].'</td>
										<td class = "asset-list">'.$results3['fax'].'</td>
										<td class = "asset-list">'.$results3['job_title'].'</td>';
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

mysqli_close($con);
?>