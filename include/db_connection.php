<?php
	define("DB_HOST", "127.0.0.1");
	define("DB_USER", "user");
	define("DB_PASSWORD", "1234");
	define("DB_DATABASE", "database");
	
	/*define("DB_HOST", "178.62.103.171");
	define("DB_USER", "bhyjwznhrx");
	define("DB_PASSWORD", "fbCYsxKR2G");
	define("DB_DATABASE", "bhyjwznhrx");*/
	
	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
?>