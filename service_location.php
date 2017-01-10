<link rel="stylesheet" href="__jquery.tablesorter/themes/blue/style_table.css">

<?php
//$date1 = $_GET['date1'];
//$date2 = $_GET['date2'];
/*if(isset($_POST['date1']) || isset($_POST['date2'])){
						if($_POST['date1'] != '' || $_POST['date2'] != ''){*/
//array of all the counties
$counties = array('antrim', 'armagh', 'carlow', 'cavan', 'clare', 'cork', 'derry', 'donegal', 'down', 'dublin', 'fermanagh', 'galway', 'kerry', 'kildare', 'kilkenny', 'laois', 'leitrim', 'limerick', 'longford', 'louth', 'mayo', 'meath', 'monaghan', 'offaly', 'roscommon', 'sligo', 'tipperary', 'tyrone', 'waterford', 'westmeath', 'wexford', 'wicklow');
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

/*$sql = "SELECT stockid, serialid, name, model, installation_date, service_date, next_service FROM stock; ";
 
$res = mysqli_query($con,$sql);

$result = array();
 
while($row = mysqli_fetch_array($res)){
	array_push($result,
		array('stockid'=>$row[0],
		'serialid'=>$row[1],
		'name'=>$row[2],
		'model'=>$row[3],
		'installation_date'=>$row[4],
		'service_date'=>$row[5],
		'next_service'=>$row[6]
	));
}*/
//print_r (array_values($result));

//Puts all the customer names in a table
//echo '<section class="panel-body">';
?>	 

	
<!-- ... -->
<table id="serviceList" class="tablesorter filterable" align="center">
	<thead>
		<tr class = "blue-row">
			<?php
				if(isset ($_GET['sms']) && $_GET['sms']=="set"){
					echo'<td id = "checkbox_header"><input type="checkbox" onclick="checkAll(this)"></td>';
				}
			?>
			<th id = "first-table-column" class = "asset-list"><strong>County</strong></th>
			<th class = "asset-list"><strong>Total</strong></th>
			<th class = "asset-list"><strong>Trade</strong></th>
			<th class = "asset-list"><strong>Private</strong></th>
			<th class = "asset-list"><strong>Overdue</strong></th>
		</tr>
	</thead>
