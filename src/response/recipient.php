<?php namespace eastoriented\http\response;

use eastoriented\http\{
	url,
	response
};

interface recipient
{
	function unableToGetHttpResponseFromUrl(url $url) :void;
	function unableToBuildHttpResponseFromString(string $string) :void;
	function okHttpResponseIs(response $response) :void;
	function notFoundHttpResponseIs(response $response) :void;
	function serverErrorHttpResponseIs(response $response) :void;
}
