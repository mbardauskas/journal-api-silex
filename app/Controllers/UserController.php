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

	public static function actionLogin(Request $request, Application $app) {
		$username = $request->get('LoginForm[username]');
		$password = $request->get('LoginForm[password]');
		return array($username, $password);
	}
}
