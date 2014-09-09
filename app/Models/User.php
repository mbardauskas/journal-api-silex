<?php

namespace App\Models;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class User extends BaseModel {

	static private $tableName = "silex_user";

	static public function Model() {
		return parent::Model(self::$tableName);
	}

	public static function authenticate(Request $request, Application $app) {
		$authorization = $request->headers->get('Authorization');
		if(empty($authorization)) {
			return false;
		}

		/**
		 * @TODO: move to different methods based on first argument of $encoded_array
		 */
		/*$encoded_array = explode(" ", $authorization);
		$encoded_data = $encoded_array[1];
		$auth_decoded = explode(":", base64_decode($encoded_data));
		$auth_uid = $auth_decoded[0];

		$user = self::Model()->fetchByPk($auth_uid);*/

		// always authenticaded for now
		return true;
	}

	private function generate_public_key(array $data) {

	}
}