<link rel="stylesheet" href="__jquery.tablesorter/themes/blue/style_table.css">
<?php
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

//$sql = "SELECT stockid, installation_date, service_date, next_service FROM stock WHERE stockid IN(SELECT stockid FROM uses WHERE jobid IN (SELECT jobid FROM company_requires WHERE companyid IN(SELECT companyid FROM company WHERE county = '$county'))); ";
$county = $_GET['county'];
$type = $_GET['type'];

if($type == 'all' || $type == 'company'){
	//echo 'here';
	if(isset($_POST['date1']) && $_POST['date1'] != '' && isset($_POST['date2']) && $_POST['date2'] != ''){
		$date1 = $_POST['date1'];
		$date2 = $_POST['date2'];
		echo 'here';
		$sql = "SELECT companyid, name, address_line1, address_line2, address_line3, address_line4, county FROM company WHERE county = '$county' AND companyid IN(SELECT companyid FROM company_requires WHERE jobid IN (SELECT jobid FROM uses WHERE stockid IN(SELECT stockid FROM stock WHERE next_service BETWEEN '$date1' AND '$date2')))";
	}
	elseif(isset($_POST['date1']) && $_POST['date1'] != ''){
		$sql = "SELECT companyid, name, address_line1, address_line2, address_line3, address_line4, county FROM company WHERE county = '$county' AND companyid IN(SELECT companyid FROM company_requires WHERE jobid IN (SELECT jobid FROM uses WHERE stockid IN(SELECT stockid FROM stock)))";
	}
	elseif(isset($_POST['date2']) && $_POST['date2'] != ''){
		$sql = "SELECT companyid, name, address_line1, address_line2, address_line3, address_line4, county FROM company WHERE county = '$county' AND companyid IN(SELECT companyid FROM company_requires WHERE jobid IN (SELECT jobid FROM uses WHERE stockid IN(SELECT stockid FROM stock)))";
	}
	else{
		$sql = "SELECT companyid, name, address_line1, address_line2, address_line3, address_line4, county FROM company WHERE county = '$county' AND companyid IN(SELECT companyid FROM company_requires WHERE jobid IN (SELECT jobid FROM uses WHERE stockid IN(SELECT stockid FROM stock)))";
	}
	 
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
			'county'=>$row[6]
		));
	}
	//print_r (array_values($result));
}

if($type == 'all' || $type == 'privatecustomer'){
	//private customers
	$sql2 = "SELECT customerid, first_name, last_name, address_line1, address_line2, address_line3, address_line4, county FROM customer WHERE county = '$county' AND customerid IN(SELECT customerid FROM customer_requires WHERE jobid IN (SELECT jobid FROM uses WHERE stockid IN(SELECT stockid FROM stock)));";
	// echo $sql2;
	$res2 = mysqli_query($con,$sql2);

	$result2 = array();
	 
	while($row = mysqli_fetch_array($res2)){
		array_push($result2,
			array('customerid'=>$row[0],
			'first_name'=>$row[1],
			'last_name'=>$row[2],
			'address_line1'=>$row[3],
			'address_line2'=>$row[4],
			'address_line3'=>$row[5],
			'address_line4'=>$row[6],
			'county'=>$row[7]
		));
	}
	//print_r (array_values($result2));
}
?>	 

	
<!-- ... -->
<table id="serviceList" class="tablesorter filterable" align="center">
	<thead>
		<tr class = "blue-row">

			<th id = "first-table-column" class = "asset-list"><strong>Customer</strong></th>
			<th class = "asset-list"><strong>Address</strong></th>
			<th class = "asset-list"><strong>City</strong></th>
			<th class = "asset-list"><strong>County</strong></th>
			<th class = "asset-list"><strong>Services Due</strong></th>
			<th class = "asset-list"><strong>Customer Type</strong></th>
		</tr>
	</thead>
