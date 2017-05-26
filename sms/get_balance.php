<?php
	include'../include/clickatell_account_details.php';
	 
	return file_get_contents("https://api.clickatell.com/http/getbalance"
	   . "?user=$username&password=$password&api_id=$api_id");
?>