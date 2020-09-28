<?php namespace eastoriented\http\client;

use eastoriented\http\{
	client,
	url,
	request,
	response
};

class fileGetContents
	implements
		client
{
	function recipientOfHttpResponseForGetOnUrIs(url $url, response\recipient $recipient) :void
	{
	}

	function recipientOfHttpResponseForRequestIs(request $request, response\recipient $recipient) :void
	{
		$request
			->recipientOfHttpResponseFromClientIs(
				$this,
				$recipient
			)
		;
	}
}
