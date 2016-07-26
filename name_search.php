<?php

define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

//get all the company names
$sql = "SELECT companyid, name FROM company; ";
//echo $sql;

$res = mysqli_query($con,$sql);
$result = array();
//put all the company names and ids into an array
while($row = mysqli_fetch_array($res)){
	array_push($result,
		array('companyid'=>$row[0],
		'name'=>$row[1]
	));
}
//print_r (array_values($result));

////////////////////////////////////////////////////////////////////////////

//get all the private customers names
$sql2 = "SELECT customerid, first_name, last_name FROM customer; ";
//echo $sql;

$res2 = mysqli_query($con,$sql2);
$result2 = array();
//put all the customer names and ids into an array
while($row2 = mysqli_fetch_array($res2)){
	array_push($result2,
		array('customerid'=>$row2[0],
		'first_name'=>$row2[1],
		'last_name'=>$row2[2]
	));
}
//print_r (array_values($result2));

/////////////////////////////////////////////////////////////////////////////

//get all the workers names
$sql3 = "SELECT workerid, first_name, last_name FROM workers; ";
//echo $sql;

$res3 = mysqli_query($con,$sql3);
$result3 = array();
//put all the customer names and ids into an array
while($row3 = mysqli_fetch_array($res3)){
	array_push($result3,
		array('workerid'=>$row3[0],
		'first_name'=>$row3[1],
		'last_name'=>$row3[2]
	));
}
print_r (array_values($result3));

echo'
<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<div id="users">
		  <input class="search" placeholder="Search" />
		  <button class="sort" data-sort="name">
			Sort by name
		  </button>

		  <ul class="list">
			<li>
			  <h3 class="name">Jonny Stromberg</h3>
			  <p class="born">1986</p>
			</li>
			<li>
			  <h3 class="name">Jonas Arnklint</h3>
			  <p class="born">1985</p>
			</li>
			<li>
			  <h3 class="name">Martina Elm</h3>
			  <p class="born">1986</p>
			</li>
			<li>
			  <h3 class="name">Gustaf Lindqvist</h3>
			  <p class="born">1983</p>
			</li>
		  </ul>

		</div>
		<script src="http://listjs.com/no-cdn/list.js"></script>
	</body>
</html>
<script>
var options = {
  valueNames: [ "name", "born" ]
};

var userList = new List("users", options);
</script>';

?>