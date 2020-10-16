<?php namespace eastoriented\http\stream\context\collection;

use eastoriented\php\container;
use eastoriented\http\container\iterator\block;
use eastoriented\http\stream\{
	context,
	context\php\recipient
};

class fifo
	implements
		context
{
	private
		$contexts
	;

	function __construct(context... $contexts)
	{
		$this->contexts = $contexts;
	}

	function recipientOfArrayToBuildPhpHttpStreamContextIs(recipient $recipient): void
	{
		$merge = new context\php\recipient\merge;

		(
			new container\adt\fifo(
				... $this->contexts
			)
		)
			->blockForEachValueIs(
				new block\recipient($merge)
			)
		;

		$merge->recipientOfArrayToBuildPhpHttpStreamContextIs($recipient);
	}
}
