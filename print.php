<?php

$date1 = $_GET["date1"];
$date2 = $_GET["date2"];
$oldDate1 = $_GET["oldDate1"];
$oldDate2 = $_GET["oldDate2"];
if(isset($_GET['checkbox'])){
	foreach($_GET['checkbox'] as $county) {
		echo $county.'<br>';
		//get the private customers names and phone numbers
		$sql1 = "SELECT first_name, last_name, mobile_phone_number FROM customer WHERE county = '$county' AND WHERE customerid IN(SELECT customerid FROM customer_requires WHERE jobid IN(SELECT jobid FROM uses WHERE stockid IN(SELECT stockid FROM stock WHERE next_service BETWEEN '$date1' AND '$date2' OR service_date BETWEEN '$oldDate1' AND '$oldDate2' )))";
		$sql2 = "SELECT stockid, installation_date, service_date, next_service FROM stock WHERE next_service BETWEEN '$date1' AND '$date2' OR service_date BETWEEN '$oldDate1' AND '$oldDate2' AND stockid IN(SELECT stockid FROM uses WHERE jobid IN (SELECT jobid FROM customer_requires WHERE customerid IN(SELECT customerid FROM customer WHERE county = '$county'))); ";
		echo $sql1.'<br>';
	}
}
echo $date1.'<br>';
echo $date2.'<br>';
?>