<?php

namespace App\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use App\Models\User;

/**
 * Class UserController
 * @package App\Controllers
 */
class UserController extends BaseController {

	/**
	 * Logins the user. Success returns data for user, failure returns false.
	 * @param Request $request
	 * @param Application $app
	 * @return bool|string
	 */
	public static function actionLogin(Request $request, Application $app) {
		$loginForm = $request->request->get('LoginForm');
		if(!empty($loginForm['username']) && !empty($loginForm['password'])) {
			return User::login($loginForm['username'], $loginForm['password']);
		}
		return false;
	}
}
