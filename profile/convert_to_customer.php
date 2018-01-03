<?php
include'../include/session.php';
if(isset($_GET['url'])){
	$url= $_GET['url'];
}

//if(isset($_GET['type'])){
	//$type= $_GET['type'];
//}
					
if(isset($_GET['customerid'])){
	$customerid= $_GET['customerid'];
	echo $customerid;
}

echo'
<!DOCTYPE html>
<html>
	<head>
	<title>Add task</title>
	<link href="../css/elements.css" rel="stylesheet">
	<script src="../js/popup.js"></script>
	</head>
<!-- Body Starts Here -->
	<body>
	<div id="body" style="overflow:hidden;">
		<div id="abc">
			<!-- Popup Div Starts Here -->
			<div id="popupContact">
			<!-- Contact Us Form -->
				<form action="convert_customer.php" id="form" method="post" name="form">
					<!--<img id="close" src="images/3.png" onclick ="div_hide()">-->
					<h2>Convert lead to customer?</h2>
					<hr>';					
					if(isset($customerid)){
						echo '<input type="hidden" name="customerid" id="customerid" value="'.$customerid.'">';
					}
					
					if(isset($url)){
						echo '<input type="hidden" name="url" id="url" value="'.$url.'">';
					}
					
					echo'				
					<input type="submit" id="submit" value="Yes">
					<!--<a href="javascript:%20check_empty()" id="submit">Yes</a>-->
					<a onclick="goBack()" id="submit">Cancel</a>
				</form>
			</div>
		<!-- Popup Div Ends Here -->
		</div>
	</div>
	</body>
	<script type="text/javascript">
	window.onload = div_show();
	</script>
	
<!-- Body Ends Here -->
</html>';

?>