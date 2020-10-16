<?php namespace eastoriented\http\stream\context\php\recipient;

use eastoriented\http\stream\{
	context,
	context\php\recipient
};

class merge
	implements
		context,
		recipient
{
	private
		$context
	;

	function __construct(array $context = null)
	{
		$this->context = $context;
	}

	function arrayToBuildPhpHttpStreamContextIs(array $context) :void
	{
		$this->context = array_replace_recursive($this->context ?: [], $context);
	}

	function recipientOfArrayToBuildPhpHttpStreamContextIs(recipient $recipient) :void
	{
		if ($this->context !== null)
		{
			$recipient->arrayToBuildPhpHttpStreamContextIs($this->context);
		}
	}
}
