<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$sql = "SELECT customerid, first_name, last_name, phone_num, mobile_phone_num, address_line1, address_line2, address_line3, address_line4, county, country, last_contacted, sage_id FROM customer; ";
 
$res = mysqli_query($con,$sql);

$result = array();
 
while($row = mysqli_fetch_array($res)){
	array_push($result,
		array('customerid'=>$row[0],
		'first_name'=>$row[1],
		'last_name'=>$row[2],
		'phone_num'=>$row[3],
		'mobile_phone_num'=>$row[4],
		'address_line1'=>$row[5],
		'address_line2'=>$row[6],
		'address_line3'=>$row[7],
		'address_line4'=>$row[8],
		'county'=>$row[9],
		'country'=>$row[10],
		'last_contacted'=>$row[11],
		'sage_id'=>$row[12]
	));
}
//print_r (array_values($result));
//Puts all the customer names in a table
//echo '<section class="panel-body">';
echo'		 
						<table id="contacts" class="listing list-view clearfix" align="center">
							<tbody>
							<th><tr class = "blue-row">
							<td class = "asset-list"></td>
							
							<td id = "first-table-column" class = "asset-list"><strong>Name</strong></td>
							
							<td class = "asset-list"><strong>Phone Number</strong></td>
							
							<td class = "asset-list"><strong>Mobile Number</strong></td>
							
							<td class = "asset-list"><strong>Address</strong></td>
							
							<td class = "asset-list"><strong>Last Contacted</strong></td>
							
							<td id = "last-table-column" class = "asset-list"><strong>Sage ID</strong></td>
							
							</tr></th>';

		$i = 1;
		foreach ($result as $results){
			if (1 != $i % 2){
				$rowClass = 'blue-row';
			}else{
				$rowClass = 'white-row';
			}
			echo'<tr class="company clearfix ' .$rowClass. '">
					<div class="clearfix">';
					  /*<div class="avatar"><img src="images/circle-icons/64px/profle.png" width="32" height="32" /></div>*/
					  //ucwods makes the first letter in the names capital
			$customerid = $results['customerid'];
			echo	 '<td><a href = "profile.php?customerid='.$customerid.'&companyid=0 " class="name">'. ucwords($results['first_name']) . ' ' . ucwords($results['last_name']) .'</a></td>
					<td>'.$results['phone_num'].'</td>
					<td>'.$results['mobile_phone_num'].'</td>';
						$ad1 = ucwords($results['address_line1']);
						$ad2 = ucwords($results['address_line2']);
						$ad3 = ucwords($results['address_line3']);
						$ad4 = ucwords($results['address_line4']);
						$county = ucwords($results['county']);
						$country = ucwords($results['country']);
						echo'
						<td>';
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
						}echo'</td>';
					
			$date = $results['last_contacted'];
			$properDate = date("d-m-Y", strtotime($date));
			echo'
			<td>'.$properDate.'</td>
			<td>'.$results['sage_id'].'</td>';
			echo	'</tr>
				</div>';
				$i++;
		}
echo '</tbody>
	</table>
	</div>';
 
mysqli_close($con);
 
?>
