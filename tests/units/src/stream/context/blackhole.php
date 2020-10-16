<?php namespace eastoriented\http\tests\units\stream\context;

require __DIR__ . '/../../../runner.php';

use eastoriented\tests\units;
use mageekguy\atoum\writer;
use mock\eastoriented\http\stream\context\php\recipient as mockOfRecipient;

class blackhole extends units\test
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
				$recipient = new mockOfRecipient
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
		;
	}
}
