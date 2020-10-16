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
				$this->newTestedInstance,
				$recipient = new mockOfStreamContextRecipient
			)
			->if(
				$this->testedInstance->recipientOfArrayToBuildPhpHttpStreamContextIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('arrayToBuildPhpHttpStreamContextIs')
						->never

			->given(
				$this->newTestedInstance(
					$context = new mockOfStreamContext
				)
			)
			->if(
				$this->testedInstance->recipientOfArrayToBuildPhpHttpStreamContextIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($context))
				->mock($recipient)
					->receive('arrayToBuildPhpHttpStreamContextIs')
						->never

			->given(
				$phpStreamContext = [ 'method' => 'GET' ],
				$this->calling($context)->recipientOfArrayToBuildPhpHttpStreamContextIs = fn($aRecipient) => $aRecipient->arrayToBuildPhpHttpStreamContextIs($phpStreamContext)
			)
			->if(
				$this->testedInstance->recipientOfArrayToBuildPhpHttpStreamContextIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($context))
				->mock($recipient)
					->receive('arrayToBuildPhpHttpStreamContextIs')
						->withArguments($phpStreamContext)
							->once

			->given(
				$this->newTestedInstance(
					$context,
					$otherContext = new mockOfStreamContext
				)
			)
			->if(
				$this->testedInstance->recipientOfArrayToBuildPhpHttpStreamContextIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($context, $otherContext))
				->mock($recipient)
					->receive('arrayToBuildPhpHttpStreamContextIs')
						->withArguments($phpStreamContext)
							->twice

			->given(
				$otherPhpStreamContext = $phpStreamContext,
				$this->calling($otherContext)->recipientOfArrayToBuildPhpHttpStreamContextIs = fn($aRecipient) => $aRecipient->arrayToBuildPhpHttpStreamContextIs($otherPhpStreamContext)
			)
			->if(
				$this->testedInstance->recipientOfArrayToBuildPhpHttpStreamContextIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($context, $otherContext))
				->mock($recipient)
					->receive('arrayToBuildPhpHttpStreamContextIs')
						->withArguments($phpStreamContext)
							->thrice

			->given(
				$otherPhpStreamContext = [ 'method' => 'POST' ],
				$this->calling($otherContext)->recipientOfArrayToBuildPhpHttpStreamContextIs = fn($aRecipient) => $aRecipient->arrayToBuildPhpHttpStreamContextIs($otherPhpStreamContext)
			)
			->if(
				$this->testedInstance->recipientOfArrayToBuildPhpHttpStreamContextIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($context, $otherContext))
				->mock($recipient)
					->receive('arrayToBuildPhpHttpStreamContextIs')
						->withArguments($phpStreamContext)
							->thrice
						->withArguments($otherPhpStreamContext)
							->once

			->given(
				$phpStreamContext = [ 'method' => 'GET', 'foo' => 'bar' ],
				$this->calling($context)->recipientOfArrayToBuildPhpHttpStreamContextIs = fn($aRecipient) => $aRecipient->arrayToBuildPhpHttpStreamContextIs($phpStreamContext),
				$otherPhpStreamContext = [ 'method' => 'POST', 'baz' => 'bar' ],
				$this->calling($otherContext)->recipientOfArrayToBuildPhpHttpStreamContextIs = fn($aRecipient) => $aRecipient->arrayToBuildPhpHttpStreamContextIs($otherPhpStreamContext)
			)
			->if(
				$this->testedInstance->recipientOfArrayToBuildPhpHttpStreamContextIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($context, $otherContext))
				->mock($recipient)
					->receive('arrayToBuildPhpHttpStreamContextIs')
					->withArguments([
							'method' => 'POST',
							'foo' => 'bar',
							'baz' => 'bar'
						]
					)
							->once
		;
	}
}
