<?php namespace eastoriented\http\stream\context\collection;

use eastoriented\php\{
	container\iterator,
};
use eastoriented\http\container\iterator\block;
use eastoriented\http\stream\{
	context,
	context\php\recipient,
};

class generic
	implements
		context
{
	private
		$iterator,
		$contexts
	;

	function __construct(iterator $iterator, context... $contexts)
	{
		$this->iterator = $iterator;
		$this->contexts = $contexts;
	}

	function recipientOfArrayToBuildPhpHttpStreamContextIs(recipient $recipient): void
	{
		$this->iterator
			->variablesForIteratorBlockAre(
			new block\recipient($recipient),
				... $this->contexts
			)
		;
	}
}
