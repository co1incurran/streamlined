<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">


<title>Enable Supplies - CRM System</title>

<!-- Compiled and minified Bootstrap CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- Compiled and minified FontAwesome CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

<!-- markItUp! skin -->
<link rel="stylesheet" type="text/css" href="markitup/skins/simple/style.css" />
<!--  markItUp! toolbar skin -->
<link rel="stylesheet" type="text/css" href="markitup/sets/default/style.css" />

<link rel="stylesheet" media="screen" href="css/style.css" />
<script>	
$('#jobType').on('change',function(){
    if( $(this).val()===10){
    $("#properJob").show()
    }
    else{
    $("#properJob").hide()
    }
});
</script>

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
'><i class="fa fa-user"></i> Add Customer</button>
                            </li>
                            <li class="action">
                                <button class="btn btn-primary navbar-btn" data-toggle="popover" data-title="Add new job" data-placement="bottom" data-content='<form class="form-horizontal" action = "add_job.php" method = "post">
                                        <div class="form-group">
                                            <div class="col-sm-12">
											Customer type:<br>
                                                <input type="radio" name="customerType" value="private resedent" checked> Private resedent<br>
												<input type="radio" name="customerType" value="company"> Company
                                            </div>
                                        </div>
										<div class="form-group">
                                            <div class="col-sm-12">
											Customer:
                                                <select  class="form-control">
												<option></option>
												</select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                Due date:<br />
                                                <input class="form-control" type="date" />
                                            </div>
                                        </div>
										<div class="form-group">
                                            <div class="col-sm-12">
                                                Time:<br />
                                                <input class="form-control" type="time" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                Job type:<br/>
                                                <select id="jobType" class="form-control">
													<option value= "2">Installation</option>
													<option value= "3">Inspection</option>
													<option value= "4">Service</option>
													<option value= "5">Repair</option>
													<option value= "6">Delivery</option>
													<option value= "7">Collection</option>
													<option value= "8">Training</option>
													<option value= "9">Meeting</option>
													<option value= "10">Phone call</option>
													<option value= "11">Presentation</option>
												</select>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <div class="col-sm-12">
                                                Job description:<br />
                                                <textarea maxlength="300" class ="form-control" id="jobdescription" name="jobdescription" type="text"></textarea>
                                            </div>
                                        </div>
										<div id = "properJob">
											<div class="form-group">
												<div class="col-sm-12">
												Job number:
													<input class="form-control" type="text" />
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-12">
												PO number:
													<input class="form-control" type="text" />
												</div>
											</div>
										</div>
                                        <hr />
										<input class="btn btn-primary" type="submit" id="submit" value="Add job">
                                        <button class="btn btn-default popover-close" type="button">Cancel</button>
                                    </form>
