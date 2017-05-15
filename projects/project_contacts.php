<?php

//print_r (array_values($result));
//used for getting the url of this page for when it is needed for the variables 
$url = $_SERVER['REQUEST_URI'];
$url = str_replace('&', '%26', $url);

 echo'
			</hgroup>
			</header>
			<section class="panel-body" style = "width:100%">
				<table align="center">
					<thead><tr class = "blue-row">
					<td class = "asset-list"></td>
					<td class = "asset-list"><strong>Name</strong></td>
					<td class = "asset-list"><strong>Job Title</strong></td>
					<td class = "asset-list"><strong>Phone</strong></td>
					<td class = "asset-list"><strong>Mobile</strong></td>
					<td class = "asset-list"><strong>Email</strong></td>
					<td class = "asset-list"><strong>Fax</strong></td>
					<td class = "asset-list"><strong>Employer</strong></td>
					</thead>
					<tbody>';

	$sql2 = "SELECT * FROM `workers` WHERE workerid IN (SELECT workerid FROM worker_to_project WHERE projectid = '$projectid'); ";
//echo $sql2;
	$res2 = mysqli_query($con,$sql2);
	$result2 = array();

	while($row = mysqli_fetch_array($res2)){
		array_push($result2,
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
	}
	//print_r (array_values($result2));

	//used to ensure a proper page reload if details are updated
	$url = $_SERVER['REQUEST_URI'];
	$url = str_replace('&', '%26', $url);
	
	
	$i = 1;
	foreach ($result2 as $results2){
		$workerid = $results2['workerid'];
		$sql3 = "SELECT companyid, name FROM company WHERE companyid IN (SELECT companyid FROM works_with WHERE workerid = '$workerid'); ";

		$res3 = mysqli_query($con,$sql3);
		$row = mysqli_fetch_assoc($res3);
		
		$cid = $row['companyid'];
		$cname = $row['name'];

		
		if (1 != $i % 2){
			$rowClass = 'blue-row';
		}else{
			$rowClass = 'white-row';
		} 


		echo '<tr class = "' .$rowClass. '">
					<td class = "asset-list"><a id="edit" href="../profile/edit_company_contact.php?url='.$url.'&worker_number='.$results2['workerid'].'&firstname='
					.$results2['first_name'].'&lastname='.$results2['last_name'].'&email='.$results2['email'].'&phonenumber='.$results2['phone_num'].'&mobilenumber='.$results2['mobile_phone_num'].'&fax='.$results2['fax'].'&jobtitle='.$results2['job_title'].'&lastcontacted='.$results2['last_contacted'].'"><i class="fa fa-gear"></i></a></td>
					<td class = "asset-list">'.ucwords($results2['first_name']).' '.ucwords($results2['last_name']).'</td>
					<td class = "asset-list">'.ucwords($results2['job_title']).'</td>
					<td class = "asset-list">'.$results2['phone_num'].'</td>
					<td class = "asset-list">'.$results2['mobile_phone_num'].'</td>
					<td class = "asset-list">'.$results2['email'].'</td>
					<td class = "asset-list">'.$results2['fax'].'</td>
					<td class = "asset-list"><a href="profile.php?customerid=0&companyid='.$cid.'" class = "name">'.ucwords($cname).'</a></td>
			</tr>';
			
			$i++;

		
	}
	$sql = "SELECT companyid, name FROM company WHERE companyid IN (SELECT companyid FROM company_to_project WHERE projectid = '$projectid') AND companyid NOT IN (SELECT companyid FROM works_with WHERE workerid IN (SELECT workerid FROM worker_to_project WHERE projectid = '$projectid') );";
	
	//echo $sql;
	$res = mysqli_query($con,$sql);
	//$row = mysqli_fetch_assoc($res);
	$result = array();

	while($row = mysqli_fetch_array($res)){
		array_push($result,
			array('companyid'=>$row[0],
			'name'=>$row[1]
		));
	}
	foreach($result as $r){
		$companyid = $r['companyid'];
		$company = ucwords($r['name']);
		
		if (1 != $i % 2){
			$rowClass = 'blue-row';
		}else{
			$rowClass = 'white-row';
		} 
		
		echo '<tr class = "' .$rowClass. '">
					<td class = "asset-list"></td>
					<td class = "asset-list">No Personal Details</td>
					<td class = "asset-list"></td>
					<td class = "asset-list"></td>
					<td class = "asset-list"></td>
					<td class = "asset-list"></td>
					<td class = "asset-list"></td>
					<td class = "asset-list"><a href="profile.php?customerid=0&companyid='.$companyid.'" class = "name">'.$company.'</a></td>
			</tr>';
			
			$i++;
	}
	//////////////////////////////////////////////////////////////
	//this part is for getting the 
	$sql4 = "SELECT customerid, first_name, last_name, phone_num, mobile_phone_num, email, fax, address_line1, address_line2, address_line3, address_line4, county, country, last_contacted FROM customer WHERE customerid IN (SELECT customerid FROM customer_to_project WHERE projectid = '$projectid'); ";
	//echo $sql4;
	$res4 = mysqli_query($con,$sql4);
	//$row = mysqli_fetch_assoc($res);
	$result4 = array();

	while($row4 = mysqli_fetch_array($res4)){
		array_push($result4,
			array('customerid'=>$row4[0],
			'first_name'=>$row4[1],
			'last_name'=>$row4[2],
			'phone_num'=>$row4[3],
			'mobile_phone_num'=>$row4[4],
			'email'=>$row4[5],
			'fax'=>$row4[6],
			'address_line1'=>$row4[7],
			'address_line2'=>$row4[8],
			'address_line3'=>$row4[9],
			'address_line4'=>$row4[10],
			'county'=>$row4[11],
			'country'=>$row4[12],
			'last_contacted'=>$row4[13]
		));
	}
	foreach($result4 as $r4){
		$customerid = $r4['customerid'];
		$name = ucwords($r4['first_name']).' '.ucwords($r4['last_name']);
		$phone = $r4['phone_num'];
		$mobilePhone = $r4['mobile_phone_num'];
		$email = $r4['email'];
		$fax = $r4['fax'];
	
	
		if (1 != $i % 2){
			$rowClass = 'blue-row';
		}else{
			$rowClass = 'white-row';
		} 
		
		echo '<tr class = "' .$rowClass. '">
					<td class = "asset-list"><a id="edit" href="../profile/edit_private_contact.php?url='.$url.'&customerid='.$customerid.'&firstname='.$r4['first_name'].'&lastname='.$r4['last_name'].'&email='.$r4['email'].'&phonenumber='.$r4['phone_num'].'&mobilenumber='.$r4['mobile_phone_num'].'&fax='.$r4['fax'].'&lastcontacted='.$r4['last_contacted'].'&address1='.$r4['address_line1'].'&address2='.$r4['address_line2'].'&address3='.$r4['address_line3'].'&address4='.$r4['address_line4'].'&county='.$r4['county'].'&country='.$r4['country'].'"><i class="fa fa-gear"></i></a></td>
					<td class = "asset-list">'.$name.'</td>
					<td class = "asset-list"></td>
					<td class = "asset-list">'.$phone.'</td>
					<td class = "asset-list">'.$mobilePhone.'</td>
					<td class = "asset-list">'.$email.'</td>
					<td class = "asset-list">'.$fax.'</td>
					<td class = "asset-list"><a href="../profile/profile.php?customerid='.$customerid.'&companyid=0" class = "name">'.$name.'</a></td>
			</tr>';
			
			$i++;
	}

	echo '</tbody>
		</table>';
?>