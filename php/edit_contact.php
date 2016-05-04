<?php
echo'
	<div id="edit-form">
		<form action="update_contact.php">
		  First Name:<br>
		  <input type="text" name="firstname"><br>
		  Last Name:<br>
		  <input type="text" name="lastname">
			Email:<br>
		  <input type="email" name="email"><br>
		  Phone Number:<br>
		  <input type="number" name="phone_number">
			Mobile Number:<br>
		  <input type="number" name="mobile_number"><br>
		  Fax:<br>
		  <input type="number" name="fax">
			Job Title:<br>
		  <input type="text" name="job_title"><br>
		  Last Contacted:<br>
		  <input type="date" name="last_contacted">
		  
		  <input type="submit" value="Save">
		</form>
	</div>';
?>