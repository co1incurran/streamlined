<!DOCTYPE HTML>
<html>
<head>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.3.js"></script> 
<script type="text/javascript" src="__jquery.tablesorter/jquery.tablesorter.js"></script>
<link rel="stylesheet" href="__jquery.tablesorter/themes/blue/style.css">
</head>
<body>
<?php
 require_once 'table_test.php';
?>
	<script>
    $(document).ready(function() 
        { 
            $("#companyNames").tablesorter(); 
        } 
    );
    </script>
</body>
</html>