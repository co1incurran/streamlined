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
<script type="text/javascript" language="javascript" src="TableFilter/tablefilter.js"></script>

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
							<li><a href="tasks_outbox.php"><i class="fa fa-sign-out"></i> Tasks Outbox </a></li>
                                <li><a href="jobs.php"><i class="fa fa-wrench"></i> Jobs</a></li>
								<li class="active" ><a href="projects.php"><i class="fa fa-pie-chart"></i> Projects</a></li>
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
                        <!--<form class="navbar-form navbar-right">
                            <div class="form-group">
                                <input type="text" class="form-control search" placeholder="Search">
                            </div>
                        </form>-->
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
                                <li><a href="tasks.php"><i class="fa fa-tasks"></i> Tasks </a></li>
                                <li><a href="jobs.php"><i class="fa fa-wrench"></i> Jobs</a></li>
								<li class="active" ><a href="projects.php"><i class="fa fa-pie-chart"></i> Projects</a></li>
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
											<?php
												$url = $_SERVER['REQUEST_URI'];
												$url = str_replace('&', '%26', $url);
												echo'
												<a href="add_project.php?url='.$url.'" class="btn btn-default" data-toggle="tooltip" title="View as a List" ><i class="fa fa-plus"></i> <strong>Add Project</strong></a>';
											?>
                                            </div>

                                            <div class="view-switcher">
											<?php
												if(isset ($_GET['type'])){
													$type = $_GET['type'];
													if($type == 'ongoing'){
														$setter = 'On going';
													}elseif($type == 'closed'){
														$setter = 'Closed';
													}else{
														$setter= 'On going';
													}
												}else{
													$setter= 'On going';
												}
											?>
                                                <h2 class="panel-title"><?php echo $setter; ?> <a href="#">&darr;</a></h2>
                                                <ul>
                                                    <li><a href="projects.php?type=ongoing">On going </a></li>
                                                    <li><a href="projects.php?type=closed">Closed&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                                                    
                                                </ul>
                                            </div>
                                        </header>
										
                                        <section class="panel-body">
										
											<?php
												//get the list of projects
												require_once 'project_list.php';
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
            $("#privateCustomers").tablesorter(); 
        } 
    );
    </script>
</body>
</html>