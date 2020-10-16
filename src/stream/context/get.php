<?php namespace eastoriented\http\stream\context;

use eastoriented\http\stream\context;
use eastoriented\http\stream\context\php\recipient;

class get
	implements
		context
{
	function recipientOfArrayToBuildPhpHttpStreamContextIs(recipient $recipient): void
	{
		$recipient
			->arrayToBuildPhpHttpStreamContextIs(
				[
					'http' => [
						'method' => 'GET'
					]
				]
			)
		;
	}
}
