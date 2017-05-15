<?php
include'../include/session.php'

define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$jobid = $_GET['jobid'];

	// get each row from the history table for the job
	$sql2 = "SELECT * FROM job_history WHERE historyid IN(SELECT historyid FROM jobs_to_history WHERE jobid = '$jobid') ORDER BY timestamp DESC;";
	//echo $sql2;
	$res2 = mysqli_query($con,$sql2);
echo'
<table id="jobHistory" class="" align="center">
	<thead>
		<tr class = "blue-row">

			<th class = "asset-list"><strong>Complete</strong></th>
			<th class = "asset-list"><strong>Job Type</strong></th>
			<th class = "asset-list"><strong>Job Description</strong></th>
			<th class = "asset-list"><strong>Job Status</strong></th>
			<th class = "asset-list"><strong>Due Date</strong></th>
			<th class = "asset-list"><strong>Updated</strong></th>
			<th class = "asset-list"><strong>Sage Reference</strong></th>
			<th class = "asset-list"><strong>PO Number</strong></th>
			<th class = "asset-list"><strong>Job Number</strong></th>
			<th class = "asset-list"><strong>Assets</strong></th>
			<th class = "asset-list"><strong>Notes</strong></th>
			<th class = "asset-list"><strong>Updated By</strong></th>
		</tr>
	</thead>
<tbody>';


//foreach ($result1 as $r1){
	//$historyid = $r1['historyid'];

	//$row1= mysqli_fetch_assoc($res1);
	$result2 = array();

	while($row = mysqli_fetch_array($res2)){
		array_push($result2,
			array('historyid'=>$row[0],
			'complete'=>$row[1],
			'job_type'=>$row[2],
			'job_description'=>$row[3],
			'job_status'=>$row[4],
			'due_date'=>$row[5],
			'updated_date'=>$row[6],
			'sage_reference'=>$row[7],
			'po_number'=>$row[8],
			'job_number'=>$row[9],
			'number_of_assets'=>$row[10],
			'notes'=>$row[11],
			'updated_by'=>$row[12]
		));
	} //print_r (array_values($result2));
	
	
	//outputting the rows of data for the table
	
//this variable is used to pick the row colour
$i = 1;		
foreach ($result2 as $r2){
		if (1 != $i % 2){
			$rowClass = 'blue-row';
		}else{
			$rowClass = 'white-row';
		} 
	$i ++;
		
	echo '<tr class = "' .$rowClass. '">';
		if($r2['complete'] == 0){
			$done = 'No';
		}else{
			$done = 'Yes';
		}
	
	$dueDate = $r2['due_date'];
	$dueDate = date("d/m/Y", strtotime($dueDate));
	
	$updatedDate = $r2['updated_date'];
	$updatedDate = date("d/m/Y", strtotime($updatedDate));
	
	echo'
	<td>'.$done.'</td>
	<td>'.ucwords($r2['job_type']).'</td>
	<td>'.($r2['job_description']).'</td>
	<td>'.ucwords($r2['job_status']).'</td>
	<td>'.$dueDate.'</td>
	<td>'.$updatedDate.'</td>
	<td>'.ucwords($r2['sage_reference']).'</td>
	<td>'.ucwords($r2['po_number']).'</td>
	<td>'.ucwords($r2['job_number']).'</td>
	<td>'.ucwords($r2['number_of_assets']).'</td>
	<td>'.($r2['notes']).'</td>
	<td>'.ucwords($r2['updated_by']).'</td>
	</tr>';
}

echo'
	</tbody>
</table>';

mysqli_close($con);
?>