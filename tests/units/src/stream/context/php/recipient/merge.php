<?php namespace eastoriented\http\tests\units\stream\context\php\recipient;

require __DIR__ . '/../../../../../runner.php';

use eastoriented\tests\units;
use mock\eastoriented\http\stream\context\php\recipient as mockOfPhpStreamContextRecipient;

class merge extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('eastoriented\http\stream\context\php\recipient')
			->implements('eastoriented\http\stream\context')
		;
	}

	function testArrayToBuildPhpHttpStreamContextIs()
	{
		$this
			->given(
				$array = [ 'foo' => uniqid(), 'bar' => uniqid() ],
				$this->newTestedInstance
			)
			->if(
				$this->testedInstance->arrayToBuildPhpHttpStreamContextIs($array)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($array))

			->given(
				$otherArray = [ 'foo' => $otherFoo = uniqid(), 'baz' => uniqid() ]
			)
			->if(
				$this->testedInstance->arrayToBuildPhpHttpStreamContextIs($otherArray)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance([ 'foo' => $otherFoo, 'bar' => $array['bar'], 'baz' => $otherArray['baz'] ]))
		;
	}

	function testRecipientOfArrayToBuildPhpHttpStreamContextIs()
	{
		$this
			->given(
				$recipient = new mockOfPhpStreamContextRecipient,
				$this->newTestedInstance
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
				$this->newTestedInstance($stream = [ uniqid(), uniqid() ])
			)
			->if(
				$this->testedInstance->recipientOfArrayToBuildPhpHttpStreamContextIs($recipient)
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($stream))
				->mock($recipient)
					->receive('arrayToBuildPhpHttpStreamContextIs')
						->withArguments($stream)
							->once
		;
	}
}
