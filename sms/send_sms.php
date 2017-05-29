<link rel="stylesheet" href="../__jquery.tablesorter/themes/blue/style_table.css">
<?php

$url = $_SERVER['REQUEST_URI'];
$url = str_replace('&', '%26', $url);
echo'<style>
		* {
		  box-sizing: border-box;
		}

		#myInput {
		  background-image: url("/css/searchicon.png");
		  background-position: 10px 10px;
		  background-repeat: no-repeat;
		  width: 100%;
		  font-size: 16px;
		  padding: 12px 20px 12px 40px;
		  border: 1px solid #ddd;
		  margin-bottom: 12px;
		}';

	/*	#myTable {
		  border-collapse: collapse;
		  width: 100%;
		  border: 1px solid #ddd;
		  font-size: 18px;
		}

		#myTable th, #myTable td {
		  text-align: left;
		  padding: 12px;
		}

		#myTable tr {
		  border-bottom: 1px solid #ddd;
		}

		#myTable tr.header, #myTable tr:hover {
		  background-color: #f1f1f1;
		}*/
		echo'
		</style>
		</head>
		<body>

		<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names...." title="Type in a name">';
		
		//get all the company names
/*$sql = "SELECT companyid, name FROM company; ";
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
print_r (array_values($result));*/

////////////////////////////////////////////////////////////////////////////

//get all the private customers names
$sql2 = "SELECT customerid, first_name, last_name, mobile_phone_num, county FROM customer; ";
//echo $sql;

$res2 = mysqli_query($con,$sql2);
$result2 = array();
//put all the customer names and ids into an array
while($row2 = mysqli_fetch_array($res2)){
	array_push($result2,
		array('customerid'=>$row2[0],
		'first_name'=>$row2[1],
		'last_name'=>$row2[2],
		'mobile_phone_num'=>$row2[3],
		'county'=>$row2[4]
	));
}
//print_r (array_values($result2));

/////////////////////////////////////////////////////////////////////////////

//get all the workers names
$sql3 = "SELECT workerid, first_name, last_name, mobile_phone_num FROM workers; ";
//echo $sql;

$res3 = mysqli_query($con,$sql3);
$result3 = array();
//put all the customer names and ids into an array
while($row3 = mysqli_fetch_array($res3)){
	array_push($result3,
		array('workerid'=>$row3[0],
		'first_name'=>$row3[1],
		'last_name'=>$row3[2],
		'mobile_phone_num'=>$row3[3]
	));
}
//print_r (array_values($result3));



//this is where i put all the contents of the 3 above arrays into one large array
$bigArray = array();
//putting in the companies
/*foreach ($result as $r1){
	$type = 'company';
	$id = $r1['companyid'];
	$name = $r1['name'];
	array_push($bigArray,
		array('type' => $type,
		'id' => $id,
		'name' => $name
	));
}*/
//putting in the private customers
foreach($result2 as $r2){
	$type = 'privatecustomer';
	$id = $r2['customerid'];
	$name = $r2['first_name'].' '.$r2['last_name'];
	$number = $r2['mobile_phone_num'];
	$county = $r2['county'];
	
	array_push($bigArray,
		array('type' => $type,
		'id' => $id,
		'name' => $name,
		'number' => $number,
		'county' => $county
	));
}
//putting in the workers
foreach($result3 as $r3){
	$workerid = $r3['workerid'];
	$sql4 ="SELECT name, county FROM company WHERE companyid IN(SELECT companyid FROM works_with WHERE workerid = '$workerid');";
	$res4 = mysqli_query($con,$sql4);
	$row = mysqli_fetch_assoc($res4);
	$companyName = $row['name'];
	$companyCounty = $row['county'];
	$workerNumber = $r3['mobile_phone_num'];
	//echo $companyName;
	$type = 'worker';
	$id = $r3['workerid'];
	$name = $r3['first_name'].' '.$r3['last_name'].' - '.ucwords($companyName);
	
	//$name = preg_replace_callback('/O\'[a-z]', 'strtoupper("$0")', $name);
	array_push($bigArray,
		array('type' => $type,
		'id' => $id,
		'name' => $name,
		'number' => $workerNumber,
		'county' => $companyCounty
	));
}

function compareByName($a, $b) {
  return strcmp($a["name"], $b["name"]);
}
usort($bigArray, 'compareByName');
/* The next line is used for debugging, comment or delete it after testing */
//print_r($bigArray);

echo'<table id="myTable">
		<thead>
			<tr class = "blue-row">				
				<th><strong>Name</strong></th>
				<th><strong>Number </strong></th>
				<th><strong>County </strong></th>			
			</tr>
		</thead>
		
		<tbody>';
foreach($bigArray as $b){
	echo'<tr>
			<td>'.$b['name'].'</td>
			<td>'.$b['number'].'</td>
			<td>'.$b['county'].'</td>	
		</tr>';
}
echo'</tbody>
	</table>';


//asort($bigArray);
//print_r (array_values($bigArray));

		/*<table id="myTable">
		  <tr class="header">
			<th style="width:60%;">Name</th>
			<th style="width:40%;">Country</th>
		  </tr>
		  <tr>
			<td>Alfreds Futterkiste</td>
			<td>Germany</td>
		  </tr>
		  <tr>
			<td>Berglunds snabbkop</td>
			<td>Sweden</td>
		  </tr>
		  <tr>
			<td>Island Trading</td>
			<td>UK</td>
		  </tr>
		  <tr>
			<td>Koniglich Essen</td>
			<td>Germany</td>
		  </tr>
		  <tr>
			<td>Laughing Bacchus Winecellars</td>
			<td>Canada</td>
		  </tr>
		  <tr>
			<td>Magazzini Alimentari Riuniti</td>
			<td>Italy</td>
		  </tr>
		  <tr>
			<td>North/South</td>
			<td>UK</td>
		  </tr>
		  <tr>
			<td>Paris specialites</td>
			<td>France</td>
		  </tr>
		</table>*/
echo'
		<script>
		function myFunction() {
		  var input, filter, table, tr, td, i;
		  input = document.getElementById("myInput");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("myTable");
		  tr = table.getElementsByTagName("tr");
		  for (i = 0; i < tr.length; i++) {
		  td = tr[i].getElementsByTagName("td")[0];
		  td2 = tr[i].getElementsByTagName("td")[1];
			
			if (td || td2)  {
			  if (td.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";
			  } else {
				tr[i].style.display = "none";
			  }
			}
		  }
		}
		</script>';
?>