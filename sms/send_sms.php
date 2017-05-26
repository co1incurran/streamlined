<?php
echo'<link rel="stylesheet" href="../__jquery.tablesorter/themes/blue/style_table.css">';
$url = $_SERVER['REQUEST_URI'];
$url = str_replace('&', '%26', $url);

 echo'
	</hgroup>
	</header>
	<section class="panel-body" style = "width:100%">
		<table id="names" class="tablesorter filterable">
		<thead>
			<tr class = "blue-row">				
				<!--<th class = "asset-list"></th>-->
				<th id = "first-table-column" class = "asset-list"><strong>Company</strong></th>
				<th><strong>Address</strong></th>
				<th><strong>City</strong></th>
				<th><strong>County</strong></th>
				<th><strong>Phone Number</strong></th>
				<th><strong>Last Contacted</strong></th>
				<th><strong>Sector </strong></th>
				<th><strong>Assets </strong></th>			
			</tr>
		</thead>
		
		<tbody>
		<tr class="whittttte-row">				
				<!--<th class = "asset-list"></th>-->
				<th id = "first-table-column" class = "asset-list"><strong>Company</strong></th>
				<th><strong>Address</strong></th>
				<th><strong>City</strong></th>
				<th><strong>County</strong></th>
				<th><strong>Phone Number</strong></th>
				<th><strong>Last Contacted</strong></th>
				<th><strong>Sector </strong></th>
				<th><strong>Assets </strong></th>			
			</tr>';
	/*$sql = "SELECT * FROM sms ORDER BY id DESC; ";
	$res = mysqli_query($con,$sql);
	$result = array();

	while($row = mysqli_fetch_array($res)){
		array_push($result,
			array('id'=>$row[0],
			'name'=>$row[1],
			'message'=>$row[2]
		));
	}

foreach ($result as $r){
	echo'
	<tr>
		<td></td>
		<td><a href = "edit_template.php?id='.$r['id'].'&url='.$url.'&name='.$r['name'].'&message='.$r['message'].'" class="name">'.ucwords($r['name']).'</a></td>
		<td>'.$r['message'].'</td>
	</tr>';
}*/
echo '</tbody>
	</table>';
?>