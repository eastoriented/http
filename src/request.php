<?php namespace eastoriented\http;

interface request
{
	function recipientOfHttpResponseFromClientIs(client $client, response\recipient $recipient) :void;
}
