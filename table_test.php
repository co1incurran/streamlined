<!DOCTYPE HTML>
<html>
<head>
<title>Dashboard</title>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.2.js"></script> 
<script type="text/javascript" src="__jquery.tablesorter/jquery.tablesorter.js"></script>
<link rel="stylesheet" href="__jquery.tablesorter/themes/blue/style.css">



</head>
<body>

<table id="domainsTable" class="tablesorter"> 
    <thead> 
    <tr> 
        <th>Domain name</th> 
        <th>gTld</th> 
        <th>Category</th> 
        <th>Price</th> 
        <th>Contact</th> 
    </tr> 
    </thead> 
    <tbody> 
	<?php
	$i=0;
	while($i<10){
      echo'<tr><td><a href="http://geogram.co">geogram.co</a></td><td>co</td><td>Internet</td><td>$49</td><td><a href="mailto:jeff@lookahead.io?subject=Offer for domain name: geogram.co">Purchase</a></td></tr>
      <tr><td><a href="http://newscloud.com">newscloud.com</a></td><td>com</td><td>News</td><td>$19999</td><td><a href="mailto:jeff@lookahead.io?subject=Offer for domain name: newscloud.com">Purchase</a></td></tr>
      <tr><td><a href="http://popcloud.com">popcloud.com</a></td><td>com</td><td>Music</td><td>$14999</td><td><a href="mailto:jeff@lookahead.io?subject=Offer for domain name: popcloud.com">Purchase</a></td></tr>';
	  $i++;
	}
	?>
<!-- ... -->
</tbody> 
    </table> 
	<script>
    $(document).ready(function() 
        { 
            $("#domainsTable").tablesorter(); 
        } 
    );
    </script>
</body>
</html>