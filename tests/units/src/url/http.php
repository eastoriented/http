<?php namespace eastoriented\http\tests\units\url;

require __DIR__ . '/../../runner.php';

use eastoriented\tests\units;
use mock\eastoriented\php\string\recipient as mockOfRecipient;
use mock\eastoriented\http\url\{
	authority as mockOfAuthority,
	path as mockOfPath,
	query as mockOfQuery
};

class http extends units\test
{
	function testClass()
	{
		$this->testedClass
			->implements('eastoriented\http\url')
		;
	}

	function testRecipientOfStringIs()
	{
		$this
			->given(
				$recipient = new mockOfRecipient,
				$this->newTestedInstance(
					$authority = new mockOfAuthority
				)
			)
			->if(
				$this->testedInstance->recipientOfStringIs($recipient)
			)
			->then
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance($authority))
					->mock($recipient)
						->receive('stringIs')
							->never

			->given(
				$authorityAsString = uniqid(),
				$this->calling($authority)->recipientOfStringIs = fn($aRecipient) => $aRecipient->stringIs($authorityAsString)
			)
			->if(
				$this->testedInstance->recipientOfStringIs($recipient)
			)
			->then
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance($authority))
					->mock($recipient)
						->receive('stringIs')
							->withArguments('http:' . $authorityAsString)
								->once

			->given(
				$this->newTestedInstance(
					$authority,
					$path = new mockOfPath,
				),
				$pathAsString = uniqid(),
				$this->calling($path)->recipientOfStringIs = fn($aRecipient) => $aRecipient->stringIs($pathAsString)
			)
			->if(
				$this->testedInstance->recipientOfStringIs($recipient)
			)
			->then
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance($authority, $path))
					->mock($recipient)
						->receive('stringIs')
							->withArguments('http:' . $authorityAsString . $pathAsString)
								->once

			->given(
				$this->newTestedInstance(
					$authority,
					$path,
					$query = new mockOfQuery,
				),
				$queryAsString = uniqid(),
				$this->calling($query)->recipientOfStringIs = fn($aRecipient) => $aRecipient->stringIs($queryAsString)
			)
			->if(
				$this->testedInstance->recipientOfStringIs($recipient)
			)
			->then
				->object($this->testedInstance)->isEqualTo($this->newTestedInstance($authority, $path, $query))
					->mock($recipient)
						->receive('stringIs')
							->withArguments('http:' . $authorityAsString . $pathAsString . $queryAsString)
								->once
		;
	}
}
