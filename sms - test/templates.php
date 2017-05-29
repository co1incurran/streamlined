<?php
$url = $_SERVER['REQUEST_URI'];
$url = str_replace('&', '%26', $url);

 echo'
	</hgroup>
	</header>
	<section class="panel-body" style = "width:100%">
		<table align="center">
			<thead><tr class = "blue-row">
			<td></td>
			<td class = "asset-list"><strong>Template Name</strong></td>
			<td class = "asset-list"><strong>Message</strong></td>
			</thead>
			<tbody>';
	$sql = "SELECT * FROM sms ORDER BY id DESC; ";
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
}
echo '</tbody>
	</table>';
?>