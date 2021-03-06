<?php
include'../include/session.php';
include'../include/db_connection.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Enable Supplies - CRM System</title>

<!-- Compiled and minified Bootstrap CSS -->
<link rel="stylesheet" href="../css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- Compiled and minified FontAwesome CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

<link rel="stylesheet" media="screen" href="../css/style.css" />

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
						//this is used to check if there is new tasks assigned to the user 
						$sql = "SELECT * FROM activity WHERE complete = '0' AND new = '1' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid = '$userLoggedOn' AND created_by != '$userLoggedOn') ORDER BY creation_date; ";
						//echo $sql;

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
							<li><a href="../contacts/contacts.php"><i class="fa fa-book"></i>  Contacts </a></li>
							
                               <?php
								// this is used to make a notification icon in the tasks tab when a user gets new tasks
									echo '<li><a href="../task/tasks.php"><i id = "'.$iId.'">'.$amount.' '.'</i><i id = "'.$iId.'" class="fa fa-inbox"></i> Tasks Inbox </a></li>'; 
								?>
								<li><a href="../task/tasks_outbox.php"><i class="fa fa-sign-out"></i> Tasks Outbox </a></li>
							<li><a href="../jobs/jobs.php"><i class="fa fa-wrench"></i> Jobs</a></li>
							<!--<li><a href="../services/services.php"><i class="fa fa-medkit"></i> Services</a></li>-->
							<li><a href="../projects/projects.php"><i class="fa fa-pie-chart"></i> Projects</a></li>
							<!--<li><a href="../sms/sms.php"><i class="fa fa-comment"></i> SMS</a></li>-->
                            <li class="dropdown">
                               <a href="#" id = "logout" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><!--<i class="fa fa-cog"></i>--> <?php echo $userLoggedOn.' '; ?><span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Account</a></li>
                                    <li><a href="../account/users.php">Users</a></li>
                                    <li><a href="#">Groups</a></li>
                                    <li><a href="../account/logout.php">Log out</a></li>
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
								<li><a href="projects.php"><i class="fa fa-pie-chart"></i> Projects</a></li>
                            </ul>
                        </nav>
						
                       <nav class="subnav">
                            <h4>Activities</h4>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="empty">Projects</a></li>
                                <li><a href="empty">Sales</a></li>
                                <li><a href="empty">Jobs</a></li>
                                
                            </ul>
                        </nav>
                    </aside>
    
                    Sidebar End -->
                    
    
                    <!-- Main Section -->
    
                    <section class="col-md-9 no-padding">
                        <div class="main-section">

                            <div class="main-content panel panel-default">
                                <header class="panel-heading clearfix">
                                   <!-- <a data-target="documentation/index.html" href="#" class="btn btn-default pull-right" rel="#overlay"><i class="fa fa-question-circle"></i></a>
                                    <h2 class="panel-title">
                                        Welcome to Enable Supplies
                                    </h2>-->
                                </header>
                                <section class="panel-body container-fluid">
                                    <div class="row">
                                      <div class="col-md-12">
                                          <div class="alert alert-info text-center">
                                              <h1>Welcome to Enable Supplies</h1>
                                          </div>
                                      </div>
                                    </div>
        
                                    <div class="row">
                                        <hgroup class="col-md-12 text-center">
											<h4>Today's date is:</h4>
                                            <h1><?php echo date("d/m/y")?></h1>                                            
                                        </hgroup>
                                    </div>
        
									
                                </section>
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
           
        </div>
    </footer>


    <!-- render blocking scripts -->

    <!-- jQuery JS -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    <!-- Main Script -->
    <script src="../js/global.js"></script>
</body>
</html>