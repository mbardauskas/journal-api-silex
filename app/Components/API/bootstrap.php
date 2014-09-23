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

$app->get('/api/entries/', '\\App\\Components\\API\\Controllers\\EntryApi::actionList')->before($auth);
$app->post('/api/login', '\\App\\Components\\API\\Controllers\\UserApi::actionLogin')->before($auth);
