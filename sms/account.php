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
					<td class = "asset-list"><strong>Job Title</strong></td>
					<td class = "asset-list"><strong>Phone</strong></td>
					<td class = "asset-list"><strong>Mobile</strong></td>
					<td class = "asset-list"><strong>Email</strong></td>
					<td class = "asset-list"><strong>Fax</strong></td>
					<td class = "asset-list"><strong>Employer</strong></td>
					</thead>
					<tbody>';


	echo '</tbody>
		</table>';
?>