<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.3.js"></script> 
<script type="text/javascript" src="__jquery.tablesorter/jquery.tablesorter.js"></script>

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
                      <a class="navbar-brand" href="dashboard.html">Enable Supplies</a>
                    </div>
    
                  
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul id="main-nav" class="nav navbar-nav">
                            <li class="action">
                                <button class="btn btn-primary navbar-btn" data-toggle="popover" data-title="Add new contact" data-placement="bottom" data-content='                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                First Name<br />
                                                <input class="form-control" type="text" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                Last Name<br />
                                                <input class="form-control" type="text" /><br />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                Company<br />
                                                <input class="form-control" type="text" />
                                            </div>
                                        </div>
                                        <hr />
                                        <button class="btn btn-primary" type="button">Add contact</button>
                                        <button class="btn btn-default popover-close" type="button">Cancel</button>
                                    </form>
'><i class="fa fa-plus-circle"></i> New Contact</button>
                            </li>
                            <li class="action">
                                <button class="btn btn-primary navbar-btn" data-toggle="popover" data-title="Add new contact" data-placement="bottom" data-content='                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <input class="form-control" type="text" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                When it&#39;s due?<br />
                                                <input class="form-control" type="date" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                What category?<br/>
                                                <select class="form-control"><option>None</option></select>
                                            </div>
                                        </div>
                                        <hr />
                                        <button class="btn btn-primary" type="button">Add task</button>
                                        <button class="btn btn-default popover-close" type="button">Cancel</button>
                                    </form>
'><i class="fa fa-plus-circle"></i> New Task</button>
                            </li>
                            <li class="active"><a href="dashboard.html">Dashboard</a></li>
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="calendar.html">Calendar</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Administrator <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Account</a></li>
                                    <li><a href="#">Users</a></li>
                                    <li><a href="#">Groups</a></li>
                                    <li><a href="#">Sign out</a></li>
                                </ul>
                            </li>
                        </ul>
                        <form class="navbar-form navbar-right">
                            <div class="form-group">
                                <input type="text" class="form-control search" placeholder="Search">
                            </div>
                        </form>
                    </div>
                </div>
            </nav>
        </header>
        
        <section>
            <div class="container">
                <div class="row">

                    <!-- Sidebar -->
    
                    <aside class="col-md-3 no-padding">
    
                        <nav class="global">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="dashboard.html"><i class="fa fa-home"></i> Overview</a></li>
                                <li><a href="activity.html"><i class="fa fa-heartbeat"></i> Latest Activity</a></li>
                                <li class="active"><a href="contacts.php?contact=contact"><i class="fa fa-book"></i>  Contacts </a></li>
                                <li><a href="tasks.php"><i class="fa fa-tasks"></i> Tasks </a></li>
                                <li><a href="jobs.php"><i class="fa fa-wrench"></i> Jobs</a></li>
                            </ul>
                        </nav>
    
                      <!--  <nav class="subnav recent">
                            <h4>Recent Contacts</h4>
                            <ul class="nav nav-pills nav-stacked">
                                <li>
                                    <a class="contact" href="profile.html" data-toggle="popover" data-trigger="hover" title="Profile Summary" data-content='<span class="avatar">
                                        </span>
                                        <p>John Doe<br>
                                        <small class="text-muted">Some Company LTD</small></p>
                                        <address>123 Some Street, LA</address>
'><h5>John Doe</h5><h6>Some Company LTD</h6></a>
                                </li>
                                <li>
                                    <a class="contact" href="profile.html" data-toggle="popover" data-trigger="hover" title="Profile Summary" data-content='<span class="avatar">
                                        </span>
                                        <p>Jane Roe<br>
                                        <small class="text-muted">Some Company LTD</small></p>
                                        <address>123 Some Street, LA</address>
'><h5>Jane Roe</h5><h6>Other Company Inc.</h6></a>
                                </li>
                            </ul>
                        </nav> -->
    
                        <nav class="subnav">
                            <h4>Activities</h4>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="sms.php"><i class="fa fa-comment"></i> Sms</a></li>
                                <li><a href="empty">Sales</a></li>
                                <li><a href="empty">Jobs</a></li>
                                
                            </ul>
                        </nav>
                    </aside>

                    <!-- Sidebar End -->
                    
    
                    <!-- Main Section -->
    
                    <section class="col-md-9 no-padding">
                        <div class="main-section">
                        
                            <div class="container-fluid no-padding">
                                <div class="col-md-7 no-padding">
                                    <div class="main-content panel panel-default no-margin">
                                        <header class="panel-heading clearfix">

                                            <div class="btn-group pull-right">
											
                                                <a href="#" class="btn btn-default" data-toggle="tooltip" title="View as a List" onclick="$(this).addClass('current').parent().siblings().find('a').removeClass('current');$('#contacts').removeClass('grid-view').addClass('list-view');return false;"><i class="fa fa-th-list"></i></a>
												
                                                <a href="#" class="btn btn-default" data-toggle="tooltip" title="View as a Grid" onclick="$(this).addClass('current').parent().siblings().find('a').removeClass('current');$('#contacts').removeClass('list-view').addClass('grid-view');return false;"><i class="fa fa-th-large"></i></a>
                                                <a href="documentation/index.html" class="btn btn-default" rel="#overlay"><i class="fa fa-question-circle"></i></a>
                                            </div>

                                            <div class="view-switcher">
											<?php
												if(isset ($_GET['contact'])){
													$contact = $_GET['contact'];
													if($contact == 'companies'){
														$setter = 'Companies';
													}else{
														$setter= 'Private Customers';
													}
												}else{
													$setter= 'Private Customers';
												}
											?>
                                                <h2 class="panel-title"><?php echo $setter; ?> <a href="#">&darr;</a></h2>
                                                <ul>
                                                    <li><a href="contacts.php?contact=privatecustomer">Private Customers </a></li>
                                                    <li><a href="contacts.php?contact=companies">Companies&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                                                    
                                                </ul>
                                            </div>
                                        </header>
										
                                        <section class="panel-body">
										
											<?php
												//check which php file to load
												$contact = $_GET['contact'];
												if($contact != 'companies'){
													//echo 'customer names';
													require_once 'table_test2.php';
												}else{
													//echo 'company names';
													require_once 'table_test.php';
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
            $("#privateCustomers").tablesorter(); 
        } 
    );
    </script>
</body>
</html>