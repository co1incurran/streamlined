<?php
include'../include/session.php';
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
							<li><a href="../contacts/contacts.php"><i class="fa fa-book"></i>  Contacts </a></li>
							
                               <?php
								// this is used to make a notification icon in the tasks tab when a user gets new tasks
									echo '<li><a href="../task/tasks.php"><i id = "'.$iId.'">'.$amount.' '.'</i><i id = "'.$iId.'" class="fa fa-inbox"></i> Tasks Inbox </a></li>'; 
								?>
								<li><a href="../task/tasks_outbox.php"><i id = "outbox-counter"><?php echo $count.' '; ?></i><i class="fa fa-sign-out"></i> Tasks Outbox </a></li>
                                <li><a href="../jobs/jobs.php"><i class="fa fa-wrench"></i> Jobs</a></li>
								<li><a href="../services/services.php"><i class="fa fa-medkit"></i> Services</a></li>
							<li class="active" ><a href="projects.php"><i class="fa fa-pie-chart"></i> Projects</a></li>
							<li><a href="../sms/sms.php"><i class="fa fa-comment"></i> SMS</a></li>
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
							
							//this handles the passing of projectid variable
							if(isset($_POST['projectid'])){
								$projectid = $_POST['projectid'];
							}else{
								$projectid = $_GET['projectid'];
							}
							
							
							//this is for counting the number of todo tasks in the project
							$sqlTodoCounter = "SELECT COUNT(*) FROM activity WHERE complete = '0' AND activityid IN (SELECT activityid FROM project_activity WHERE projectid = '$projectid');";
							$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
							$res5 = mysqli_query($con,$sqlTodoCounter);
							$row = mysqli_fetch_row($res5);
							$todoCounter = $row['0'];
							if($todoCounter == 0){
								$todoCounter = '';
							}
							echo'
							<ul id = "icons">
								<li><a class = "icons" href ="project_profile.php?projectid='.$projectid.'"><i class="fa fa-eye"></i> Overview </a></li>
								<li><a class = "icons" href ="project_profile.php?projectid='.$projectid.'&page=contacts"><i class="fa fa-book"></i> Contacts </a></li>
								<li><a class = "icons" href = "project_profile.php?projectid='.$projectid.'&page=taskhistory"><i class="fa fa-area-chart"></i> Task History </a></li>
								<li><a class = "icons" href = "project_profile.php?projectid='.$projectid.'&page=todo"><i id="outbox-counter">'.$todoCounter.' '.'</i><i class="fa fa-list-alt" aria-hidden="true"></i> To do </a></li>';
								if($companyid != 0){
											echo '<li><a id="add_contact" class = "icons" href="add_contact.php?url='.$url.'&customerid='.$customerid.'&companyid='
											.$companyid.'"><i class="fa fa-users"></i> Add Contact </a></li>';
								}
								echo'
							</ul>';
					?>
					
							
							<?php
								//this is experimental
									
									$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

									$projectid = mysqli_real_escape_string($con ,$projectid);
									//echo $projectid;
									$sql = "SELECT * FROM projects WHERE projectid ='$projectid' ; ";
									//echo $sql;
									$res = mysqli_query($con,$sql);
									
									$result = array();

									 
									while($row = mysqli_fetch_array($res)){
										array_push($result,
											array('projectid'=>$row[0],
											'planning_number'=>$row[1],
											'est_start_date'=>$row[2],
											'address_line1'=>$row[3],
											'address_line2'=>$row[4],
											'address_line3'=>$row[5],
											'address_line4'=>$row[6],
											'county'=>$row[7],
											'country'=>$row[8],
											'regarding'=>$row[9],
											'notes'=> $row[10],
											'closed'=> $row[11]
										));
									}
								
									//print_r (array_values($result));
									//echo '<br>';

									//used to ensure a proper page reload if details are updated
									$url = $_SERVER['REQUEST_URI'];
									$url = str_replace('&', '%26', $url);

									foreach ($result as $results){
										$planningNumber = $results['planning_number'];
										$startDate = $results['est_start_date'];
										$address1 = $results['address_line1'];
										$address2 = $results['address_line2'];
										$address3 = $results['address_line3'];
										$address4 = $results['address_line4'];
										$county = $results['country'];
										$country = $results['county'];
										$regarding = $results['regarding'];
										$notes = $results['notes'];
										
										echo '<div class="main-section">
													
														<div class="container-fluid no-padding">
															<div class="col-md-7 no-padding">
																<div class="main-content panel panel-default no-margin">
																	<header class="panel-heading clearfix">';
																	
																		echo'
																		<div class="btn-group pull-right">';
																					$url = $_SERVER['REQUEST_URI'];
																					//$url = str_replace('&', '%26', $url);
																					if(isset($_GET['page'])){
																						$p = $_GET['page'];
																						if($p == 'contacts'){
																							echo'													
																							<a href="add_a_contact_to_project.php?url='.$url.'&projectid='.$projectid.'" class="btn btn-default" data-toggle="tooltip" title="View as a List" ><i class="fa fa-plus"></i> <strong>Add Contact</strong></a>';
																						}elseif($p == 'todo' || $p == 'taskhistory'){
																							echo'													
																							<a href="../profile/add_activity.php?url='.$url.'&projectid='.$projectid.'" class="btn btn-default" data-toggle="tooltip" title="View as a List" ><i class="fa fa-plus"></i> <strong>Add Task</strong></a>';
																						}
																					}
																		echo'			
																		</div>
																		 <span class="avatar"></span>
																		 <hgroup>';
																			/*<a href="documentation/index.html" class="btn btn-default pull-right" rel="#overlay"><i class="fa fa-question-circle"></i></a>';*/
																				 echo	'<h2><strong>Ref: </strong>'. ucwords($results['planning_number']).'<a id="edit" href="edit_project_details.php?url='.$url.'&projectid='.$projectid.'&planningNumber='.$planningNumber.'&startDate='.$startDate.'&address1='.$address1.'&address2='.$address2.'&address3='.$address3.'&address4='.$address4.'&county='.$county.'&country='.$country.'&regarding='.$regarding.'&notes='.$notes.'"><i class="fa fa-gear"></i></a></h2>';
																					$ad1 = ucwords($results['address_line1']);
																					$ad2 = ucwords($results['address_line2']);
																					$ad3 = ucwords($results['address_line3']);
																					$ad4 = ucwords($results['address_line4']);
																					$county = ucwords($results['county']);
																					$country = ucwords($results['country']);
																					echo'<h4><strong>Location: </strong>';
																					if(!empty($ad1)){ 
																						echo $ad1.', ';
																						//echo nl2br("\n");
																					}
																					if(!empty($ad2) && $ad2 != $ad1){ 
																						echo $ad2.', ';
																						//echo nl2br("\n");
																					}
																					if(!empty($ad3)&& $ad3 != $ad2 && $ad3 != $ad1){ 
																						echo $ad3.', ';
																						//echo nl2br("\n");
																					}
																					if(!empty($ad4)&& $ad4 != $ad3 && $ad4 != $ad2 && $ad4 != $ad1){ 
																						echo $ad4.', ';
																						//echo nl2br("\n");
																					}
																					if(!empty($county)&& $county != $ad4 && $county != $ad3){ 
																						echo $county.', ';
																						//echo nl2br("\n");
																					}
																					if(!empty($country)){ 
																						echo $country;
																					}
																				 
																				 echo '</h4>';
																				 $sqlName = "SELECT name FROM company WHERE companyid IN (SELECT companyid FROM company_to_project WHERE projectid = '$projectid');" ;
																				//echo $sql;
																				$res = mysqli_query($con,$sqlName);
																				//$row = mysqli_fetch_assoc($res);
																				$resultName = array();

																				while($row = mysqli_fetch_array($res)){
																					array_push($resultName,
																						array('name'=>$row[0]
																					));
																				}
																				
																				
																				echo '</h4>
																				<h4><strong>Regarding: </strong>'.$results['regarding'].'</h4>
																				
																	</hgroup>
																	</header>
																	<section class="panel-body" style = "width:100%">';
																		if(isset ($_GET['page'])){
																			$page = $_GET['page'];
																			if($page == 'contacts'){
																				require_once 'project_contacts.php';
																				//echo 'contacts';
																			}elseif($page == 'taskhistory'){
																				//echo'task history <br>';
																				require_once 'project_task_history.php';
																			}elseif($page == 'todo'){
																				//echo'task history <br>';
																				require_once 'project_todo.php';
																			}
																		}else{
																			require_once 'project_overview.php';
																		}
																echo'
																</section>
																</div>
															</div>';
												echo '</div>
												</div>';
									}
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