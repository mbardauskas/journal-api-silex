<?php

/**
 * @var Application $app
 * @var Request $request
 */

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use App\Models\User;

$auth = function (Request $request) use($app) {
	$base = $request->getBaseUrl().'/api/';
	$requestUri = $request->getRequestUri();
	$requestApiPath = str_replace($base, '', $requestUri);

	// do not require auth headers for login url
	if($requestApiPath === 'login') {
		return;
	}

	$authorization = $request->headers->get('Authorization');

	if(!User::authenticate($authorization)) {
		exit("Invalid authorization");
	}
};

$app->get('/api/entries', '\\App\\Components\\API\\Controllers\\EntryApi::actionList')->before($auth);
$app->post('/api/login', '\\App\\Components\\API\\Controllers\\UserApi::actionLogin')->before($auth);
