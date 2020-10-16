<?php namespace eastoriented\http\response;

use eastoriented\http\response;

interface factory
{
	function recipientOfHttpResponseBuiltFromStringIs(string $string, response\recipient $recipient) :void;

}
