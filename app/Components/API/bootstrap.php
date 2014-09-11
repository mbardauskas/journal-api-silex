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
		//uncomment when combined with JS app
		//exit("Invalid authorization");
	}
};

$app->get('/api/', '\\App\\Components\\API\\Controllers\\EntryApi::actionList')->before($auth);
