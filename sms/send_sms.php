<script type="text/javascript">
//this is for checking all the boxes when the top checkbox is pressed
function checkAll(bx) {
  var cbs = document.getElementsByTagName('input');
  for(var i=0; i < cbs.length; i++) {
    if(cbs[i].type == 'checkbox') {
      cbs[i].checked = bx.checked;
    }
  }
}

</script>
<?php

$url = $_SERVER['REQUEST_URI'];
$url = str_replace('&', '%26', $url);
echo'<style>
		* {
		  box-sizing: border-box;
		}

		#myInput {
		  background-image: url("../css/search.png");
		  background-position: 10px 10px;
		  background-repeat: no-repeat;
		  width: 100%;
		  font-size: 16px;
		  padding: 12px 20px 12px 40px;
		  border: 1px solid #ddd;
		  margin-bottom: 12px;
		}
		</style>
		</head>
		<body>

		<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names...." title="Type in a name">';


//get all the private customers names
$sql2 = "SELECT customerid, first_name, last_name, mobile_phone_num, county FROM customer WHERE mobile_phone_num != ''; ";
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

//get all the workers names
$sql3 = "SELECT workerid, first_name, last_name, mobile_phone_num FROM workers WHERE mobile_phone_num != ''; ";
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
				<td id = "checkbox"><input type="checkbox" onclick="checkAll(this)"></td>
				<th><strong>Name</strong></th>
				<th><strong>Number </strong></th>
				<th><strong>County </strong></th>			
			</tr>
		</thead>
		
		<tbody>';
foreach($bigArray as $b){
	echo'<tr>
			<td id = "checkbox"><input type="checkbox" name="checkbox[]" value ="'.$b['type'].'-'.$b['id'].'" /></td>
			<td>'.ucwords($b['name']).'</td>
			<td>'.$b['number'].'</td>
			<td>'.ucwords($b['county']).'</td>	
		</tr>';
}


echo        	'<input type="submit" value="Next">
			</form>
		</tbody>
	</table>

	<script>
	<!-- this is the code for the search bar in the "send sms" page -->
		function myFunction() {
		  var input, filter, table, tr, td, i;
		  input = document.getElementById("myInput");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("myTable");
		  tr = table.getElementsByTagName("tr");
		  for (i = 0; i < tr.length; i++) {
		  td = tr[i].getElementsByTagName("td")[1];
		  td2 = tr[i].getElementsByTagName("td")[2];
		  td3 = tr[i].getElementsByTagName("td")[3];
			if (td || td2 || td3)  {
			  if (td.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1 || td3.innerHTML.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";
			  } else {
				tr[i].style.display = "none";
			  }
			}
		  }
		}
	</script>';
?>