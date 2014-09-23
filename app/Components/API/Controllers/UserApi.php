<?php

namespace App\Components\API\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use App\Controllers\UserController;

/**
 * Class UserApi
 * @package App\Components\API\Controllers
 */
class UserApi extends BaseApi {

	/**
	 * API Login
	 * @param Request $request
	 * @param Application $app
	 * @return bool|string
	 */
	static public function actionLogin(Request $request, Application $app) {
		return UserController::actionLogin($request, $app);
	}
}