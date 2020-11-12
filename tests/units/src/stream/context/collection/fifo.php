<?php namespace eastoriented\http\tests\units\stream\context\collection;

require __DIR__ . '/../../../../runner.php';

use eastoriented\tests\units;
use mock\eastoriented\http\stream\{
	context as mockOfStreamContext,
	context\php\recipient as mockOfStreamContextRecipient
};

class fifo extends units\test
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
					$context = new mockOfStreamContext
				),

				$phpStreamContext = [],
				$recipient = new mockOfStreamContextRecipient,
				$this->calling($recipient)->arrayToBuildPhpHttpStreamContextIs = function($anArray) use (& $phpStreamContext) { $phpStreamContext[] = $anArray; }
			)
			->if(
				$this->testedInstance->recipientOfArrayToBuildPhpHttpStreamContextIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($context))
				->array($phpStreamContext)
					->isEmpty

			->given(
				$arrayContext = [ uniqid() => uniqid() ],
				$this->calling($context)->recipientOfArrayToBuildPhpHttpStreamContextIs = fn($aRecipient) => $aRecipient->arrayToBuildPhpHttpStreamContextIs($arrayContext)
			)
			->if(
				$this->testedInstance->recipientOfArrayToBuildPhpHttpStreamContextIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($context))
				->array($phpStreamContext)
					->isEqualTo([ $arrayContext ])

			->given(
				$phpStreamContext = [],
				$this->newTestedInstance(
					$context,
					$otherContext = new mockOfStreamContext
				),
				$otherArrayContext = [ uniqid() => uniqid() ],
				$this->calling($otherContext)->recipientOfArrayToBuildPhpHttpStreamContextIs = fn($aRecipient) => $aRecipient->arrayToBuildPhpHttpStreamContextIs($otherArrayContext)
			)
			->if(
				$this->testedInstance->recipientOfArrayToBuildPhpHttpStreamContextIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($context, $otherContext))
				->array($phpStreamContext)
		;
	}
}
