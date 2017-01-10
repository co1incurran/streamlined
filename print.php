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
<script type="text/javascript">
function checkAll(bx) {
  var cbs = document.getElementsByTagName('input');
  for(var i=0; i < cbs.length; i++) {
    if(cbs[i].type == 'checkbox') {
      cbs[i].checked = bx.checked;
    }
  }
}
</script>
<?php
echo 'print.php';
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
											

                                            <div class="view-switcher">
                                                <h2 class="panel-title">SMS contact list</h2>
                                            </div>
											
                                        </header>
										
                                        <section class="panel-body">
										
											<?php
												//this file gets the phone numbers for the people to be contacted for the service reminders
												
												$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

												$date1 = $_POST["date1"];
												$date2 = $_POST["date2"];
												$oldDate1 = $_POST["oldDate1"];
												$oldDate2 = $_POST["oldDate2"];
												//echo $date1;

												if(isset($_POST['checkbox'])){
													//echo 'checkbox is set';
													$result = array();
													$result2 = array();
													foreach($_POST['checkbox'] as $county) {
														//echo $county.'<br>';
														//get the private customers names and phone numbers so we can send them a text
														$sql1 = "SELECT customerid, first_name, last_name, mobile_phone_num FROM customer WHERE county = '$county' AND customerid IN(SELECT customerid FROM customer_requires WHERE jobid IN(SELECT jobid FROM uses WHERE stockid IN(SELECT stockid FROM stock WHERE next_service BETWEEN '$date1' AND '$date2' OR service_date BETWEEN '$oldDate1' AND '$oldDate2' )));";
														
														$res = mysqli_query($con,$sql1);
														//echo $res.'<br>';
														
														while($row = mysqli_fetch_array($res)){
															array_push($result,
																array('customerid'=>$row[0],
																'first_name'=>$row[1],
																'last_name'=>$row[2],
																'mobile_phone_num'=>$row[3]
																)
															);
														} 
														//need to get the data for sending the text messages into the array that we can send the texts messages to the people who require a service 
												///////////////////////////////////////////////////////////////////////////////////////////////////

														//get the company names and phone numbers so we can send them a text
														$sql2 = "SELECT company.companyid, company.name, workers.first_name, workers.last_name, workers.mobile_phone_num FROM company, workers, works_with WHERE county = '$county' AND company.companyid IN(SELECT companyid FROM company_requires WHERE jobid IN(SELECT jobid FROM uses WHERE stockid IN(SELECT stockid FROM stock WHERE next_service BETWEEN '$date1' AND '$date2' OR service_date BETWEEN '$oldDate1' AND '$oldDate2' ))) AND company.companyid = works_with.companyid AND works_with.workerid = workers.workerid ;";
														//AND workers.mobile_phone_num != ''
														$res2 = mysqli_query($con,$sql2);
														//echo $sql2.'<br>';
														
														while($row = mysqli_fetch_array($res2)){
															array_push($result2,
																array('companyid'=>$row[0],
																'company_name'=>$row[1],
																'worker_fname'=>$row[2],
																'worker_lname'=>$row[3],
																'worker_mobile'=>$row[4]
																)
															);
														}
														//print_r (array_values($result2));
														
														//$sql2 = "SELECT stockid, installation_date, service_date, next_service FROM stock WHERE next_service BETWEEN '$date1' AND '$date2' OR service_date BETWEEN '$oldDate1' AND '$oldDate2' AND stockid IN(SELECT stockid FROM uses WHERE jobid IN (SELECT jobid FROM customer_requires WHERE customerid IN(SELECT customerid FROM customer WHERE county = '$county'))); ";
														//echo $sql1.'<br>';
													}
													print_r (array_values($result));
													echo '<br>';
													echo '<br>';
													print_r (array_values($result2));
													echo'
													<table id="privateCustomers" class="tablesorter filterable" align="center">
														<thead>
															<tr class = "blue-row">

																<th id = "first-table-column" class = "asset-list"><strong>Customer</strong></th>

																<th class = "asset-list"><strong>Phone</strong></th>

																<th class = "asset-list"><strong>Mobile</strong></th>

																<th class = "asset-list"><strong>Address</strong></th>
																<th class = "asset-list"><strong>City</strong></th>
																<th class = "asset-list"><strong>County</strong></th>

																<th class = "asset-list"><strong>Last Contacted</strong></th>
																<th class = "asset-list"><strong>Assets</strong></th>

															</tr>
														</thead>
													<tbody>';
												} 

												//echo $date1.'<br>';
												//echo $date2.'<br>';
												mysqli_close($con);
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









