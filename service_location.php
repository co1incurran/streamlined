<link rel="stylesheet" href="__jquery.tablesorter/themes/blue/style_table.css">
<?php
if(isset($_POST['date1']) || isset($_POST['date2'])){
						if($_POST['date1'] != '' || $_POST['date2'] != ''){
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

			<th id = "first-table-column" class = "asset-list"><strong>County</strong></th>
			<th class = "asset-list"><strong>Trade</strong></th>
			<th class = "asset-list"><strong>Private</strong></th>

		</tr>
	</thead>
<tbody>
	<?php
		//get the current date
		$date = date('Y/m/d');
		
		
		foreach ($counties as $county){
			//NEED TO WORK ON THIS PART
			if(isset($_POST['date1']) || isset($_POST['date2'])){
				if($_POST['date1'] != '' || $_POST['date2'] != ''){
					//selects all the stock in each county that is for trade use (owned by a company)
					$sql = "SELECT stockid, installation_date, service_date, next_service FROM stock WHERE stockid IN(SELECT stockid FROM uses WHERE jobid IN (SELECT jobid FROM company_requires WHERE companyid IN(SELECT companyid FROM company WHERE county = '$county'))); ";
					//echo $sql;
					$res = mysqli_query($con,$sql);
					$tradeCount=mysqli_num_rows($res);
					
					//selects all the stock in each county that is for private use (owned by a private customer)
					$sql2 = "SELECT stockid, installation_date, service_date, next_service FROM stock WHERE stockid IN(SELECT stockid FROM uses WHERE jobid IN (SELECT jobid FROM customer_requires WHERE customerid IN(SELECT customerid FROM customer WHERE county = '$county'))); ";
					//echo $sql;
					$res2 = mysqli_query($con,$sql2);
					$privateCount=mysqli_num_rows($res2);
				}
			}
			
			/*//To get the number of assets
			$sql2 = "SELECT companyid, name, county FROM company WHERE companyid IN (SELECT companyid FROM company_requires WHERE jobid IN (SELECT jobid FROM uses WHERE stockid = '$stockid'));";
			//echo $sql2;
			$res2 = mysqli_query($con,$sql2);
			// Return the number of rows in result set
			$rowcount=mysqli_num_rows($res2);
			if($rowcount<1){
				$sql2 = "SELECT customerid, first_name, last_name, county FROM customer WHERE customerid IN (SELECT customerid FROM customer_requires WHERE jobid IN (SELECT jobid FROM uses WHERE stockid = '$stockid'));";
				$res2 = mysqli_query($con,$sql2);
				while ($row = mysqli_fetch_assoc($res2)) {
					$customerid =  $row["customerid"];
					$customerName = $row["first_name"].' '.$row["last_name"];
					$county =  $row["county"];
				}
			}else{
				while ($row = mysqli_fetch_assoc($res2)) {
					$companyid =  $row["companyid"];
					$companyName = $row["name"];
					$county =  $row["county"];
				}
			}*/

	?>
			<tr>	
				<!--<td><a href = "profile.php?customerid=<?php //echo $customerid;?>&companyid=0 " class="name"><?php //echo ucwords($results['first_name']).' '.ucwords($results['last_name']);?></a></td>-->
				<td><?php echo ucwords($county)?></td>
				<td><?php echo $tradeCount ?></td>
				<td><?php echo $privateCount ?></td>
				
			</tr>
	<?php
		}
		mysqli_close($con);
	?>
		</tbody>
	</table>