<?php namespace eastoriented\http\stream\context\php\recipient;

use eastoriented\{
	php\block,
	http\stream\context\php\recipient
};

class functor extends block\functor
	implements
		recipient
{
	function arrayToBuildPhpHttpStreamContextIs(array $context) :void
	{
		parent::blockArgumentsAre($context);
	}
}
