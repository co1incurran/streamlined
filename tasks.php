<?php
//this is the session to ensure a user is logged in
	session_start();
	if(!isset ($_SESSION['username'])){
		header("location:index.html");
	}
	$userLoggedOn = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.3.js"></script> 
<!--<script type="text/javascript" src="__jquery.tablesorter/jquery.tablesorter.js"></script>-->
<!--<script type="text/javascript" src="table_filter/ddtf.js"></script>-->
<?php
if(isset($_GET['filter'])){
	echo'
	<script type="text/javascript" language="javascript" src="TableFilter/tablefilter.js"></script>';
}else{
	echo'
	<script type="text/javascript" src="__jquery.tablesorter/jquery.tablesorter.js"></script>';
}
?>

<script>$('#activityList').ddTableFilter();</script>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Enable Supplies - CRM System</title>

<!-- Compiled and minified Bootstrap CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- Compiled and minified FontAwesome CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

<link rel="stylesheet" media="screen" href="css/style.css" />

</head>

<script language="javascript" type="text/javascript">            
    var tf = setFilterGrid("#activityList");
</script> 
<body>
    <div id="wrapper">
        <header>
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="welcome.php">Enable Supplies</a>
                    </div>
					
					<?php
						define("DB_HOST", "127.0.0.1");
						define("DB_USER", "user");
						define("DB_PASSWORD", "1234");
						define("DB_DATABASE", "database");
						
						//this is used to check if there is new tasks assigned to the user 
						$sql = "SELECT * FROM activity WHERE complete = '0' AND new = '1' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid = '$userLoggedOn' AND created_by != '$userLoggedOn') ORDER BY creation_date; ";
						//echo $sql;
						$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

						$res = mysqli_query($con,$sql);
						$rowCount = mysqli_num_rows($res);
						if ($rowCount > 0){
							$amount = $rowCount;
							$iId = "task_notification_red";
						}else{
							$amount = '';
							$iId = '';
						}
						
						//this counts how many outbox tasks you have
						$sql2 = "SELECT COUNT(*) FROM activity WHERE complete = '0' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid != '$userLoggedOn' AND created_by = '$userLoggedOn');";
						//echo $sql2;
						$res2 = mysqli_query($con,$sql2);
						$row = mysqli_fetch_row($res2);
						$count = $row['0'];
						mysqli_close($con);
					?>
					
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul id="main-nav" class="nav navbar-nav">
							<li><a href="contacts.php"><i class="fa fa-book"></i>  Contacts </a></li>
							
                               <?php
								// this is used to make a notification icon in the tasks tab when a user gets new tasks
									echo '<li class="active"><a href="tasks.php"><i id = "'.$iId.'">'.$amount.' '.'</i><i id = "'.$iId.'" class="fa fa-inbox"></i> Tasks Inbox </a></li>'; 
								?>
								<li><a href="tasks_outbox.php"><i id = "outbox-counter"><?php echo $count.' '; ?></i><i class="fa fa-sign-out"></i> Tasks Outbox </a></li>
                                <li><a href="jobs.php"><i class="fa fa-wrench"></i> Jobs</a></li>
								<li><a href="projects.php"><i class="fa fa-pie-chart"></i> Projects</a></li>
                            <li class="dropdown">
                                <a href="#" id = "logout" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><!--<i class="fa fa-cog"></i>--> <?php echo $userLoggedOn.' '; ?><span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Account</a></li>
                                    <li><a href="#">Users</a></li>
                                    <li><a href="#">Groups</a></li>
                                    <li><a href="logout.php">Log out</a></li>
                                </ul>
                            </li>
							<li><a></a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <section>
            <div class="container">
                <div class="row">

                  
                    <!-- Main Section -->
    
                    <section class="col-md-9 no-padding">
                        <div class="main-section">
                        
                            <div class="container-fluid no-padding">
                                <div class="col-md-7 no-padding">
                                    <div class="main-content panel panel-default no-margin">
                                        <header class="panel-heading clearfix">

                                            <div class="btn-group pull-right">
                                                <a href="calendar.html" class="btn btn-default" data-toggle="tooltip" title="View the Task Calendar"><i class="fa fa-calendar"></i></a></li>
                                            </div>
											<div class="btn-group pull-right" id="filter-button">
												<?php
												$url = $_SERVER['REQUEST_URI'];
												//$url = str_replace('&', '%26', $url);
												if(isset($_GET['filter'])){
													if(isset($_GET['status'])){
														$link = substr($url, 0, strrpos($url, "&filter"));
														//echo $link.'1';
													}else{
														$link = substr($url, 0, strrpos($url, "?filter"));
														//echo $link.'2';
													}
													echo'<a href="'.$link.'" class="btn btn-default" data-toggle="tooltip" title="View as a List" ><i class="fa fa-filter"></i></a>';
												}else{
													if(isset($_GET['status'])){
														if(isset ($_GET['filter'])){
															$link = substr($url, 0, strrpos($url, "&filter"));
														
															//echo $link.'3'.$url;
															echo'
															<a href="'.$link.'&filter=set" class="btn btn-default" data-toggle="tooltip" title="View as a List" ><i class="fa fa-filter"></i></a>';
														}else{
															echo'
															<a href="'.$url.'&filter=set" class="btn btn-default" data-toggle="tooltip" title="View as a List" ><i class="fa fa-filter"></i></a>';
														}
													}else{
														$link = substr($url, 0, strrpos($url, "?filter"));
														//echo $link.'4';
														echo'
														<a href="'.$link.'?filter=set" class="btn btn-default" data-toggle="tooltip" title="View as a List" ><i class="fa fa-filter"></i></a>';
													}
												}
												//echo $url;
												?>
                                            </div>
                                            <div class="view-switcher">
											<?php
											
											//check that the user is admin so that they can use the global view of the tasks
												$sqlAdmin = "SELECT department FROM users WHERE userid = '$userLoggedOn';";
												//echo $sqlAdmin;
												$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
												$res2 = mysqli_query($con,$sqlAdmin);
												$row = mysqli_fetch_assoc($res2);
												$type = $row['department'];
												if($type == 'admin'){
													$admin =true;
												}else{
													$admin =false;
												}
											
											
											
											if(isset($_GET['status'])){
												$status = $_GET['status'];
												if($status == 'all'){
													$setter = 'All My Tasks';
												}elseif($status == 'global' && $admin ==true ){
													$setter = 'Global - To do';
												}elseif($status == 'globalcomplete' && $admin ==true ){
													$setter = 'Global - Done';
												}
												elseif($status == 'today'){
													$setter = "Today's Tasks";
												}elseif($status == 'tomorrow'){
													$setter = "Tomorrow's Tasks";
												}elseif($status == 'week'){
													$setter = "This Week's Tasks";
												}elseif($status == 'month'){
													$setter = "This Month's Tasks";
												}elseif($status == 'overdue'){
													$setter = 'Over Due Tasks';
												}elseif($status == 'completed'){
													$setter = 'Completed Tasks';
												}else{
													$setter = 'All My Tasks';
												}
											}else{
													$setter = 'All My Tasks';
												}
												
												
											?>
                                                <h2><?php echo $setter; ?> <a href="#"> &darr; </a></h2>
                                                <ul>
												<?php
													if($admin == true){
														echo '<li><a href="tasks.php?status=global">Global to do</a></li>
															<li><a href="tasks.php?status=globalcomplete">Global done</a></li>';
													}
													
												?>
                                                    <li><a href="tasks.php?status=all">My tasks</a></li>
                                                    <li><a href="tasks.php?status=today">Today</a></li>
                                                    <li><a href="tasks.php?status=tomorrow">Tomorrow</a></li>
                                                    <li><a href="tasks.php?status=week">This week</a></li>
                                                    <li><a href="tasks.php?status=month">This month</a></li>
													<li><a href="tasks.php?status=overdue">Over due</a></li>
													<li><a href="tasks.php?status=completed">Completed</a></li>
                                                </ul>
                                            </div>
                                        </header>

                                        <section class="panel-body">
										
										<?php
										$outbox = false;
										$url = $_SERVER['REQUEST_URI'];
										$url = str_replace('&', '%26', $url);
											if(isset($_GET['details'])) {
												$details = $_GET['details'];
												if($details === 'true'){
													$activityid = $_GET['activityid'];
													require_once 'task_details.php';
												}else{
													require_once 'task_list.php';
												}
											}else{
												
												require_once 'task_list.php';
											}
										?>
                                            
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>

                    <!-- Main Section End -->

                </div>
            </div>
            <div id="push"></div>
        </section>
    </div>
    
    <footer>
        <div id="footer-inner" class="container">
            <div>
                <span class="pull-right"><a href="#">Documentation</a> | <a href="#">Feedback</a></span>Last account activity from 127.0.0.1 - <a href="#">Details</a> | &copy; 2016. All rights reserved. Designed by Colin Curran
            </div>
        </div>
    </footer>


    <!-- render blocking scripts -->

    <!-- jQuery JS 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    <!-- Main Script -->
    <script src="js/global.js"></script>
	<script>
    $(document).ready(function() 
        { 
            $("#activityList").tablesorter(); 
        } 
    );
    </script>
	<script>$('#activityList').ddTableFilter();</script>
</body>
</html>