<?php

namespace App\Models;

/**
 * Class User
 * @package App\Models
 */
class User extends BaseModel {

	static private $tableName = "silex_user";

	/**
	 * @return \App\Services\ModelService
	 */
	static public function Model() {
		return parent::Model(self::$tableName);
	}

	/**
	 * Public authentication function.
	 * @expects "METHOD HASH"
	 * @param string $auth_string
	 * @return bool
	 */
	static public function authenticate($auth_string) {
		if(empty($auth_string)) {
			return false;
		}

		list($auth_method, $auth_encoded) = explode(" ", $auth_string);

		$method = "authenticate".$auth_method;

		$class = get_class();
		if(method_exists($class, $method)) {
			return $class::$method($auth_encoded);
		}

		return false;
	}

	/**
	 * Basic authentication method
	 * @param $auth_string
	 * @return bool
	 */
	static private function authenticateBasic($auth_string) {
		$auth_decoded = explode("::", base64_decode($auth_string));
		list($uid, $public_key) = $auth_decoded;

		$user = self::Model()->fetchByPk($uid);

		if(empty($user)) {
			return false;
		}

		if(self::generatePublicKey($user) === $public_key) {
			return true;
		}

		return false;
	}

	/**
	 * Login the user
	 * @param $username
	 * @param $password
	 * @return bool|string
	 */
	static public function login($username, $password) {
		$user = self::Model()->fetchByField('username', $username);

		if(empty($user[0])) {
			return false;
		}

		$user = reset($user);

		if($user['password'] === $password) {
			return json_encode(array(
				'uid' => $user['id'],
				'secret_key' => $user['secret_key'],
			));
		}

		return false;
	}

	/**
	 * @param array $userModel
	 * @return string
	 */
	static private function generatePublicKey(array $userModel) {
		$data = array(
			"secret_key" => $userModel['secret_key']
		);
		$json = json_encode($data);
		return hash('sha256', $json);
	}
}