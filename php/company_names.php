<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$sql = "SELECT * FROM company; ";
 
$res = mysqli_query($con,$sql);

$result = array();


 
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
//print_r (array_values($result));

//Puts all the customer names in a table
//echo '<section class="panel-body">';
echo'		 
						<table id="contacts" class="listing list-view clearfix" align="center">
							<tbody>
							<th><tr class = "blue-row">
							<td class = "asset-list"></td>
							
							<td id = "first-table-column" class = "asset-list"><strong>Company</strong></td>
							
							<td class = "asset-list"><strong>Address</strong></td>
							
							<td class = "asset-list"><strong>Last Contacted</strong></td>
							
							<td id = "last-table-column" class = "asset-list"><strong>Sage ID</strong></td>
							
							</tr></th>';

		$i = 1;
		foreach ($result as $results){
			$companyid = $results['companyid'];
			if (1 != $i % 2){
				$rowClass = 'blue-row';
			}else{
				$rowClass = 'white-row';
			}
			echo'<tr class="company clearfix ' .$rowClass. '">
					<div class="clearfix">';
					  /*<div class="avatar"><img src="images/circle-icons/64px/profle.png" width="32" height="32" /></div>*/
					  //ucwods makes the first letter in the names capital
			
			echo	 '<td><a href = "profile.php?customerid=0&companyid='.$companyid.' " class="name">'. ucwords($results['name']) . '</a></td>';
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
					
				/*$date = $results['last_contacted'];
				$properDate = date("d-m-Y", strtotime($date));
				echo'
				<td>'.$properDate.'</td>*/
				
				

			

			//for getting the date of last contacted 
			$sql3 = "SELECT last_contacted FROM `workers` WHERE workerid IN (SELECT workerid FROM works_with WHERE companyid = '$companyid'); ";
			$res3 = mysqli_query($con,$sql3);
			$result3 = array();

			while($row = mysqli_fetch_array($res3)){
			array_push($result3,
			array('last_contacted'=>$row[0]
			));
			} 
		//print_r (array_values($result3));
			$mostRecent =0;
			foreach ($result3 as $results3){
				  $curDate= $results3['last_contacted'];
				  if ($curDate > $mostRecent) {
					 $mostRecent = $curDate;
					 //$ok = $mostRecent;
					 //echo 'in the if';
				  }
			}
			//$mostRecent = $results['last_contacted'];
			if($mostRecent != 0){
				$mostRecent = date("d/m/Y", strtotime($mostRecent));
			}else{
				$mostRecent = '----';
			}
			//echo $ok;
				echo'
				<td>'.$mostRecent.'</td>
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
