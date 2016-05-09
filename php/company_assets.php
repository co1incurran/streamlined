<?php


$companyid = $_GET['companyid'];
$companyid = mysqli_real_escape_string($con ,$companyid);


$sql2 = "SELECT * FROM `stock` WHERE stockid IN (SELECT stockid FROM uses WHERE jobid IN 
(SELECT jobid FROM jobs WHERE jobid IN (SELECT jobid FROM company_requires WHERE companyid = '$companyid'))); ";
$res2 = mysqli_query($con,$sql2);
$result2 = array();

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
echo '							 
											 <ul id="business-card-menu">
											 <li class= "current-tab"><a href>Assets</a></li>
											 <li><a>Contacts</a></li>
											 <li><a>History</a></li>
											 <li><a>Notes</a></li>
											 </ul>
									<table align="center">
										<th><tr class = "blue-row">
										<td class = "asset-list"><strong>Product</strong></td>
										<td class = "asset-list"><strong>Model</strong></td>
										<td class = "asset-list"><strong>Manufacturer</strong></td>
										<td class = "asset-list"><strong>Install Date</strong></td>
										<td class = "asset-list"><strong>Inspection Date</strong></td>
										<td class = "asset-list"><strong>Service Due</strong></td>
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
										<td class = "asset-list">'. ucwords($results2['manufacturer']) . '</td>';
										
										$date = $results2['installation_date'];
										$properDate = date("d/m/Y", strtotime($date));
										echo '<td class = "asset-list">'. ($properDate) . '</td>';
										
										$date1 = $results2['inspection_date'];
										$properDate1 = date("d/m/Y", strtotime($date1));
										echo '<td class = "asset-list">'. ($properDate1) . '</td>';
										
										$date2 = $results2['service_date'];
										$properDate2 = date("d/m/Y", strtotime($date2));
										echo '<td class = "asset-list">'. ($properDate2) . '</td>
										<td class = "asset-list">'. ($results2['serialid']) . '</td>
								</tr>';
								$i++;
						}
							echo '</table>
							</section>
							</div>
						</div>';
			echo '</div>
		</div>';


?>