<?php
 $username = urlencode("colincurran");
 $password = urlencode("12345678a");
 $api_id = urlencode("3608086");
 //this is for sending to mutiple numbers
 $toList = array(urlencode("0851084442"),urlencode("1111111111"));
 
 $to = implode(',', $toList);
// $to = urlencode("353851084442");
 $message = urlencode("Test Message");
 
 echo file_get_contents("https://api.clickatell.com/http/sendmsg"
 . "?user=$username&password=$password&api_id=$api_id&to=$to&text=$message"); 
 ?>
