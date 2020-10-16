<?php namespace eastoriented\http\tests\units\stream\context\php\recipient;

require __DIR__ . '/../../../../../runner.php';

use eastoriented\tests\units;
use eastoriented\http\stream\context\recipient\reference as testedInstance;

class functor extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('eastoriented\http\stream\context\php\recipient')
		;
	}

	function testHttpStreamContextIs()
	{
		$this
			->given(
				$function = function() use (& $arguments) {
					$arguments = func_get_args();
				},
				$this->newTestedInstance($function)
			)
			->if(
				$this->testedInstance->arrayToBuildPhpHttpStreamContextIs($context = [ uniqid(), uniqid(), uniqid() ])
			)
			->then
				->object($this->testedInstance)
					->isEqualTo($this->newTestedInstance($function))
				->array($arguments)
					->isEqualTo([ $context ])
		;
	}
}
