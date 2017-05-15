<?php
	define("DB_HOST", "127.0.0.1");
	define("DB_USER", "user");
	define("DB_PASSWORD", "1234");
	define("DB_DATABASE", "database");

	//echo $sql;
	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
	
	$output = '';
	if(isset($_POST["export_excel"])){
		$sql = "SELECT jobid, job_type, job_description, job_status FROM jobs ORDER BY jobid DESC";
		$result = mysqli_query($con,$sql);
		
		if(mysqli_num_rows($result)>0){
			$output = '
				<table>
					<tr>
						<th>ID</th>
						
						<th>Type</th>
						
						<th>Description</th>
						
						<th>Status</th>
					</tr>
			';
			while($row = mysqli_fetch_array($result)){
				$output .= '
					<tr>
						<td>'.$row["jobid"].'</td>
						<td>'.$row["job_type"].'</td>
						<td>'.$row["job_description"].'</td>
						<td>'.$row["job_status"].'</td>
					</tr>
				';
			}
			//print_r (array_values($result));
			$output .= '</table>';
			header("Content-Type: application/xls");
			header("Content-Disposition: attachment; filename=jobs.xls");
			echo $output;
		}
	}
	
	//close connection
	mysqli_close($con);
?>