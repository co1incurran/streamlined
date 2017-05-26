<?php
	include'../include/clickatell_account_details.php';
	 
	$apiMsgId = "place message ID here";
	 
	echo file_get_contents("https://api.clickatell.com/http/delmsg"
		. "?user=$username&password=$password&api_id=$api_id&apimsgid=$apiMsgId");
?>