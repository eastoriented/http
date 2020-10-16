<?php namespace eastoriented\http\stream\context\php\recipient;

interface factory
{
	function clientForPhpStreamContextRecipientIs(factory\client $client) :void;
}
