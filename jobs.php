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
<script type="text/javascript" src="__jquery.tablesorter/jquery.tablesorter.js"></script>
<!--<script type="text/javascript" src="table_filter/ddtf.js"></script>-->

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Enable Supplies - CRM System</title>

<!-- Compiled and minified Bootstrap CSS  i dont know what to do for this stupid filter thing.... its really annoyin-->
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
    
                  
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul id="main-nav" class="nav navbar-nav">
							 <li><a href="contacts.php"><i class="fa fa-book"></i>  Contacts </a></li>
                                <li><a href="tasks.php"><i class="fa fa-inbox"></i> Tasks Inbox </a></li>
								<li><a href="tasks_outbox.php"><i class="fa fa-sign-out"></i> Tasks Outbox </a></li>
                                <li class="active"><a href="jobs.php"><i class="fa fa-wrench"></i> Jobs</a></li>
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
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        
        <section>
            <div class="container">
                <div class="row">

                    <!-- Sidebar 
    
                    <aside class="col-md-3 no-padding">
    
                        <nav class="global">
                            <ul class="nav nav-pills nav-stacked">
                              <li><a href="dashboard.html"><i class="fa fa-home"></i> Overview</a></li>
                                <li><a href="activity.html"><i class="fa fa-heartbeat"></i> Latest Activity</a></li>
                                <li><a href="contacts.php"><i class="fa fa-book"></i>  Contacts </a></li>
                                <li ><a href="tasks.php"><i class="fa fa-tasks"></i> Tasks </a></li>
                                <li class="active"><a href="jobs.php"><i class="fa fa-wrench"></i> Jobs</a></li>
								<li><a href="projects.php"><i class="fa fa-pie-chart"></i> Projects</a></li>
                            </ul>
                        </nav>
    
                        <nav class="subnav">
                            <h4>Activities</h4>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="sms.php"><i class="fa fa-comment"></i> Sms</a></li>
                                <li><a href="empty">Sales</a></li>
                                <li><a href="empty">Jobs</a></li>
                                
                            </ul>
                        </nav>
                    </aside>

                    Sidebar End -->
                    
    
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
                                            <div class="view-switcher">
											<?php
											if(isset($_GET['status'])){
												$status = $_GET['status'];
												if($status == 'all'){
													$setter = 'All Jobs ';
												}elseif($status == 'today'){
													$setter = "Today's Jobs ";
												}elseif($status == 'tomorrow'){
													$setter = "Tomorrow's Jobs ";
												}elseif($status == 'week'){
													$setter = "This Week's Jobs ";
												}elseif($status == 'month'){
													$setter = "This Month's Jobs ";
												}elseif($status == 'overdue'){
													$setter = 'Over Due Jobs ';
												}elseif($status == 'completed'){
													$setter = 'Completed Jobs ';
												}else{
													$setter = 'All Jobs ';
												}
											}else{
													$setter = 'All Jobs ';
												}
												if (!isset ($_GET['history'])){
													echo'
													<h2>' .$setter. '<a href="#"> &darr;</a></h2>
													<ul>
														<li><a href="jobs.php?status=all">All jobs</a></li>
														<li><a href="jobs.php?status=today">Today</a></li>
														<li><a href="jobs.php?status=tomorrow">Tomorrow</a></li>
														<li><a href="jobs.php?status=week">This week</a></li>
														<li><a href="jobs.php?status=month">This month</a></li>
														<li><a href="jobs.php?status=overdue">Over due</a></li>
														<li><a href="jobs.php?status=completed">Completed</a></li>
													</ul>';
												}else{
													echo'
													<h2>Job History</h2>';
												}
											?>
                                            </div>
                                        </header>

                                        <section class="panel-body">
										
										<?php
										$url = $_SERVER['REQUEST_URI'];
										$url = str_replace('&', '%26', $url);
										if(isset ($_GET['history'])){
											$jobid = $_GET['jobid'];
											require_once 'job_history.php';
										}else{
												if(isset($_GET['details'])) {
													$details = $_GET['details'];
													if($details === 'true'){
														$jobid = $_GET['jobid'];
														require_once 'job_details.php';
													}else{
													require_once 'job_list.php';
													}
												}else{
													require_once 'job_list.php';
												}
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
            $("#jobList").tablesorter(); 
        } 
    );
    </script>
	<script>$('#jobList').ddTableFilter();</script>
</body>
</html>