<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$jobid = $_GET['jobid'];

// get the history ID's linked to the job in question
$sql1 = "SELECT historyid FROM jobs_to_history WHERE jobid = '$jobid'; ";
$res1 = mysqli_query($con,$sql1);
//$row1= mysqli_fetch_assoc($res1);
$result1 = array();

while($row = mysqli_fetch_array($res1)){
	array_push($result1,
		array('historyid'=>$row[0]
	));
}
echo'
<table id="jobHistory" class="" align="center">
	<thead>
		<tr class = "blue-row">

			<th class = "asset-list"><strong>Done</strong></th>
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
//this variable is used to pick the row colour
$i = 1;

foreach ($result1 as $r1){
	$historyid = $r1['historyid'];
	// get each row from the history table for the job
	$sql2 = "SELECT * FROM job_history WHERE historyid = '$historyid' ;";
	echo $sql2;
	$res2 = mysqli_query($con,$sql2);
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
	}
	//outputting the rows of data for the table
	
		if (1 != $i % 2){
			$rowClass = 'blue-row';
		}else{
			$rowClass = 'white-row';
		} 
	$i ++;
	echo '<tr class = "' .$rowClass. '">
	<td>'.ucwords($row['complete']).'</td>
	<td>'.ucwords($row['job_type']).'</td>
	<td>'.ucwords($row['jod_description']).'</td>
	<td>'.ucwords($row['job_status']).'</td>
	<td>'.($row['due_date']).'</td>
	<td>'.($row['updated_date']).'</td>
	<td>'.ucwords($row['sage_reference']).'</td>
	<td>'.ucwords($row['po_number']).'</td>
	<td>'.ucwords($row['job_number']).'</td>
	<td>'.ucwords($row['number_of_assets']).'</td>
	<td>'.ucwords($row['notes']).'</td>
	<td>'.ucwords($row['updated_by']).'</td>
	</tr>';
}
echo'
	</tbody>
</table>';

mysqli_close($con);
?>