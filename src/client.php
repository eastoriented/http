<?php namespace eastoriented\http;

use eastoriented\http\{
	url,
	request,
	response
};

interface client
{
	function recipientOfHttpResponseForGetOnUrlIs(url $url, response\recipient $recipient) :void;
	function recipientOfHttpResponseForRequestIs(request $request, response\recipient $recipient) :void;
}
