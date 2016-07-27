<?php

echo'
<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<div id="users">
		  <input class="search" placeholder="Search" />
		  <button class="sort" data-sort="name">
			Sort by name
		  </button>

		  <ul id="search-list" class="list">
		 
			<li>
			  <h3 class="name">Jonny Stromberg</h3>
			  <p class="born">1986</p>
			</li>
			<li>
			  <h3 class="name">Jonas Arnklint</h3>
			  <p class="born">1985</p>
			</li>
			<li>
			  <h3 class="name">Martina Elm</h3>
			  <p class="born">1986</p>
			</li>
			<li>
			  <h3 class="name">Gustaf Lindqvist</h3>
			  <p class="born">1983</p>
			</li>
		  </ul>

		</div>
		<script src="http://listjs.com/no-cdn/list.js"></script>
	</body>
</html>
<script>
var options = {
  valueNames: [ "name", "born" ]
};

var userList = new List("users", options);
</script>';

?>