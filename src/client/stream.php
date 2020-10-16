<?php namespace eastoriented\http\client;

use eastoriented\http\{
	client,
	url,
	request,
	response,
	stream\context
};

use eastoriented\php\string\recipient;

class stream
	implements
		client
{
	private
		$responseFactory,
		$streamContext
	;

	private
		const EOL = "\r\n"
	;

	function __construct(response\factory $responseFactory, context $streamContext = null)
	{
		$this->responseFactory = $responseFactory;
		$this->streamContext = $streamContext ?: new context\blackhole;
	}

	function recipientOfHttpResponseForGetOnUrlIs(url $url, response\recipient $recipient) :void
	{
		$url
			->recipientOfStringIs(
				new recipient\functor(
					function($urlAsString) use ($url, $recipient) {
						$context = [];

						$this->streamContext
							->recipientOfArrayToBuildPhpHttpStreamContextIs(
								new context\php\recipient\reference($context)
							)
						;

						$stream = @fopen($urlAsString, 'r', false, $context);

						if (! $stream)
						{
							$recipient->unableToGetHttpResponseFromUrl($url);
						}
						else
						{
							$responseBody = '';

							while (! feof($stream))
							{
								$responseBody .= stream_get_contents($stream);
							}

							$this->responseFactory
								->recipientOfHttpResponseBuiltFromStringIs(
									join(
										self::EOL,
										stream_get_meta_data($stream)['wrapper_data']
									).
									self::EOL .
									self::EOL .
									$responseBody,
									$recipient
								)
							;
						}
					}
				)
			)
		;
	}

	function recipientOfHttpResponseForRequestIs(request $request, response\recipient $recipient) :void
	{
		$request
			->recipientOfHttpResponseFromClientIs(
				$this,
				$recipient
			)
		;
	}
}
