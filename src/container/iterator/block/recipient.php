<?php namespace eastoriented\http\container\iterator\block;

use eastoriented\php\container\{
	iterator,
	iterator\block
};
use eastoriented\http\stream;

class recipient
	implements
		block
{
	private
		$recipient
	;

	function __construct(stream\context\php\recipient $recipient)
	{
		$this->recipient = $recipient;
	}

	function containerIteratorHasValue(iterator $iterator, $value) :void
	{
		$value->recipientOfArrayToBuildPhpHttpStreamContextIs($this->recipient);
	}
}
