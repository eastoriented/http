<?php namespace eastoriented\http\url\query;

use eastoriented\http\url\query;
use eastoriented\php\string\recipient;

class blackhole
	implements
		query
{
	function recipientOfStringIs(recipient $recipient) :void
	{
	}
}
