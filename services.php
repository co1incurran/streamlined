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
<?php
if(isset($_GET['filter'])){
	echo'
	<script type="text/javascript" language="javascript" src="TableFilter/tablefilter.js"></script>';
}else{
	echo'
	<script type="text/javascript" src="__jquery.tablesorter/jquery.tablesorter.js"></script>';
}
?>

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
						//echo $rowCount;
					?>
					
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul id="main-nav" class="nav navbar-nav">
							<li><a href="contacts.php"><i class="fa fa-book"></i>  Contacts </a></li>
							
                               <?php
								// this is used to make a notification icon in the tasks tab when a user gets new tasks
									echo '<li><a href="tasks.php"><i id = "'.$iId.'">'.$amount.' '.'</i><i id = "'.$iId.'" class="fa fa-inbox"></i> Tasks Inbox </a></li>'; 
								?>
							<li><a href="tasks_outbox.php"><i id = "outbox-counter"><?php echo $count.' '; ?></i><i class="fa fa-sign-out"></i> Tasks Outbox </a></li>
							<li><a href="jobs.php"><i class="fa fa-wrench"></i> Jobs</a></li>
							<li class="active"><a href="services.php"><i class="fa fa-medkit"></i> Services</a></li>
							<li><a href="projects.php"><i class="fa fa-pie-chart"></i> Projects</a></li>
							<li><a href="sms.php"><i class="fa fa-comment"></i> SMS</a></li>
                            <li class="dropdown">
                               <a href="#" id = "logout" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><!--<i class="fa fa-cog"></i>--> <?php echo $userLoggedOn.' '; ?><span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Account</a></li>
                                    <li><a href="#">Users</a></li>
                                    <li><a href="#">Groups</a></li>
                                    <li><a href="logout.php">Log out</a></li>
                                </ul>
                            </li>
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
										
											<div class="btn-group pull-right" id="filter-button">
												<?php
												$url = $_SERVER['REQUEST_URI'];
												if(isset($_GET['filter'])){
													if(isset($_GET['type'])){
														$link = substr($url, 0, strrpos($url, "&filter"));
														//echo $link.'1';
													}else{
														$link = substr($url, 0, strrpos($url, "?filter"));
														//echo $link.'2';
													}
													echo'<a href="'.$link.'" class="btn btn-default" data-toggle="tooltip" title="View as a List" ><i class="fa fa-filter"></i></a>';
												}else{
													if(isset($_GET['type'])){
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
												if(isset ($_GET['type'])){
													$type = $_GET['type'];
													if($type == 'service'){
														$setter = 'Services';
													}elseif($type == 'inspection'){
														$setter = 'Inspections';
													}
													else{
														$setter= 'Services';
													}
												}else{
													$setter= 'Services';
												}
											?>
                                                <h2 class="panel-title"><?php echo $setter; ?> <a href="#">&darr;</a></h2>
                                                <ul>
                                                    
                                                    <li><a href="services.php?type=service">Services&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
													<li><a href="services.php?type=inspection">Inspections </a></li>
                                                    
                                                </ul>
                                            </div>
											<?php
												//this is for getting the status to bput in the action part of the form below
														$value = '';
														if(isset($_GET['status'])){
															$value = $_GET['status'];
														}
													echo'
													<div id = "date-picker">
														<form action="services.php?status='.$value.'" id="form" method="get" name="form">
														<label for="date1"><small>From</small></label>';
														
															if(isset($_GET['date1']) && $_GET['date1'] != ''){
																echo'<input id="date1" name="date1"  value = "'.$_GET['date1'].'" type="date" required>';
															}else{
																echo'<input id="date1" name="date1" type="date" required>';
															}
														
														echo'
														<label for="date2"><small>To</small></label>';
														
															if(isset($_GET['date2']) && $_GET['date2'] != ''){
																echo'<input id="date2" name="date2"  value = "'.$_GET['date2'].'" type="date" required>';
															}else{
																echo'<input id="date2" name="date2" type="date" required>';
															}
														echo'
														<button class="btn btn-default" data-toggle="tooltip" title="View the Task Calendar" type = "submit"><i class="fa fa-share" aria-hidden="true"></i></button>
														</form>
													</div>';
												
											?>
                                        </header>
										
                                        <section class="panel-body">
										
											<?php
												//check which php file to load
												if(isset ($_GET['type'])){
													$type = $_GET['type'];
												
													if($type == 'service'){
														//echo 'customer names';
														require_once 'service_location.php';
													}elseif ($type == 'inspection'){
														// get the list of leads
														require_once 'inspection_list.php';
													}elseif($type == 'all'){
														require_once 'service_details.php';
													}
													else{
														require_once 'service_location.php';
													}
												}else{
														require_once 'service_location.php';
												}
											?>
											
                                        </section>
                                    </div>
                                </div>
								
                                <div class="preview-pane col-md-5">
                                    <div class="content">
                                        <div class="message info">
                                        </div>
                                    </div>
                                    <!--<div class="preview clearfix">-->
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
	

    <!-- jQuery JS -->
	
	
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    <!-- Main Script -->
    <script src="js/global.js"></script>
	<script>
    $(document).ready(function() 
        { 
            $("#companyNames").tablesorter(); 
        } 
    );
    </script>
<script>
    $(document).ready(function() 
        { 
            $("#serviceList").tablesorter(); 
        } 
    );
    </script>
</body>
</html>