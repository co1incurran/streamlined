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
                      <!--  <form class="navbar-form navbar-right">
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
								<li><a class = "icons" href = "profile.php?customerid='.$customerid.'&companyid='.$companyid.'&page=task"><i class="fa fa-area-chart"></i> Task History </a></li>
								<li><a id="add_asset" class = "icons" href="add_asset.php?url='.$url.'&customerid='.$customerid.'&companyid='.$companyid.'"><i class="fa fa-gift"></i> Add Asset </a></li>';
								if($companyid != 0){
											echo '<li><a id="add_contact" class = "icons" href="add_contact.php?url='.$url.'&customerid='.$customerid.'&companyid='
											.$companyid.'"><i class="fa fa-users"></i> Add Contact </a></li>';
								}
								echo'
								<li><a id="add_job" class = "icons" href="add_job.php?url='.$url.'&customerid='.$customerid.'&companyid='.$companyid.'"><i class ="fa fa-wrench"></i> Add Job </a></li>
								<li><a class = "icons" href = "add_activity.php?url='.$url.'&customerid='.$customerid.'&companyid='.$companyid.'"><i class="fa fa-gears"></i> Add Task </a></li>
							</ul>';
								
									//if you are looking at companies
									if ($companyid != 0){
										if(isset($_GET['page'])) {
											$page =$_GET['page'];
										}else{
											$page = 'assets';
										}

										//check which page to load
									/*if($page != 'assets'&& $page != 'contacts'&& $page != 'history'  && $page != 'notes' && $page != 'task' ){
										require_once 'php/company_assets.php';
									}else{*/
										if($page == 'assets'){
											require_once 'php/company_assets.php';
										}elseif($page == 'contacts'){
											require_once 'php/company_contacts.php';
										}elseif($page == 'history'){
											require_once 'php/history.php';
											//echo 'history';
										}elseif($page == 'task'){
											
											require_once 'php/profile_task_history.php';
											//echo 'tasks';
										}
									//}	
									//if you are looking at private customers
									}else{
											if(isset($_GET['page'])) {
												$page = $_GET['page'];
											}else{
												$page = 'assets';
											}
										/*if($page != 'assets'&& $page != 'contacts'&& $page != 'history'  && $page != 'notes' && $page != 'task'){
											require_once 'php/company_assets.php';
										}else{*/
											//check which page to load
											if($page == 'assets'){
												require_once 'php/customer_assets.php';
											}elseif($page == 'history'){
												require_once 'php/history.php';
												//echo 'history';
											}elseif($page == 'notes'){
												require_once 'php/customer_notes.php';
											}elseif($page == 'task'){
												require_once 'php/profile_task_history.php';
												//echo 'tasks';
											}
										//}
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