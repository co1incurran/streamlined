<?php
include'../include/session.php';
include'../include/db_connection.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">


<title>Enable Supplies - CRM System</title>

<!-- Compiled and minified Bootstrap CSS -->
<link rel="stylesheet" href="../css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- Compiled and minified FontAwesome CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

<!-- markItUp! skin -->
<link rel="stylesheet" type="text/css" href="../markitup/skins/simple/style.css" />
<!--  markItUp! toolbar skin -->
<link rel="stylesheet" type="text/css" href="../markitup/sets/default/style.css" />

<link rel="stylesheet" media="screen" href="../css/style.css" />
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
                      <a class="navbar-brand" href="../welcome/welcome.php">Enable Supplies</a>
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
						
						//this counts how many outbox tasks you have
						$sql2 = "SELECT COUNT(*) FROM activity WHERE complete = '0' AND activityid IN (SELECT activityid FROM assigned_activity WHERE userid != '$userLoggedOn' AND created_by = '$userLoggedOn');";
						//echo $sql2;
						$res2 = mysqli_query($con,$sql2);
						$row = mysqli_fetch_row($res2);
						$count = $row['0'];
						//echo $rowCount;
					?>
					
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul id="main-nav" class="nav navbar-nav">
							<li><a href="../contacts/contacts.php"><i class="fa fa-book"></i>  Contacts </a></li>
							
                               <?php
								// this is used to make a notification icon in the tasks tab when a user gets new tasks
									echo '<li><a href="../task/tasks.php"><i id = "'.$iId.'">'.$amount.' '.'</i><i id = "'.$iId.'" class="fa fa-inbox"></i> Tasks Inbox </a></li>'; 
								?>
								<li><a href="../task/tasks_outbox.php"><i id = "outbox-counter"><?php echo $count.' '; ?></i><i class="fa fa-sign-out"></i> Tasks Outbox </a></li>
                                <li><a href="../jobs/jobs.php"><i class="fa fa-wrench"></i> Jobs</a></li>
								<li><a href="../services/services.php"><i class="fa fa-medkit"></i> Services</a></li>
							<li><a href="../projects/projects.php"><i class="fa fa-pie-chart"></i> Projects</a></li>
							<li class="active" ><a href="sms.php"><i class="fa fa-comment"></i> SMS</a></li>
                            <li class="dropdown">
                                <a href="#" id = "logout" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><!--<i class="fa fa-cog"></i>--> <?php echo $userLoggedOn.' '; ?><span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Account</a></li>
                                    <li><a href="#">Users</a></li>
                                    <li><a href="#">Groups</a></li>
                                    <li><a href="../account/logout.php">Log out</a></li>
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
					<?php							
							echo'
							<section class="col-md-9 no-padding">';
							$url = $_SERVER['REQUEST_URI'];
							$url = str_replace('&', '%26', $url);
							
							echo'
							<ul id = "icons">
								<li><a class = "icons" href ="sms.php?page=templates"><i class="fa fa-file"></i> Templates </a></li>
								<li><a class = "icons" href ="sms.php?page=history"><i class="fa fa-history"></i> History </a></li>
								<li><a class = "icons" href = "sms.php?page=account"><i class="fa fa-eur"></i> Account </a></li>
							</ul>';
					?>
					
							
<?php
	echo '<div class="main-section">
				<div class="container-fluid no-padding">
						<div class="col-md-7 no-padding">
							<div class="main-content panel panel-default no-margin">
								<header class="panel-heading clearfix">';
									echo'
									<div class="btn-group pull-right">';
										$url = $_SERVER['REQUEST_URI'];
										//$url = str_replace('&', '%26', $url);
										echo'													
										<a href="add_a_contact_to_project.php?url='.$url.'&projectid=" class="btn btn-default" data-toggle="tooltip" title="View as a List" ><i class="fa fa-plus"></i> <strong>Create SMS</strong></a>			
									</div>
									 <span class="avatar"></span>
									 <hgroup>';
										/*<a href="documentation/index.html" class="btn btn-default pull-right" rel="#overlay"><i class="fa fa-question-circle"></i></a>';*/
											 echo	'<h2><strong>Ref: </strong><a id="edit" href="#"><i class="fa fa-gear"></i></a></h2>';
												
												echo'<h4><strong>Location: </strong></h4>
											<h4><strong>Regarding: </strong></h4>
											
								</hgroup>
								</header>
								<section class="panel-body" style = "width:100%">';
									if(isset ($_GET['page'])){
										$page = $_GET['page'];
										if($page == 'templates'){
											require_once 'templates.php';
											
										}elseif($page == 'account'){
										
											require_once 'account.php';
										}elseif($page == 'history'){
											
											require_once 'history.php';
										}
									}else{
										require_once 'templates.php';
									}
							echo'
							</section>
							</div>
						</div>';
			echo '</div>
			</div>';
	mysqli_close($con);
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
    <script type="text/javascript" src="../markitup/jquery.markitup.js"></script>
    <!-- markItUp! toolbar settings -->
    <script type="text/javascript" src="../markitup/sets/default/set.js"></script>

    <!-- Main Script -->
    <script src="../js/global.js"></script>

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