<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);



$sql = "SELECT name FROM company; ";
$res = mysqli_query($con,$sql);
$result = array();


$sql2 = "SELECT first_name, last_name FROM customer; ";
$res2 = mysqli_query($con,$sql2);
$result2 = array();
 
while($row = mysqli_fetch_array($res)){
	array_push($result,
		array(
		'name'=>$row[0]
	));
}
// print_r (array_values($result));
 //echo '<br>';
while($row = mysqli_fetch_array($res2)){
	array_push($result2,
		array(
		'first_name'=>$row[0],
		'last_name'=>$row[1]
	));
} //print_r (array_values($result2));

foreach ($result2 as $r2){
	$customerName = $r2['first_name'].' '.$r2['last_name'];
	//echo $customerName. '<br>';
	array_push($result,
		array(
		'name'=>$customerName
	));
}

sort($result);
//print_r (array_values($result));
foreach ($result as $r) {
    echo' <option>'.ucwords($r['name']).'</option>';
}


mysqli_close($con);
?>