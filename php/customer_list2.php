<?php
define("DB_HOST", "127.0.0.1");
define("DB_USER", "user");
define("DB_PASSWORD", "1234");
define("DB_DATABASE", "database");
 
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);



$sql = "SELECT name FROM company; ";
$res = mysqli_query($con,$sql);
$result = array();


$sql2 = "SELECT first_name, last_name FROM customer; ";
$res2 = mysqli_query($con,$sql2);
$result2 = array();
 
while($row = mysqli_fetch_array($res)){
	array_push($result,
		array(
		'name'=>$row[0]
	));
}
// print_r (array_values($result));
 //echo '<br>';
while($row = mysqli_fetch_array($res2)){
	array_push($result2,
		array(
		'first_name'=>$row[0],
		'last_name'=>$row[1]
	));
} //print_r (array_values($result2));

foreach ($result2 as $r2){
	$customerName = $r2['first_name'].' '.$r2['last_name'];
	//echo $customerName. '<br>';
	array_push($result,
		array(
		'name'=>$customerName
	));
}

sort($result);
//print_r (array_values($result));




echo '<button class="btn btn-primary navbar-btn" data-toggle="popover" data-title="Add new job" data-placement="bottom" data-content="
	<form class="form-horizontal" action = "add_job.php" method = "post">
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
                                                <select  class="form-control">';
												foreach ($result as $r) {
												echo' <option>'.ucwords($r['name']).'</option>';
												}
												echo '</select>
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
                                    </form>"><i class="fa fa-wrench"></i> Add Job</button>';
mysqli_close($con);
?>