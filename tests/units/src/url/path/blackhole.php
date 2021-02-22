<?php namespace eastoriented\http\tests\units\url\path;

require __DIR__ . '/../../../runner.php';

use eastoriented\tests\units;
use mock\eastoriented\php\string\recipient as mockOfRecipient;

class blackhole extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('eastoriented\http\url\path')
		;
	}

	function testRecipientOfStringIs()
	{
		$this
			->given(
				$this->newTestedInstance,
				$recipient = new mockOfRecipient
			)
			->if(
				$this->testedInstance->recipientOfStringIs($recipient)
			)
			->then
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance)
				->mock($recipient)
					->receive('stringIs')
						->never
		;
	}
}
