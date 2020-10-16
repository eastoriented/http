<?php namespace eastoriented\http\tests\units\stream\context\php\recipient;

require __DIR__ . '/../../../../../runner.php';

use eastoriented\tests\units;
use eastoriented\http\stream\context\php\recipient\reference as testedInstance;

class reference extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('eastoriented\http\stream\context\php\recipient')
		;
	}

	function testArrayToBuildPhpHttpStreamContextIs()
	{
		$this
			->given(
				$variable = null,
				$testedInstance = new testedInstance($variable),
				$context = [ uniqid() ]
			)
			->if(
				$testedInstance->arrayToBuildPhpHttpStreamContextIs($context)
			)
			->then
				->object($testedInstance)
					->isEqualTo(new testedInstance($variable))
				->array($variable)
					->isEqualTo($context)
			->if(
				$testedInstance->arrayToBuildPhpHttpStreamContextIs($context, $otherContext = [ uniqid() ])
			)
			->then
				->object($testedInstance)
					->isEqualTo(new testedInstance($variable))
				->array($variable)
					->isEqualTo($context)
			;
	}
}
