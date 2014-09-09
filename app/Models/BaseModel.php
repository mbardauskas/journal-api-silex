<?php

namespace App\Models;

use Silex\Application;
use App\Services\ModelService;

abstract class BaseModel {
	static private $service_instance;

	static public function Model($tableName) {
		if(empty(self::$service_instance)) {
			self::$service_instance = new ModelService($tableName);
		}
		return self::$service_instance;
	}
}