<tbody>
	<?php
		//get the current date
		$currentDate = date("Y-m-d");
		//USED TO GET A DATE 1 YEAR AGO FROM TODAY
		$time = strtotime("-1 year", time());
		$date = date("Y-m-d", $time);
		
		//USED TO GET A DATE 1 YEAR FROM TODAY
		$time = strtotime("+1 year", time());
		$futureDate = date("Y-m-d", $time);
		
		if(isset($_GET['date1']) && $_GET['date1'] != ''){
			$date1 = $_GET['date1'];
		}else{
			$currentDate = date("Y-m-d");
			$date1 = $currentDate;
		}
		
		if(isset($_GET['date2']) && $_GET['date2'] != ''){
			$date2 = $_GET['date2'];
		}else{
			$time = strtotime("+3 months", time());
			$later = date("Y-m-d", $time);
			//echo $oneYearLater;
			$date2 = $later;
		}
		
		//get a year previous to date 1
		$time = new DateTime($date1);
		$oldDate1 = $time->modify('-1 year')->format('Y-m-d');
		
		//get a year previous to date 2
		$time2 = new DateTime($date2);
		$oldDate2 = $time2->modify('-1 year')->format('Y-m-d');
					
		//this makes the form for passing the details about the counties when you need to send out bulk messages 
		if(isset ($_GET['sms'])&& $_GET['sms']=="set"){
			echo'<form action="print.php" method ="POST">';
			//pass the dates here
			echo '<input type="hidden" name="date1" value="'.$date1.'">
			<input type="hidden" name="date2" value="'.$date2.'">
			<input type="hidden" name="oldDate1" value="'.$oldDate1.'">
			<input type="hidden" name="oldDate2" value="'.$oldDate2.'">';
		}
		
		foreach ($counties as $county){
			
					

					//echo $date1;
					//echo $date2;
					
					
					//THIS IS FOR THE TRADE STOCK																																			
					$sql = "SELECT stockid, installation_date, service_date, next_service FROM stock WHERE next_service BETWEEN '$date1' AND '$date2' OR service_date BETWEEN '$oldDate1' AND '$oldDate2' AND stockid IN(SELECT stockid FROM uses WHERE jobid IN (SELECT jobid FROM company_requires WHERE companyid IN(SELECT companyid FROM company WHERE county = '$county'))); ";
					//echo $sql.'</br>';
					
					//selects all the stock in each county that is for private use (owned by a private customer)
					$sql2 = "SELECT stockid, installation_date, service_date, next_service FROM stock WHERE next_service BETWEEN '$date1' AND '$date2' OR service_date BETWEEN '$oldDate1' AND '$oldDate2' AND stockid IN(SELECT stockid FROM uses WHERE jobid IN (SELECT jobid FROM customer_requires WHERE customerid IN(SELECT customerid FROM customer WHERE county = '$county'))); ";
					//echo $sql2.'<br>';
					
					
				/*}else{
					$date1 = '';
					$date2 = '';
					//echo $currentDate;
					//echo $futureDate;
					//$sql = "SELECT stockid, installation_date, service_date, next_service FROM stock WHERE service_date BETWEEN '$date' AND '$currentDate' OR next_service BETWEEN '$currentDate' AND '$futureDate'  AND stockid IN(SELECT stockid FROM uses WHERE jobid IN (SELECT jobid FROM company_requires WHERE companyid IN(SELECT companyid FROM company WHERE county = '$county'))); ";
					//echo $sql;
					$sql = "SELECT stockid, installation_date, service_date, next_service FROM stock WHERE stockid IN(SELECT stockid FROM uses WHERE jobid IN (SELECT jobid FROM company_requires WHERE companyid IN(SELECT companyid FROM company WHERE county = '$county'))) AND (service_date BETWEEN '$date' AND '$currentDate' OR next_service BETWEEN '$currentDate' AND '$futureDate'); ";
				//	echo $sql.'<br>';
					
					//selects all the stock in each county that is for private use (owned by a private customer)
					$sql2 = "SELECT stockid, installation_date, service_date, next_service FROM stock WHERE stockid IN(SELECT stockid FROM uses WHERE jobid IN (SELECT jobid FROM customer_requires WHERE customerid IN(SELECT customerid FROM customer WHERE county = '$county'))) AND (service_date BETWEEN '$date' AND '$currentDate' OR next_service BETWEEN '$currentDate' AND '$futureDate'); ";
					//echo $sql2.'<br>';

				}*/
				
					//this gets the overdue sevices of the trade stock
					$sql3 = "SELECT stockid, installation_date, service_date, next_service FROM stock WHERE next_service BETWEEN '$date' AND '$currentDate' OR service_date <= '$date' AND stockid IN(SELECT stockid FROM uses WHERE jobid IN (SELECT jobid FROM company_requires WHERE companyid IN(SELECT companyid FROM company WHERE county = '$county'))); ";
					//echo $sql3.'<br>';
				
				
					//this gets the overdue sevices of the private stock
					$sql4 = "SELECT stockid, installation_date, service_date, next_service FROM stock WHERE next_service BETWEEN '$currentDate' AND '$date' OR service_date <= '$date' AND stockid IN(SELECT stockid FROM uses WHERE jobid IN (SELECT jobid FROM customer_requires WHERE customerid IN(SELECT customerid FROM customer WHERE county = '$county'))); ";
					//echo $sql4.'<br>';
				
					//echo $sql;
					$res = mysqli_query($con,$sql);
					$tradeCount=mysqli_num_rows($res);
					
					$res2 = mysqli_query($con,$sql2);
					$privateCount=mysqli_num_rows($res2);
					
					$res3 = mysqli_query($con,$sql3);
					$tradeOverdueCount=mysqli_num_rows($res3);
					
					$res4 = mysqli_query($con,$sql4);
					$privateOverdueCount=mysqli_num_rows($res4);

			echo'
			<tr>';
			if(isset ($_GET['sms']) && $_GET['sms']=="set"){
				echo'<td id = "checkbox"><input type="checkbox" name="checkbox[]" value ="'.$county.'" /></td>';
			}
		?>
				<td><?php echo '<a href = "services.php?county='.$county.'&type=all&date1='.$date1.'&date2='.$date2.'"><u>'.ucwords($county).'</u></a>'.'<br>';
				//echo $date1.'hi '.$date2;?></td>
				<td><?php echo $tradeCount+$privateCount ?></td>
				<td><?php echo $tradeCount ?></td>
				<td><?php echo $privateCount ?></td>
				<td><?php echo '<a href = "services.php?county='.$county.'&type=all&date1='.$date1.'&date2='.$date2.'&overdue=yes"><u>'.($tradeOverdueCount + $privateOverdueCount).'</u></a>';?></td>
			</tr>
			
	<?php
		}
		if(isset ($_GET['sms'])&& $_GET['sms']=="set"){
			echo'<input type="submit" value="Next">
				</form>';
		}
		mysqli_close($con);
	?>
		</tbody>
	</table>