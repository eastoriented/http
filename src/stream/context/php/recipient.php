<?php namespace eastoriented\http\stream\context\php;

interface recipient
{
	function arrayToBuildPhpHttpStreamContextIs(array $context) :void;
}
