<?php

/**
 * @var Application $app
 * @var Request $request
 */

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use App\Models\User;

$auth = function (Request $request) use($app) {
	$authorization = $request->headers->get('Authorization');

	if(!User::authenticate($authorization)) {
		exit("Invalid authorization");
	}
};

$app->get('/api/test', '\\App\\Controllers\\API::testAuth')->before($auth);
