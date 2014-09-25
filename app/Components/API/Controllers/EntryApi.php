<?php

namespace App\Components\API\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use App\Controllers\EntryController;

/**
 * Class EntryApi
 * @package App\Components\API\Controllers
 */
class EntryApi extends BaseApi {

	/**
	 * Lists all entries
	 * @param Request $request
	 * @param Application $app
	 * @return \Symfony\Component\HttpFoundation\JsonResponse
	 */
	static public function actionList(Request $request, Application $app) {
		$entryList = EntryController::actionList();
		return $app->json($entryList);
	}

	/**
	 * Inserts Entry to DB
	 * @param Request $request
	 * @param Application $app
	 * @return \Symfony\Component\HttpFoundation\JsonResponse
	 */
	static public function actionInsert(Request $request, Application $app) {
		$request_body = $request->getContent();
		$request_array = json_decode($request_body, TRUE);

		return $app->json(EntryController::actionInsert($request_array));
	}

	/**
	 * @param Request $request
	 * @param Application $app
	 * @param null $id
	 * @return mixed
	 */
	static public function actionDelete(Request $request, Application $app, $id = null) {
		if($id === null) {
			return false;
		}

		$entryDelete = EntryController::actionDelete($id);
		return $entryDelete;
	}
}