<?php namespace eastoriented\http\stream\context\php\recipient;

use eastoriented\http\stream\context\php\recipient;

class reference
	implements
		recipient
{
	private
		$variable
	;

	function __construct(& $variable)
	{
		$this->variable = & $variable;
	}

	function arrayToBuildPhpHttpStreamContextIs(array $context) :void
	{
		$this->variable = $context;
	}
}