<tbody>
	<?php
		//get the current date
		$date = date('Y/m/d');
		
		if($type == 'all' || $type == 'company'){
			foreach ($result as $r){
				$companyid = $r['companyid'];
				//NEED TO WORK ON THIS PART
				//if(isset($_POST['date1']) || isset($_POST['date2'])){
				//	if($_POST['date1'] != '' || $_POST['date2'] != ''){
						//selects all the stock in each county that is for trade use (owned by a company)
						$sql = "SELECT stockid FROM stock WHERE stockid IN(SELECT stockid FROM uses WHERE jobid IN (SELECT jobid FROM company_requires WHERE companyid = '$companyid')); ";
						//echo $sql;
						$res = mysqli_query($con,$sql);
						$stockCount=mysqli_num_rows($res);
						
						//selects all the stock in each county that is for private use (owned by a private customer)
						$sql2 = "SELECT stockid, installation_date, service_date, next_service FROM stock WHERE stockid IN(SELECT stockid FROM uses WHERE jobid IN (SELECT jobid FROM customer_requires WHERE customerid IN(SELECT customerid FROM customer WHERE county = '$county'))); ";
						//echo $sql;
						$res2 = mysqli_query($con,$sql2);
						$privateCount=mysqli_num_rows($res2);
					//}
			//	}

	?>
			<tr>	
				<!--<td><a href = "profile.php?customerid=<?php //echo $customerid;?>&companyid=0 " class="name"><?php //echo ucwords($results['first_name']).' '.ucwords($results['last_name']);?></a></td>-->
				<td><?php echo '<a href = "profile.php?customerid=0&companyid='.$companyid.'" class="name">'.ucwords($r['name']);?></a></td>
				<td>
				<?php
					$ad1 = ucwords($r['address_line1']);
					$ad2 = ucwords($r['address_line2']);
					$ad3 = ucwords($r['address_line3']);
					$ad4 = ucwords($r['address_line4']);
					$county = ucwords($r['county']);

					//$country = ucwords($r['country']);
					$city=0;
						if(!empty($ad1)){ 
							echo $ad1;
							//echo nl2br("\n");
						}
						
						if(!empty($ad2) && $ad2 != $ad1){
							if(!empty($ad3)&& $ad3 != $ad2 && $ad3 != $ad1){
								if(!empty($ad1)){
									echo', ';
								}
								echo $ad2;
							}elseif(!empty($ad4)&& $ad4 != $ad3 && $ad4 != $ad2 && $ad4 != $ad1){
								if(!empty($ad1)){
									echo', ';
								}
								echo $ad2;
							}else{
								$city = $ad2;
							}
						}
						if($city < 1){
							if(!empty($ad3)&& $ad3 != $ad2 && $ad3 != $ad1){ 
								if(!empty($ad4)&& $ad4 != $ad3 && $ad4 != $ad2 && $ad4 != $ad1){
									if(!empty($ad1) || !empty($ad2)){
										echo', ';
									}
									echo $ad3;
								}else{
									$city = $ad3;
								}
							}
							if($city < 1){
								if(!empty($ad4)&& $ad4 != $ad3 && $ad4 != $ad2 && $ad4 != $ad1){ 
									$city = $ad4;
								}
							}	
								
						}
				?>
				</td>
				<?php
						if($city === 0){
							$city = '';
						}
				?>
				<td><?php echo $city; ?></td>
				<td>
					<?php 
						if(!empty($county)){ 
							echo $county;
							//echo nl2br("\n");
						}
					?>
				</td>
				<td><?php echo $stockCount ?></td>
				<td><?php echo 'Trade' ?></td>
			</tr>
	<?php
			}
		}
	?>
	
	<?php
		//get the current date
		$date = date('Y/m/d');
		
		if($type == 'all' || $type == 'privatecustomer'){
			foreach ($result2 as $r2){
				$customerid = $r2['customerid'];
				//NEED TO WORK ON THIS PART
				//if(isset($_POST['date1']) || isset($_POST['date2'])){
				//	if($_POST['date1'] != '' || $_POST['date2'] != ''){
						//selects all the stock in each county that is for trade use (owned by a company)
						$sql = "SELECT stockid FROM stock WHERE stockid IN(SELECT stockid FROM uses WHERE jobid IN (SELECT jobid FROM customer_requires WHERE customerid = '$customerid')); ";
						//echo $sql;
						$res = mysqli_query($con,$sql);
						$stockCount=mysqli_num_rows($res);
						
						//selects all the stock in each county that is for private use (owned by a private customer)
						$sql2 = "SELECT stockid, installation_date, service_date, next_service FROM stock WHERE stockid IN(SELECT stockid FROM uses WHERE jobid IN (SELECT jobid FROM customer_requires WHERE customerid IN(SELECT customerid FROM customer WHERE county = '$county'))); ";
						//echo $sql;
						$res2 = mysqli_query($con,$sql2);
						$privateCount=mysqli_num_rows($res2);
					//}
			//	}

	?>
			<tr>	
				<!--<td><a href = "profile.php?customerid=<?php //echo $customerid;?>&companyid=0 " class="name"><?php //echo ucwords($results['first_name']).' '.ucwords($results['last_name']);?></a></td>-->
				<td><?php echo '<a href = "profile.php?customerid='.$customerid.'&companyid=0" class="name">'.ucwords($r2['first_name']).' '.ucwords($r2['last_name']);?></a></td>
				<td>
				<?php
					$ad1 = ucwords($r2['address_line1']);
					$ad2 = ucwords($r2['address_line2']);
					$ad3 = ucwords($r2['address_line3']);
					$ad4 = ucwords($r2['address_line4']);
					$county = ucwords($r2['county']);

					//$country = ucwords($r['country']);
					$city=0;
						if(!empty($ad1)){ 
							echo $ad1;
							//echo nl2br("\n");
						}
						
						if(!empty($ad2) && $ad2 != $ad1){
							if(!empty($ad3)&& $ad3 != $ad2 && $ad3 != $ad1){
								if(!empty($ad1)){
									echo', ';
								}
								echo $ad2;
							}elseif(!empty($ad4)&& $ad4 != $ad3 && $ad4 != $ad2 && $ad4 != $ad1){
								if(!empty($ad1)){
									echo', ';
								}
								echo $ad2;
							}else{
								$city = $ad2;
							}
						}
						if($city < 1){
							if(!empty($ad3)&& $ad3 != $ad2 && $ad3 != $ad1){ 
								if(!empty($ad4)&& $ad4 != $ad3 && $ad4 != $ad2 && $ad4 != $ad1){
									if(!empty($ad1) || !empty($ad2)){
										echo', ';
									}
									echo $ad3;
								}else{
									$city = $ad3;
								}
							}
							if($city < 1){
								if(!empty($ad4)&& $ad4 != $ad3 && $ad4 != $ad2 && $ad4 != $ad1){ 
									$city = $ad4;
								}
							}	
								
						}
				?>
				</td>
				<?php
						if($city === 0){
							$city = '';
						}
				?>
				<td><?php echo $city; ?></td>
				<td>
					<?php 
						if(!empty($county)){ 
							echo $county;
							//echo nl2br("\n");
						}
					?>
				</td>
				<td><?php echo $stockCount ?></td>
				<td><?php echo 'Private' ?></td>
			</tr>
	<?php
			}
		}
	?>
	<?php
		mysqli_close($con);
	?>
		</tbody>
	</table>