<?php
	use Clickatell\Rest;
	use Clickatell\ClickatellException;

	$clickatell = new \Clickatell\Rest('token');

	// Full list of support parameters can be found at https://www.clickatell.com/developers/api-documentation/rest-api-request-parameters/
	try {
		$result = $clickatell->sendMessage(['to' => ['27111111111'], 'content' => 'Message Content']);

		foreach ($result['messages'] as $message) {
			var_dump($message);

			/*
			[
				'apiMsgId'  => null|string,
				'accepted'  => boolean,
				'to'        => string,
				'error'     => null|string
			]
			*/
		}

	} catch (ClickatellException $e) {
		// Any API call error will be thrown and should be handled appropriately.
		// The API does not return error codes, so it's best to rely on error descriptions.
		var_dump($e->getMessage());
	}
?>