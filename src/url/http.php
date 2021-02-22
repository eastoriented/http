<?php namespace eastoriented\http\url;

use eastoriented\php\string\{
	recipient,
	buffer
};

use eastoriented\http\url;

class http
	implements url
{
	private
		$authority,
		$path,
		$query
	;

	function __construct(url\authority $authority, url\path $path = null, url\query $query = null)
	{
		$this->authority = $authority;
		$this->path = $path ?: new url\path\blackhole;
		$this->query = $query ?: new url\query\blackhole;
	}

	function recipientOfStringIs(recipient $recipient) :void
	{
		$buffer = new recipient\buffer(new buffer\infinite);

		$this->authority
			->recipientOfStringIs(
				$buffer
			)
		;

		$this->path
			->recipientOfStringIs(
				$buffer
			)
		;

		$this->query
			->recipientOfStringIs(
				$buffer
			)
		;

		$buffer
			->recipientOfStringIs(
				new recipient\prefix(
					'http:',
					$recipient
				)
			)
		;
	}
}
