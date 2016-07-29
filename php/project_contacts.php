<?php



//print_r (array_values($result));

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
					<td class = "asset-list"><a id="edit" href="edit_company_contact.php?url='.$url.'&worker_number='.$results2['workerid'].'&firstname='
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
	

	echo '</tbody>
		</table>';
?>