<?php

/**
 * @TODO: Move to a separate component
 */
namespace App\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

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
}