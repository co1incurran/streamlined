<?php
	include'../include/session.php';
	include'../include/db_connection.php';

	$sql2 = "SELECT userid FROM users;";
	$res2 = mysqli_query($con,$sql2);
	$usernames = array();
	//$names = array("Colin", "Pat", "Mary");

	while($row = mysqli_fetch_array($res2)){
		$usernames[] = $row['userid'];
	}
	print_r (array_values($usernames));
	echo '<br>';
	//print_r (array_values($names));
	echo '<br>';
	mysqli_close($con);
	echo '<br>';
	if(isset ($_POST["username"])){
		$username = $_POST["username"];
		//$username = "Colin";
		echo $username;
		
		//get the name of the user and check if it is in the array
		if (in_array($username, $usernames)){
			echo " in array";
		}else{
			echo'<br>nope';
		}
	
	}

?>