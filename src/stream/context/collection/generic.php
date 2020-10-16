<?php namespace eastoriented\http\stream\context\collection;

use eastoriented\php\{
	container\iterator,
	container\iterator\block
};
use eastoriented\http\stream\{
	context,
	context\php\recipient
};

class generic
	implements
		context
{
	private
		$iterator,
		$block,
		$contexts
	;

	function __construct(iterator $iterator, block $block, context... $contexts)
	{
		$this->iterator = $iterator;
		$this->block = $block;
		$this->contexts = $contexts;
	}

	function recipientOfArrayToBuildPhpHttpStreamContextIs(recipient $recipient): void
	{
		$this->iterator->variablesForIteratorBlockAre($this->block, ... $this->contexts);
	}
}
