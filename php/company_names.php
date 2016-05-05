<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
 
$sql = "SELECT companyid, name, county FROM company; ";
 
$res = mysqli_query($con,$sql);
 
$result = array();
 
while($row = mysqli_fetch_array($res)){
	array_push($result,
		array('companyid'=>$row[0],
		'name'=>$row[1],
		'county'=>$row[2],
		'last_contacted'=>[3]
	));
}

//Puts all the company names in a table
//echo '<section class="panel-body">';
echo '<ul id="contacts" class="listing list-view clearfix">';

		foreach ($result as $results){
				
				//The lines below echo the names of the customers properly
			echo'<li class="company clearfix">
					<div class="clearfix">
					  <div class="avatar"><img src="images/circle-icons/64px/profle.png" width="32" height="32" /></div>';
					  //ucwods makes the first letter in the names capital
			$companyid = $results['companyid'];
			echo	 '<a href = "profile.php?customerid=0&companyid='.$companyid.' " class="name">'. ucwords($results['name']) .'</a>';
			echo nl2br("\n");
			echo nl2br("\n");
			//$date = $results['last_contacted'];
			//$properDate = date("d-m-Y", strtotime($date));
			echo	 '<table id = "name-list">
						<tr class="name-list"><th><strong> Location:</strong></th><td>' . ucwords($results['county']) . '</td></tr>
					</table>';
			echo	'</div>
				</li>';
				//<tr class="name-list"><th><strong> Last Contacted:</strong></th><td>' . ($properDate) . '</td><tr>
		}
echo '</ul>
</div>';
 
mysqli_close($con);
?>

