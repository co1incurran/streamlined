<?php
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
					<td class = "asset-list"><strong>Date</strong></td>
					<td class = "asset-list"><strong>Time</strong></td>
					<td class = "asset-list"><strong>Message</strong></td>
					</thead>
					<tbody>';


	echo '</tbody>
		</table>';
?>