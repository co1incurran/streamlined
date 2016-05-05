<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "userr");//remember to chanege these when all is working
define("DB_PASSWORD", "12345");
define("DB_DATABASE", "databasee");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);


$sql = "UPDATE workers SET first_name= $_POST['firstname']";

$res = mysqli_query($con,$sqlP);

mysqli_close($con);
?>