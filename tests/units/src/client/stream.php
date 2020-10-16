<?php namespace eastoriented\http\tests\units\client;

require __DIR__ . '/../../runner.php';

use eastoriented\tests\units;
use eastoriented\http\stream\context\blackhole;
use mock\eastoriented\http\url as mockOfUrl;
use mock\eastoriented\http\request as mockOfRequest;
use mock\eastoriented\http\response\recipient as mockOfResponseRecipient;
use mock\eastoriented\http\response\factory as mockOfResponseFactory;
use mock\eastoriented\http\stream\context as mockOfStreamContext;

class stream extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('eastoriented\http\client')
		;
	}

	function test__construct()
	{
		$this->object($this->newTestedInstance($responseFactory = new mockOfResponseFactory))
			->isEqualTo($this->newTestedInstance($responseFactory, new blackhole))
		;
	}

	function testRecipientOfHttpResponseForGetOnUrlIs()
	{
		$this
			->given(
				$url = new mockOfUrl,
				$recipient = new mockOfResponseRecipient,
				$responseFactory = new mockOfResponseFactory,
				$streamContext = new mockOfStreamContext,
				$this->newTestedInstance($responseFactory, $streamContext),
			)
			->if(
				$this->testedInstance->recipientOfHttpResponseForGetOnUrlIs($url, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($responseFactory, $streamContext))
				->function('fopen')
					->wasCalled
						->never
				->mock($recipient)
					->receive('okHttpResponseIs')
						->never
					->receive('notFoundHttpResponseIs')
						->never
					->receive('serverErrorHttpResponseIs')
						->never
					->receive('unableToGetHttpResponseFromUrl')
						->never
					->receive('unableToBuildHttpResponseFromString')
						->never
				->mock($responseFactory)
					->receive('recipientOfHttpResponseBuiltFromStringIs')
						->never

			->given(
				$urlAsString = uniqid(),
				$this->calling($url)->recipientOfStringIs = function($aRecipient) use ($urlAsString) {
					$aRecipient->stringIs($urlAsString);
				},
				$this->function->fopen = false
			)
			->if(
				$this->testedInstance->recipientOfHttpResponseForGetOnUrlIs($url, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($responseFactory, $streamContext))
				->function('fopen')
					->wasCalledWithArguments($urlAsString, 'r', false, [])
						->once
				->mock($recipient)
					->receive('okHttpResponseIs')
						->never
					->receive('notFoundHttpResponseIs')
						->never
					->receive('serverErrorHttpResponseIs')
						->never
					->receive('unableToGetHttpResponseFromUrl')
						->once
					->receive('unableToBuildHttpResponseFromString')
						->never
				->mock($responseFactory)
					->receive('recipientOfHttpResponseBuiltFromStringIs')
						->never

			->given(
				$this->function->fopen = $resource = uniqid(),
				$this->function->feof[] = false,
				$this->function->feof[] = false,
				$this->function->feof[] = true,
				$this->function->stream_get_meta_data = $metadata = [ 'wrapper_data' => [ uniqid(), uniqid(), uniqid() ] ],
				$this->function->stream_get_contents[] = $body1 = uniqid(),
				$this->function->stream_get_contents[] = $body2 = uniqid()
			)
			->if(
				$this->testedInstance->recipientOfHttpResponseForGetOnUrlIs($url, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($responseFactory, $streamContext))
				->mock($recipient)
					->receive('okHttpResponseIs')
						->never
					->receive('notFoundHttpResponseIs')
						->never
					->receive('serverErrorHttpResponseIs')
						->never
					->receive('unableToGetHttpResponseFromUrl')
						->once
					->receive('unableToBuildHttpResponseFromString')
						->never
				->mock($responseFactory)
					->receive('recipientOfHttpResponseBuiltFromStringIs')
						->withArguments(join("\r\n", $metadata['wrapper_data']) . "\r\n\r\n" . $body1 . $body2)
							->once

			->given(
				$this->function->feof[] = false,
				$this->function->feof[] = false,
				$this->function->feof[] = true,
				$this->function->stream_get_contents[] = $body1,
				$this->function->stream_get_contents[] = $body2,

				$contextForStream = [ uniqid(), uniqid(), uniqid() ],
				$this->calling($streamContext)->recipientOfArrayToBuildPhpHttpStreamContextIs = function($aRecipient) use ($contextForStream) {
					$aRecipient->arrayToBuildPhpHttpStreamContextIs($contextForStream);
				},
			)
			->if(
				$this->testedInstance->recipientOfHttpResponseForGetOnUrlIs($url, $recipient),
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($responseFactory, $streamContext))
				->function('fopen')
					->wasCalledWithArguments($urlAsString, 'r', false, $contextForStream)
						->once
		;
	}

	function testRecipientOfHttpResponseForRequestIs()
	{
		$this
			->given(
				$request = new mockOfRequest,
				$recipient = new mockOfResponseRecipient,
				$responseFactory = new mockOfResponseFactory,
				$streamContext = new mockOfStreamContext,
				$this->newTestedInstance($responseFactory, $streamContext)
			)
			->if(
				$this->testedInstance->recipientOfHttpResponseForRequestIs($request, $recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($responseFactory, $streamContext))
				->mock($request)
					->receive('recipientOfHttpResponseFromClientIs')
						->withArguments($this->testedInstance, $recipient)
							->once
		;
	}
}
