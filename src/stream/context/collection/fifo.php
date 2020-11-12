<?php namespace eastoriented\http\stream\context\collection;

use eastoriented\php\container\iterator;
use eastoriented\http\stream\context;

class fifo extends generic
{
	function __construct(context... $contexts)
	{
		parent::__construct(new iterator\fifo, ... $contexts);
	}
}
