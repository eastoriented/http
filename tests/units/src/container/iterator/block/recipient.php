<?php namespace eastoriented\http\tests\units\container\iterator\block;

require __DIR__ . '/../../../../runner.php';

use eastoriented\tests\units;
use mock\eastoriented\http\stream\context as mockOfStreamContext;
use mock\eastoriented\http\stream\context\php\recipient as mockOfPhpStreamContextRecipient;
use mock\eastoriented\php\container\iterator as mockOfIterator;

class recipient extends units\test
{
	function testClass()
	{
		$this->testedClass
		 	->implements('eastoriented\php\container\iterator\block')
		;
	}

	function testContainerIteratorHasValue()
	{
		$this
			->given(
				$this->newTestedInstance(
					$recipient = new mockOfPhpStreamContextRecipient
				),
				$iterator = new mockOfIterator,
				$streamContext = new mockOfStreamContext
			)
			->if(
				$this->testedInstance->containerIteratorHasValue($iterator, $streamContext)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($recipient))
				->mock($streamContext)
					->receive('recipientOfArrayToBuildPhpHttpStreamContextIs')
						->withArguments($recipient)
							->once
		;
	}
}
