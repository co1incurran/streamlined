<?php 

//print_r($_POST['numbers']);
$nums = array();
if(isset($_POST['numbers'])){
	foreach($_POST['numbers'] as $n) {
		//this adds the international calling prefix to the number (ie 353)
		$n = preg_replace('/^0/','353',$n);
				array_push($nums,
				urlencode($n)
				);
			}
	print_r (array_values($nums));
}

	$username = urlencode("colin.c");
	$password = urlencode("SKDcGDUSMfLHAB");
	$api_id = urlencode("3619671");
	//$number = $_POST['mobilenumber'];
	//$toList = array(urlencode("353851084442"),urlencode("number 3"));
	//$toList = array(urlencode($number),urlencode("number 2"),urlencode("number 3"));
	 
	$to = implode(',', $nums);
	$message = "message";
	//$message = $_POST['message'];
	$message = urlencode($message);
	echo file_get_contents("https://api.clickatell.com/http/sendmsg" . "?user=$username&password=$password&api_id=$api_id&to=$to&text=$message");

?>