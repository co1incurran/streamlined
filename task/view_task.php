<?php
include'../include/session.php';
include'../include/db_connection.php';

$activityid = $_POST['activityid'];
$sql = "UPDATE activity SET new = '0' WHERE activityid = '$activityid';";
$res = mysqli_query($con,$sql);
mysqli_close($con);

  header("Location: tasks.php");
  exit();

?>