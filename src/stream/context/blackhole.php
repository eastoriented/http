<?php namespace eastoriented\http\stream\context;

use eastoriented\http\stream\context;
use eastoriented\http\stream\context\php\recipient;

class blackhole
	implements
		context
{
	function recipientOfArrayToBuildPhpHttpStreamContextIs(recipient $recipient): void
	{
	}
}