'><i class="fa fa-wrench"></i> Add Job</button>
                            </li>
                            <li><a href="dashboard.html">Dashboard</a></li>
                            <li class="active"><a href="profile.html">Profile</a></li>
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
                                <li><a href="dashboard.html"><i class="fa fa-home"></i> Overview </a></li>
                                <li><a href="activity.html"><i class="fa fa-heartbeat"></i> Latest Activity </a></li>
                                <li class="active"><a href="contacts.php?contact=contact"><i class="fa fa-book"></i>  Contacts </a></li>
                                <li><a href="tasks.html"><i class="fa fa-tasks"></i> Tasks </a></li>
                                <li><a href="jobs.php"><i class="fa fa-wrench"></i> Jobs</a></li>
                            </ul>
                        </nav>
    
                       <!-- <nav class="subnav recent">
                            <h4>Recent Contacts</h4>
                            <ul class="nav nav-pills nav-stacked">
                                <li class="active">
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
                        </nav>-->
    
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
					<?php
							if(isset($_GET['customerid'])) {
							$customerid = $_GET['customerid'];
							}else{
								$customerid= 0;
							}
							
							
							if(isset($_GET['companyid'])) {
							$companyid = $_GET['companyid'];
							}else{
								$companyid = 0;
							}
							
							echo'
							<section class="col-md-9 no-padding">';
							$url = $_SERVER['REQUEST_URI'];
							$url = str_replace('&', '%26', $url);
							echo'
							<ul id = "icons">
								<li><a class = "icons" href = "profile.php?customerid='.$customerid.'&companyid='.$companyid.'&page=assets"><i class="fa fa-cubes"></i> Assets </a></li>';
							if($companyid != 0){
								echo'<li><a class = "icons" href ="profile.php?customerid='.$customerid.'&companyid='.$companyid.'&page=contacts"><i class="fa fa-book"></i> Contacts </a></li>';
							}
							echo'
								<li><a class = "icons" href = "profile.php?customerid='.$customerid.'&companyid='.$companyid.'&page=history"><i class="fa fa-history"></i> Job History </a></li>
								<li><a class = "icons" href = "profile.php?customerid='.$customerid.'&companyid='.$companyid.'&page=history"><i class="fa fa-area-chart"></i> Task History </a></li>
								<li><a id="add_asset" class = "icons" href="add_asset.php?url='.$url.'&customerid='.$customerid.'&companyid='.$companyid.'"><i class="fa fa-gift"></i> Add Asset </a></li>';
								if($companyid != 0){
											echo '<li><a id="add_contact" class = "icons" href="add_contact.php?url='.$url.'&customerid='.$customerid.'&companyid='
											.$companyid.'"><i class="fa fa-users"></i> Add Contact </a></li>';
								}
								echo'
								<li><a id="add_job" class = "icons" href="add_job.php?url='.$url.'&customerid='.$customerid.'&companyid='.$companyid.'"><i class ="fa fa-wrench"></i> Add Job </a></li>
								<li><a class = "icons" href = "add_activity.php?url='.$url.'&customerid='.$customerid.'&companyid='.$companyid.'"><i class="fa fa-gears"></i> Add Task </a></li>
							</ul>';
							
							/*<div data-role="main" class="ui-content">
								<a href="#myPopup" data-rel="popup" class="ui-btn ui-btn-inline ui-corner-all ui-icon-check ui-btn-icon-left">Show Popup Form</a>
							//fin
								<div data-role="popup" id="myPopup" class="ui-content" style="min-width:250px;">
								  <form method="post" action="demoform.asp">
									<div>
									  <h3>Login information</h3>
									  <label for="usrnm" class="ui-hidden-accessible">Username:</label>
									  <input type="text" name="user" id="usrnm" placeholder="Username">
									  <label for="pswd" class="ui-hidden-accessible">Password:</label>
									  <input type="password" name="passw" id="pswd" placeholder="Password">
									  <label for="log">Keep me logged in</label>
									  <input type="checkbox" name="login" id="log" value="1" data-mini="true">
									  <input type="submit" data-inline="true" value="Log in">
									</div>
								  </form>
								</div>
							  </div>
							  </html>
							  <a>scr = href.276/*/
							//put a forloop here to iterate through the entire dataset and then
								
									//if you are looking at companies
									if ($companyid != 0){
										if(isset($_GET['page'])) {
											$page =$_GET['page'];
										}else{
											$page = 'assets';
										}

										//check which page to load
									if($page != 'assets'&& $page != 'contacts'&& $page != 'history'  && $page != 'notes'){
										require_once 'php/company_assets.php';
									}else{
										if($page === 'assets'){
											require_once 'php/company_assets.php';
										}elseif($page === 'contacts'){
											require_once 'php/company_contacts.php';
										}elseif($page = 'history'){
											require_once 'php/history.php';
										}/*elseif($page = 'notes'){
											require_once 'php/company_notes.php';
										}*/
									}	
									//if you are looking at private customers
									}else{
											if(isset($_GET['page'])) {
												$page = $_GET['page'];
											}else{
												$page = 'assets';
											}
										if($page != 'assets'&& $page != 'contacts'&& $page != 'history'  && $page != 'notes'){
											require_once 'php/company_assets.php';
										}else{
											//check which page to load
											if($page === 'assets'){
												require_once 'php/customer_assets.php';
											}elseif($page = 'history'){
												require_once 'php/history.php';
											}elseif($page = 'notes'){
												require_once 'php/customer_notes.php';
											}
										}
									}				
					?>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    <!-- markitup! -->
    <script type="text/javascript" src="markitup/jquery.markitup.js"></script>
    <!-- markItUp! toolbar settings -->
    <script type="text/javascript" src="markitup/sets/default/set.js"></script>

    <!-- Main Script -->
    <script src="js/global.js"></script>

    <script type="text/javascript">
    $(document).ready(function(){
        // Add markItUp! to your textarea in one line
        $('.markItUpTextarea').markItUp(mySettings, { root:'markitup/skins/simple/' });
    });
    </script>
	<!-- This is use to make the add job form bigger based on the selection of job type-->
	<script>	
$('#jobType').on('change',function(){
    if( $(this).val()==10){
    $("#properJob").show()
    }
    else{
    $("#properJob").hide()
    }
});
</script>

</body>
</html>