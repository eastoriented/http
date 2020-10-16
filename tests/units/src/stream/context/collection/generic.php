<?php namespace eastoriented\http\tests\units\stream\context\collection;

require __DIR__ . '/../../../../runner.php';

use eastoriented\tests\units;
use mock\eastoriented\php\container\{
	iterator as mockOfIterator,
	iterator\block as mockOfIteratorBlock
};
use mock\eastoriented\http\stream\{
	context as mockOfStreamContext,
	context\php\recipient as mockOfStreamContextRecipient
};

class generic extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('eastoriented\http\stream\context')
		;
	}

	function testRecipientOfArrayToBuildPhpHttpStreamContextIs()
	{
		$this
			->given(
				$this->newTestedInstance(
					$iterator = new mockOfIterator,
					$block = new mockOfIteratorBlock
				),
				$recipient = new mockOfStreamContextRecipient
			)
			->if(
				$this->testedInstance->recipientOfArrayToBuildPhpHttpStreamContextIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($iterator, $block))
				->mock($iterator)
					->receive('variablesForIteratorBlockAre')
						->withArguments($block)
							->once

			->given(
				$this->newTestedInstance(
					$iterator,
					$block,
					$streamContext = new mockOfStreamContext,
					$otherStreamContext = new mockOfStreamContext
				)
			)
			->if(
				$this->testedInstance->recipientOfArrayToBuildPhpHttpStreamContextIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($iterator, $block, $streamContext, $otherStreamContext))
				->mock($iterator)
					->receive('variablesForIteratorBlockAre')
						->withArguments($block, $streamContext, $otherStreamContext)
							->once
		;
	}
}
