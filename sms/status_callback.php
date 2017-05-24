<?php
	use Clickatell\Rest;
	use Clickatell\ClickatellException;

	// Outgoing traffic callbacks (MT callbacks)
	Rest::parseStatusCallback(function ($result) {
		var_dump($result);
		// This will execute if the request to the web page contains all the values
		// specified by Clickatell. Requests that omit these values will be ignored.
	});

	// Incoming traffic callbacks (MO/Two Way callbacks)
	Rest::parseReplyCallback(function ($result) {
		var_dump($result);
		// This will execute if the request to the web page contains all the values
		// specified by Clickatell. Requests that omit these values will be ignored.
	});
?>