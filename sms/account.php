<?php
$url = $_SERVER['REQUEST_URI'];
$url = str_replace('&', '%26', $url);

 echo'
			</hgroup>
			</header>
			<section class="panel-body" style = "width:100%">';
			include'get_balance.php';
				
?>