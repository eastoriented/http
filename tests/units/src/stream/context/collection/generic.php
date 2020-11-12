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
					$context = new mockOfStreamContext,
					$otherContext = new mockOfStreamContext
				),
				$recipient = new mockOfStreamContextRecipient
			)
			->if(
				$this->testedInstance->recipientOfArrayToBuildPhpHttpStreamContextIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($iterator, $context, $otherContext))
				->mock($context)
					->receive('recipientOfArrayToBuildPhpHttpStreamContextIs')
						->withArguments($recipient)
							->never
				->mock($otherContext)
					->receive('recipientOfArrayToBuildPhpHttpStreamContextIs')
						->withArguments($recipient)
							->never

			->given(
				$this->calling($iterator)->variablesForIteratorBlockAre = function($aBlock, ... $variables) use ($iterator) {
					foreach ($variables as $variable) $aBlock->containerIteratorHasValue($iterator, $variable);
				}
			)
			->if(
				$this->testedInstance->recipientOfArrayToBuildPhpHttpStreamContextIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($iterator, $context, $otherContext))
				->mock($context)
					->receive('recipientOfArrayToBuildPhpHttpStreamContextIs')
						->withArguments($recipient)
							->once
				->mock($otherContext)
					->receive('recipientOfArrayToBuildPhpHttpStreamContextIs')
						->withArguments($recipient)
							->once
		;
	}
}
