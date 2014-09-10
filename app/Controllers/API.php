<?php

/**
 * @TODO: Move to a separate component
 */
namespace App\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use App\Models\User;

class API {
	public static function hello(Request $request, Application $app) {
		$data = array('data' => 'hello world');

		return $app->json($data);
	}

	public static function test(Request $request, Application $app, $key = null) {
		$data = array(
			'data' => 'hello world',
			'key' => $key,
		);

		return $app->json($data);
	}

	static public function testEntry(Request $request, Application $app) {
		$entryList = EntryController::actionList();
		return $app->json($entryList);
	}

	static public function testAuth(Request $request, Application $app) {
		$auth = User::authenticate("Basic MTo6NDA5MTdhMTdjNmQxYTg1ZDUzMDVjNWFjNTk4ZjdlODc1ZTFmOTU1ZGFjNGU4NWZhNzZmMjdhZDdkMjJmYmUyMg==");
		return $app->json($auth);
	}
}