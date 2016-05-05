<<<<<<< HEAD
<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
 if($con == false){
    //try to reconnect
	echo'false';
}
$sql = "SELECT customerid, first_name, last_name, county, last_contacted FROM customer; ";
 
$res = mysqli_query($con,$sql);

$result = array();
 
while($row = mysqli_fetch_array($res)){
	array_push($result,
		array('customerid'=>$row[0],
		'first_name'=>$row[1],
		'last_name'=>$row[2],
		'county'=>$row[3],
		'last_contacted'=>$row[4]
	));
}

//Puts all the customer names in a table
//echo '<section class="panel-body">';
echo '<ul id="contacts" class="listing list-view clearfix">';

		foreach ($result as $results){
				
				//The lines below echo the names of the customers properly
			echo'<li class="company clearfix">
					<div class="clearfix">
					  <div class="avatar"><img src="images/circle-icons/64px/profle.png" width="32" height="32" /></div>';
					  //ucwods makes the first letter in the names capital
			$customerid = $results['customerid'];
			echo	 '<a href = "profile.php?customerid='.$customerid.'&companyid=0 " class="name">'. ucwords($results['first_name']) . ' ' . ucwords($results['last_name']) .'</a>';
			echo nl2br("\n");
			echo nl2br("\n");
			$date = $results['last_contacted'];
			$properDate = date("d-m-Y", strtotime($date));
			echo	 '<table id = "name-list">
						<tr class="name-list"><th><strong> Location:</strong></th><td>' . ucwords($results['county']) . '</td></tr>
						<tr class="name-list"><th><strong> Last Contacted:</strong></th><td>' . ($properDate) . '</td><tr>
					</table>';
			echo	'</div>
				</li>';
		}
echo '</ul>
</div>';
 
mysqli_close($con);
 
?>
=======
<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "enable_supplies_db");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
 
$sql = "SELECT customerid, first_name, last_name, county, last_contacted FROM customer; ";
 
$res = mysqli_query($con,$sql);
 
$result = array();
 
while($row = mysqli_fetch_array($res)){
	array_push($result,
		array('customerid'=>$row[0],
		'first_name'=>$row[1],
		'last_name'=>$row[2],
		'county'=>$row[3],
		'last_contacted'=>$row[4]
	));
}

//Puts all the customer names in a table
//echo '<section class="panel-body">';
echo '<ul id="contacts" class="listing list-view clearfix">';

		foreach ($result as $results){
				
				//The lines below echo the names of the customers properly
			echo'<li class="company clearfix">
					<div class="clearfix">
					  <div class="avatar"><img src="images/circle-icons/64px/profle.png" width="32" height="32" /></div>';
					  //ucwods makes the first letter in the names capital
			$customerid = $results['customerid'];
			echo	 '<a href = "profile.php?customerid='.$customerid.' " class="name">'. ucwords($results['first_name']) . ' ' . ucwords($results['last_name']) .'</a>';
			echo nl2br("\n");
			echo nl2br("\n");
			$date = $results['last_contacted'];
			$properDate = date("d-m-Y", strtotime($date));
			echo	 '<table id = "name-list">
						<tr class="name-list"><th><strong> Location:</strong></th><td>' . ucwords($results['county']) . '</td></tr>
						<tr class="name-list"><th><strong> Last Contacted:</strong></th><td>' . ($properDate) . '</td><tr>
					</table>';
			echo	'</div>
				</li>';
		}
echo '</ul>
</div>';
 
mysqli_close($con);
 
?>
>>>>>>> origin/master
