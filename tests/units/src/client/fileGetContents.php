<?php namespace eastoriented\http\tests\units\client;

require __DIR__ . '/../../runner.php';

use eastoriented\tests\units;
use mock\eastoriented\http\request as mockOfRequest;
use mock\eastoriented\http\response\recipient as mockOfResponseRecipient;


class fileGetContents extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('eastoriented\http\client')
		;
	}

	function testRecipientOfHttpResponseForGetOnUrIs()
	{
	}

	function testRecipientOfHttpResponseForRequestIs()
	{
		$this
			->given(
				$request = new mockOfRequest,
				$recipient = new mockOfResponseRecipient,
				$this->newTestedInstance
			)
			->if(
				$this->testedInstance->recipientOfHttpResponseForRequestIs($request, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance)
				->mock($request)
					->receive('recipientOfHttpResponseFromClientIs')
						->withArguments($this->newTestedInstance, $recipient)
							->once
		;
	}
}
